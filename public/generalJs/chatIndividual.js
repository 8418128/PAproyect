/**
 * Created by S on 17/01/2016.
 */
var friend = 10
var route = '/socialnet/public/generalImg/'
var me,he;
$(function(){

    var chaty = '<div class="row chat-window col-xs-5 col-md-3" ' +
        'id="chat_window_1" style="margin-left:10px;">' +
        '<div class="col-xs-12 col-md-12">       ' +
        '<div class="panel panel-default">      ' +
        '<div class="panel-heading top-bar">       ' +
        '<div class="col-md-8 col-xs-8">       ' +
        '<h3 id="chatPerson" class="panel-title">' +
        '<div id="isCon"></div></h3>        ' +
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


    $.ajax({
        type: "GET",
        url: "chats",
        data: {
            friend:friend
        },
        success: function(data) {
            console.log("SUCCESS: ");

        },
        error: function(xhr, status, error) {
            var err = eval(xhr.responseText);
            console.log(err.Message);
        }

    }).done(function(data){
        var panel = $("#panelChat")
        he=data.person.he
        me=data.person.me
        $("#chatPerson").append(" <span style='cursor:pointer;' id='linkF'>"+he['name']+"</span>")

        $("#isCon").css('background-color', '#2ECC40');
        friendLink()
        $.each(data.chats,function(i,chat){
            console.log(chat)
            if (chat.sends == friend) {
                console.log("receive->"+chat.sends)
                panel.append(setReceive(chat))
            }
            else {
                console.log("sent->"+chat.sends)
                panel.append(setSent(chat))
            }
        })
    })



    $("#btn-input").keyup(function (e) {
        if (e.keyCode == 13) {
            send()
        }
    });

    $('#panelChat').scroll(function() {
        if($(this).scrollTop()  == 0) {
            console.log("top")
        }
    });


    $(document).on('click', '#btn-chat', function (e) {
        send()
    })

    $(document).on('click', '.panel-heading span.icon_minim', function (e) {
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
    $(document).on('focus', '.panel-footer input.chat_input', function (e) {
        var $this = $(this);
        if ($('#minim_chat_window').hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideDown();
            $('#minim_chat_window').removeClass('panel-collapsed');
            $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });
    $(document).on('click', '#new_chat', function (e) {
        var size = $( ".chat-window:last-child" ).css("margin-left");
        size_total = parseInt(size) + 400;
        alert(size_total);
        var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
        clone.css("margin-left", size_total);
    });
    $(document).on('click', '.icon_close', function (e) {
        //$(this).parent().parent().parent().parent().remove();
        $( "#chat_window_1" ).remove();
    });
})

function send(){
    var txt = $("#btn-input").val()
    var chat = {text:txt,updated_at:0}
    $("#panelChat").append(setSent(chat))
    $("#btn-input").val('')
    $('#panelChat').animate({
        scrollTop: $(".msg_container").last().offset().top
    }, 300);
    //TODO mandar el evento de chat
}

function friendLink(){
    $(document).on('click', '#linkF', function (e) {
        //TODO mandar al perfil del colega
        console.log(he.idUser)
    })
}

function setReceive(chat){
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
