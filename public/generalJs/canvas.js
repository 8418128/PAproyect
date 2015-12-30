/**
 * Created by S on 27/12/2015.
 */
var ctx, color = "#000";
var globalsrc = '/socialnet/public/canvasimg/'
var srcDropped = 'Sin%20título.png';
var base_image;
var flag;

$(function(){

    newCanvas();

    var target = document.getElementById("page");
    target.addEventListener("dragover", function(e){e.preventDefault();}, true);
    target.addEventListener("drop", function(e){
        e.preventDefault();
        loadImage(e.dataTransfer.files[0]);
    }, true);

    var imageUrl = globalsrc+srcDropped;
    //$("#image").css('background-image', 'url(' + imageUrl + ')');


    $('#canvas').on('mousedown', '#image', function() {
        $(this).addClass('draggable').parents().on('mousemove', function(e) {
            $('.draggable').offset({
                top: e.pageY - $('.draggable').outerHeight() / 2,
                left: e.pageX - $('.draggable').outerWidth() / 2
            }).on('mouseup', function() {
                $(this).removeClass('draggable');
            });
        });
        //e.preventDefault();
    }).on('mouseup', function() {
        $('.draggable').removeClass('draggable');
        var offset = $("#image").offset()
        var plusoff = $(".title").width()
        console.log(offset.top+"...."+offset.left)
        setImg(false,imageUrl,(offset.left-1),(offset.top-45))
        $("#image").css('background-image','')
    });

})

function saveCanvas(){
    var dataURL = document.getElementById("canvas").toDataURL();
    $.ajax({
        type: "POST",
        url: "uploadCanvas",
        //contentType: "application/x-www-form-urlencoded",
        data: {
            img64: dataURL
        }
    }).done(function(o) {
        console.log(o);
        window.location.href=o;
    });
}





// function to setup a new canvas for drawing
function newCanvas(){
    //define and resize canvas
    document.getElementById("content").style.height = window.innerHeight-90;
    var canvas = '<canvas id="canvas" width="'+window.innerWidth+'" height="'+(window.innerHeight-90)+'"></canvas>';
    document.getElementById("content").innerHTML = canvas;

    // setup canvas
    ctx=document.getElementById("canvas").getContext("2d");
    ctx.strokeStyle = color;
    ctx.lineWidth = 5;

    // setup to trigger drawing on mouse or touch
    drawTouch();
    drawPointer();
    drawMouse();

    $.couch.urlPrefix = "https://socpa.cloudant.com";
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

    $.couch.db("media").view("media/media", {
        success: function(data) {
            console.log(data)
            $.each(data.rows,function(i,val){
                var media = val.value;
                if(media.type=="stroke"){
                    console.log("STROKES!!!!")
                    if(base_image!=null)
                        setStroke(media)
                    else{
                        setStroke(media)
                    }

                }
                else if(media.type=="img"){
                    console.log("IMAHENN!!!!")
                    setImg(true,media.src,10,100);
                }

            })
        },
        error: function(status) {
            console.log(status);
        },
        startkey: 6,
        endkey: [6,{}],
        reduce: false
    });



}

function setStroke(media){
    var xs = media.x
    var ys = media.y
    ctx.beginPath();
    ctx.strokeStyle = media.color;
    for (var i = 0; i < xs.length; i++) {
        ctx.lineTo(xs[i], ys[i]);
        ctx.stroke();
    }
}

function selectColor(el){
    for(var i=0;i<document.getElementsByClassName("palette").length;i++){
        document.getElementsByClassName("palette")[i].style.borderColor = "#777";
        document.getElementsByClassName("palette")[i].style.borderStyle = "solid";
    }
    el.style.borderColor = "#fff";
    el.style.borderStyle = "dashed";
    color = window.getComputedStyle(el).backgroundColor;
    ctx.beginPath();
    ctx.strokeStyle = color;
    //ctx.lineWidth = 15;
}
// prototype to	start drawing on touch using canvas moveTo and lineTo
var drawTouch = function() {
    var start = function(e) {
        ctx.beginPath();
        x = e.changedTouches[0].pageX;
        y = e.changedTouches[0].pageY-44;
        ctx.moveTo(x,y);
    };
    var move = function(e) {
        e.preventDefault();
        x = e.changedTouches[0].pageX;
        y = e.changedTouches[0].pageY-44;
        ctx.lineTo(x,y);
        ctx.stroke();
    };
    document.getElementById("canvas").addEventListener("touchstart", start, false);
    document.getElementById("canvas").addEventListener("touchmove", move, false);
};

// prototype to	start drawing on pointer(microsoft ie) using canvas moveTo and lineTo
var drawPointer = function() {
    var start = function(e) {
        e = e.originalEvent;
        ctx.beginPath();
        x = e.pageX;
        y = e.pageY-44;
        ctx.moveTo(x,y);
    };
    var move = function(e) {
        e.preventDefault();
        e = e.originalEvent;
        x = e.pageX;
        y = e.pageY-44;
        ctx.lineTo(x,y);
        ctx.stroke();
    };
    document.getElementById("canvas").addEventListener("MSPointerDown", start, false);
    document.getElementById("canvas").addEventListener("MSPointerMove", move, false);
};
// prototype to	start drawing on mouse using canvas moveTo and lineTo
var drawMouse = function() {
    var xs = [];
    var ys = [];
    var i = 0;
    var clicked = 0;
    var start = function(e) {
        console.log("START MOUSE")
        clicked = 1;
        ctx.beginPath();
        x = e.pageX;
        y = e.pageY-44;
        ctx.moveTo(x,y);
        xs[i]=x;
        ys[i++]=y;
    };
    var move = function(e) {
        console.log("MOVIENDO MOUSE")
        if(clicked==1){
            x = e.pageX;
            y = e.pageY-44;
            ctx.lineTo(x,y);
            ctx.stroke();
            xs[i]=x;
            ys[i++]=y;
        }
    };
    var stop = function(e) {
        console.log("STOP MOUSE")
        i=0;
        if(clicked==1) {
            var db = $.couch.db("media");
            console.log("pintando en "+color)
            var date = Math.round(new Date().getTime()/1000)
            var doc = {"canvas_id": 6,"created_at":date, "type": "stroke", "color": color, "x": xs, "y": ys}
            // insert the doc into the db
            db.saveDoc(doc, {
                success: function (response, textStatus, jqXHR) {
                    console.log(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            })

            xs = [];
            ys = [];
            clicked = 0;
        }

    };
    document.getElementById("canvas").addEventListener("mousedown", start, false);
    document.getElementById("canvas").addEventListener("mousemove", move, false);
    document.addEventListener("mouseup", stop, false);
};

function setImg(uri,src,x,y)
{
    var deferred = $.Deferred();
    base_image = new Image();
    if(uri)
        base_image.src = "/socialnet/public/canvasimg/"+src
    else {
        base_image.src = src
    }
    base_image.onload = function(){
        ctx.drawImage(base_image, x, y);
        deferred.resolve();
        console.log("imagen puesta en :"+x+", "+y)
    }
    return deferred.promise();

}

function loadMedias(){

}

function loadImage(src){
    //	Prevent any non-image file type from being read.
    if(!src.type.match(/image.*/)){
        console.log("The dropped file is not an image: ", src.type);
        return;
    }

    //	Create our FileReader and run the results through the render function.
    var reader = new FileReader();
    reader.onload = function(e){
        setImg(false,e.target.result,10,10);
    };
    reader.readAsDataURL(src);
}










