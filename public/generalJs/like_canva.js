$(document).ready(function(){
    $('.like').click(function(){
        var texto = $(this).text();
        var idCa = $(this).val();

        if(texto =='Me gusta'){
            $.ajax({
                type: "post",
                url: "likeCanva",
                data: {idCanva: idCa},//Variable para recoger
                success: function (data) {
                    console.log('hola');
                    $(this).attr('value','Ya no me gusta');

                },

            });
        }else{
            $.ajax({
                type: "post",
                url: "dislikeCanva",
                data: {idCanva: idCa},//Variable para recoger
                success: function (data) {
                    console.log('hola');
                    $(this).attr('value','Me gusta');

                },

            });
        }


    });
});

