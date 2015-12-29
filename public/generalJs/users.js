/**
 * Created by S on 27/12/2015.
 */
//**********************CONEXION*************************//
    $.couch.urlPrefix = "https://socpa.cloudant.com";
    console.log("OK!")

//***********************LOGIN***************************//
    $.couch.login({
     name: "socpa",
     password: "asdargonnijao",
     success: function(data) {
     console.log(data);

     },
     error: function(status) {
     console.log(status);
     }
     });




    /*$.couch.db("users").view("default/new-view", {
        success: function(data) {
            console.log(data)
            $.each(data.rows,function(i,val){
                console.log(val.value._id)
            })
        },
        error: function(status) {
            console.log(status);
        },
        reduce: false
    });*/


//*********************SAVE DOCUMENT************************//
    /*var doc = {"nombre":"falete ingaar"}
     var db = $.couch.db("users");
     // insert the doc into the db
     db.saveDoc(doc, {
     success: function(response, textStatus, jqXHR){
     console.log(response);
     },
     error: function(jqXHR, textStatus, errorThrown){
     console.log(errorThrown)
     }
     })
     */