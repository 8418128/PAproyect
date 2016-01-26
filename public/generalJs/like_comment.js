$(document).ready(function(){
    $('.like').click(function(){
        var idCo=$("").val();
        var valor=$(this).text();
        console.log('text '+idCo);
        /*
        $.ajax({
            type: "POST",
            url: "likeComment",
            data: {idComment: idCo},//Variable para recoger
            success: function (data) {
                console.log("ola mi amol "+ data['name']);

            },

        });*/

    });
});

