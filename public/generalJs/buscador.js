function load() {

        var name = $('#name').val();
        if (name != '') {
            $.ajax({
                type: "POST",
                url: "lookFor",
                data: {name: name},//Variable para recoger en el nombre
                success: function (data) {
                    console.log("SUCCESS busqueda: " + data);

                },

            }).done(function (data) {//Aqui llega el array de la busqueda
                console.log("Resultado: " + data['users']);

              $.each(data.users,function(i,user) {
                    console.log('Prueba '+ user.name);
                });

            });
        }
}
