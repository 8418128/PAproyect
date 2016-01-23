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
                error: function (xhr, status, error) {
                    var err = eval(xhr.responseText);
                    console.log(err.Message);
                }

            }).done(function (users) {//Aqui llega el array de la busqueda
                alert(users);
            })
        }

}
