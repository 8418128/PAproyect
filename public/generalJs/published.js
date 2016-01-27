$(document).ready(function(){
    $('.published').click(function(){

        var idC=$(this).val();

         $.ajax({
         type: "POST",
         url: "publish",
         data: {canvas_id: idC},//Variable para recoger
         success: function (data) {

         },

         });

    });
});

