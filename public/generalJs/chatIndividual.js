/**
 * Created by S on 17/01/2016.
 */
var route = '/socialnet/public/generalImg/'
var me = {idUser:9};
var openedChats = {};
var hes = {};
$(function(){
    listenPusher(me)
    $(document).on('click', '.glyphicon-comment', function (e) {
        var chatid = $(this).attr('id')
        chatid = parseInt(chatid.split('chat')[1]);
        console.log(openedChats[chatid])
        if(openedChats[chatid]!=undefined&&!openedChats[chatid].is(":visible")){
            $(".chat-window").hide()
            $('#chats-container').find('.btn-xs').removeClass('active')
            openedChats[chatid].show()
            $("#minic"+chatid).addClass('active')
        }
        else if(openedChats[chatid]==undefined){
            $(".chat-window").hide()
            openedChats[chatid]=appendChat(chatid,false)

        }

    })

    $('#chats-container').on('click', '.btn-xs', function () {
        var chatid = $(this).attr('id').split("minic")[1]
        console.log(chatid)
        if(!openedChats[chatid].is(":visible")){
            $(".chat-window").hide()
            $('#chats-container').find('.btn-xs').removeClass('active')
            openedChats[chatid].show()
            $("#minic"+chatid).addClass('active')
            $('#minic' + chatid).removeClass('parpadea')
            goBottom($('#chat_window'+chatid))
        }
        else if(openedChats[chatid].is(":visible")){
            openedChats[chatid].hide()
            $('#chats-container').find('.btn-xs').removeClass('active')

        }
    });


})





