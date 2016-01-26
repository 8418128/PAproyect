$(document).ready(function(){
    $(".comentario").keyup(function(e){
        if(e.keyCode==13){
            var comentario = $('.comentario').val();
            var idCanva= $('.comentario').attr('name');
            //console.log($('#comentario').attr('name'));

            if (comentario != '') {
                $.ajax({
                    type: "POST",
                    url: "comment",
                    data: {comment: comentario,id: idCanva},//Variable para recoger
                    success: function (data) {
                        console.log("ola mi amol "+ data['name']);
                        $(".comentarios").append(data['name']+"<p>"+data['text']+"</p>");
                        $(".comentario").val('');

                    },

                });
            }
        }
    });
});
