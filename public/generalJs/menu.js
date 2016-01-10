/**
 * Created by Marco on 1/10/2016.
 */
$( ".cross" ).hide();
$( "#menu1" ).hide();
$( ".hamburger" ).click(function() {
    $( "#menu1" ).slideToggle( "slow", function() {
        $( ".hamburger" ).hide();
        $( ".cross" ).show();
    });
});

$( ".cross" ).click(function() {
    $( "#menu1" ).slideToggle( "slow", function() {
        $( ".cross" ).hide();
        $( ".hamburger" ).show();
    });
});

$( ".cross2" ).hide();
$( "#menu2" ).hide();
$( ".friends" ).click(function() {
    $( "#menu2" ).slideToggle( "slow", function() {
        $( ".friends" ).hide();
        $( ".cross2" ).show();
    });
});

$( ".cross2" ).click(function() {
    $( "#menu2" ).slideToggle( "slow", function() {
        $( ".cross2" ).hide();
        $( ".friends" ).show();
    });
});
