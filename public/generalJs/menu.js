/**
 * Created by Marco on 1/10/2016.
 */
$(function() {
    $(".cross").hide();
    $(".cross2").hide();
    $("#menu1").hide();
    $("#menu2").hide();

    $.post( "getMyFriends", function( data ) {
        console.log(data)
        var ul = $("#friends_ul");
        ul.empty();
        for (friend in data) {
            var name_var = data[friend]["user"]["name"];

            var photo_var = data[friend]["user"]["photo"];
            /*
             var chat = '<span class="glyphicon glyphicon-comment" id="chat' + data[friend]['user']['idUser'] + '"></span>'
             var li = $('<li></li>');
             //console.log("<img src='generalImg" + photo_var + "' width = '50px' />")
             var linkA = $("<a href = 'friendProfile"+data[friend]['user']['idUser']+"'></a>")
             li.append("<img src='generalImg/" + photo_var + "' width = '50px' />");
             li.append("<p>"+name_var+"</p>");
             li.append(chat);
             ul.append(li);
             }
             */
            var chat = '<span class="glyphicon glyphicon-comment" id="chat' + data[friend]['user']['idUser'] + '"></span>'
            var li = $('<li></li>');
            //console.log("<img src='generalImg" + photo_var + "' width = '50px' />")
            var linkA = $("<a href = 'friendProfile/"+data[friend]['user']['idUser']+"'><img src='generalImg/" + photo_var + "' width = '50px' /><p>"+name_var+"</p></a>")

            li.append(linkA);
            li.append(chat);
            ul.append(li);
        }
        /*
         for (friend in data) {
         var name_var = data[friend]["user"]["name"];
         var name_p = ("<p>name_var</p>");
         var photo_var = data[friend]["user"]["photo"];
         var photo_img = ("<img src=" + photo_var + " width = '50px'/>");
         var chat = '<span class="glyphicon glyphicon-comment" id="chat' + data[friend]['user']['idUser'] + '"></span>'
         var li = $('<li></li>');
         li.append(photo_img);
         li.append(name_p);
         li.append(chat);
         ul.append(li);
         }
         */
    });
    $(".hamburger").click(function () {
        $("#menu1").slideToggle("slow");
        $(".hamburger").hide();
        $(".cross").show();
    });


    $(".cross").click(function () {
        $("#menu1").slideToggle("slow");
        $(".cross").hide();
        $(".hamburger").show();
    });
    $(".friends").click(function () {
        $("#menu2").slideToggle("slow", function () {
            $(".friends").hide();
            $(".cross2").show();
        });
    });

    $(".cross2").click(function () {
        $("#menu2").slideToggle("slow", function () {
            $(".cross2").hide();
            $(".friends").show();
        });
    });

});

