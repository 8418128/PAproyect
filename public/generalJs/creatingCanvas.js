/**
 * Created by S on 25/01/2016.
 */
var guests = []
$(function(){
    $(document).on('click', '#addf', function (e) {
        var id = $("#frienda").val()
        var txt = $('#frienda').find(":selected").text();
        var img = '<img style="float:left; width:100px;" src="'+$('#frienda').find(":selected").attr("data-image")+'"/>';
        $("#guests-container").append('<div style="float:left">'+img+txt+'</div>')
        guests.push(id)

    })

    $(document).on('click', '#createc', function (e) {
        var title = $("#title").val()
        var editable = $("#editable").val()
        $.ajax({
            type: "POST",
            url: "createcanvas",
            data: {
                title:title,
                editable:editable,
                guests:guests
            }
        }).done(function(url){
            var loc = window.location;
            window.location = url
        })
    })

})