function appendChat(id_he,flag){
    var he;
    var chatn='chat_window'+id_he

    var chaty = '<div class="row chat-window col-xs-5 col-md-3" ' +
        'id="'+chatn+'" style="margin-left:10px;">' +
        '<div class="col-xs-12 col-md-12">       ' +
        '<div class="panel panel-default">      ' +
        '<div class="panel-heading top-bar">       ' +
        '<div class="col-md-8 col-xs-8">       ' +
        '<h3 id="chatPerson" class="panel-title">' +
        '<div id="isCon"> </div></h3>        ' +
        '</div>        ' +
        '<div class="col-md-4 col-xs-4" style="text-align: right;">        ' +
        '<a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>        ' +
        '<a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>        ' +
        '</div>        </div>        <div id="panelChat" class="panel-body msg_container_base">        ' +
        '</div>        <div class="panel-footer">        <div class="input-group">        ' +
        '<input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />        ' +
        '<span class="input-group-btn">        <button class="btn btn-primary btn-sm" id="btn-chat">Send</button>        ' +
        '</span>        </div>        </div>        </div>        </div>       </div>'

    $('body').append(chaty)
    var selectChat = $('#'+chatn)

    var collapse = selectChat.find('.panel-heading span.icon_minim')
    collapse.click(function() {
        console.log("MORE MINUS")
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });

    var foot = selectChat.find('.panel-footer input.chat_input')
    foot.click(function() {
        console.log("MINUS MORE")
        var $this = $(this);
        if ($('#minim_chat_window').hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideDown();
            $('#minim_chat_window').removeClass('panel-collapsed');
            $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
        });


    var remv = selectChat.find('.icon_close')
    remv.click(function() {
        console.log("REMOVE")
        //$(this).parent().parent().parent().parent().remove();
        $( "#"+chatn).remove();
        delete hes[id_he]
        delete openedChats[id_he]
        console.log(hes)
        $("#minic"+id_he).remove();
        });

    $.ajax({
        type: "GET",
        url: "chats",
        data: {
            friend:id_he
        },
        success: function(data) {
            console.log("SUCCESS: ");

        },
        error: function(xhr, status, error) {
            var err = eval(xhr.responseText);
            console.log(err.Message);
        }

    }).done(function(data){
        console.log(data)
        he=data.person.he
        hes[he['idUser']]=he
        me=data.person.me
        var panel = selectChat.find('#panelChat')
        var cPerson = selectChat.find('#chatPerson')
        cPerson.append(" <span style='cursor:pointer;' id='linkF'>"+he['name']+"</span>")
        if(he.connected==1){
            selectChat.find('#isCon').removeClass('disconn')
            selectChat.find('#isCon').addClass('conn');
        }
        else{
            selectChat.find('#isCon').removeClass('conn')
            selectChat.find('#isCon').addClass('disconn');
        }
        friendLink(he)
        $.each(data.chats,function(i,chat){
            if (chat.sends == id_he) {
                panel.append(setReceive(chat,he))
            }
            else {
                panel.append(setSent(chat))
            }
        })

        goBottom(selectChat)



        selectChat.find('#btn-input').keyup(function (e) {
            if (e.keyCode == 13) {
                console.log("SEND ENTER")
                send(he,selectChat)
            }
        });

        selectChat.find('#btn-chat').click(function (e) {
            console.log("SEND CLICK")
            send(he,selectChat)
        })

        $('#chats-container').find('.btn-xs').removeClass('active')
        appendMiniChat(id_he)
        if(flag) {
            $('#minic' + id_he).removeClass('active')
            $('#minic' + id_he).addClass('parpadea')
        }
        else
            $("#minic"+id_he).addClass('active')


    })

    selectChat.find('#panelChat').scroll(function() {
        if($(this).scrollTop()  == 0) {
            console.log("top")
        }
    });

    return selectChat;

}


function listenPusher(me){

    Pusher.log = function(msg) {
        console.log(msg)
    };
    var pusher = new Pusher("650badadf8611ff0c889")
    var channel = pusher.subscribe(me.idUser.toString());
    channel.bind('App\\Events\\ChEvent',
        function(data) {
            console.log("-.-.-.-.-.")
            console.log(data)
            var msg = data.texto.text
            var sends = data.texto.sends
            var chatn=$('#chat_window'+sends)
            var chat = {text:msg,updated_at:0}
            if(chatn.length>0){
                console.log("1")
                chatn.find('#panelChat').append(setReceive(chat,hes[sends]))
                $('#minic'+sends).addClass('parpadea')

            }
            else{
                console.log("2")
                openedChats[sends]=appendChat(sends,true)
                $('#chat_window'+sends).hide();
                console.log($('#minic'+sends))
            }

        }
    );
}



function appendMiniChat(sends){
    console.log('apendoChato')
    var he = hes[sends]
    var con;
    if(he['connected']==1)
        con = '<div class="conn"></div>'
    else{
        con = '<div class="disconn"></div>'
    }
    $("#chats-container").append('<button type="button" id="minic'+sends+'" class="btn btn-default btn-xs"><div id="pp">'+con+he['name']+'</div></button>')

}

function goBottom(selectChat){
    /*var top = selectChat.find(".msg_container").last().offset().top
    selectChat.find('#panelChat').animate({
        scrollTop: top
    }, 300);*/
}

function send(he,selectChat){
    var txt = selectChat.find("#btn-input").val()
    var chat = {text:txt,updated_at:0}
    selectChat.find("#panelChat").append(setSent(chat))
    $.ajax({
        type: "POST",
        url: "pushChat",
        data: {
            chat: {sends:me.idUser,receives:he.idUser,text:txt}
        }
    }).done(function(){
        selectChat.find("#btn-input").val('')
        goBottom(selectChat)
    })
}

function friendLink(he){
    $(document).on('click', '#linkF', function (e) {
        window.location='/socialnet/public/friendProfile/'+he.idUser
    })
}

function setReceive(chat,he){
    var msg = chat.text
    var user = he.name
    var time = chat.updated_at
    var avatar = route+he.photo
    var dif
    if(time!=0)
        dif = getTimeDiff(time)
    else{
        dif = ' now'
    }
    return '<div class="row msg_container base_receive">' +
        '<div class="col-md-2 col-xs-2 avatar">' +
        '<img src="'+avatar+'" class=" img-responsive ">' +
        '</div><div class="col-xs-10 col-md-10">' +
        '<div class="messages msg_receive">' +
        '<p>'+msg+'</p>' +
        '<time datetime="'+time+'">'+user+' • '+dif+'</time>' +
        '</div>' +
        '</div>' +
        '</div>'
}
function setSent(chat){
    var msg = chat.text
    var time = chat.updated_at
    var avatar = route+me.photo
    var dif
    if(time!=0)
        dif = getTimeDiff(time)
    else{
        dif = ' now'
    }
    return '<div class="row msg_container base_sent">' +
        '<div class="col-xs-10 col-md-10">' +
        '<div class="messages msg_sent">' +
        '<p>'+msg+'</p>' +
        '<time datetime="'+time+'">me • '+dif+'</time>' +
        '</div>' +
        '</div>' +
        '<div class="col-md-2 col-xs-2 avatar">' +
        '<img src="'+avatar+'" class=" img-responsive ">' +
        '</div>' +
        '</div>'

}

function getTimeDiff(sqlDateStr){
    var what
    sqlDateStr = sqlDateStr.replace(/:| /g,"-");
    var YMDhms = sqlDateStr.split("-");
    var sqlDate = new Date();
    sqlDate.setFullYear(parseInt(YMDhms[0]), parseInt(YMDhms[1])-1,
        parseInt(YMDhms[2]));
    sqlDate.setHours(parseInt(YMDhms[3]), parseInt(YMDhms[4]),
        parseInt(YMDhms[5]), 0/*msValue*/);
    var now = new Date()
    var timeDiff = Math.abs(now.getTime() - sqlDate.getTime());
    var diff = Math.ceil(timeDiff / 1000);
    what=0
    if(diff>=60){
        what=1
        diff = Math.ceil(diff / 60);
        if(diff>60){
            what=2
            diff = Math.ceil(diff / 60);
            if(diff>24){
                what=3
                diff = Math.ceil(diff / 24);
            }
        }
    }

    var string

    switch(what){
        case 0: string = 'second'
            break;
        case 1: string = 'minute'
            break;
        case 2: string = 'hour'
            break;
        case 3: string = 'day'
            break;
    }

    if(diff>1)
        string+='s'

    return diff+" "+string+' ago'
}
