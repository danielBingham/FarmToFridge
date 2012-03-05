

function hideMenu() { 
    $("#closemenu").hide();
    $("#openmenu").show(); 
    $("#menu").hide();
}

function showMenu() {
    $("#openmenu").hide();
    $("#closemenu").show();
    $("#menu").css('display', 'block');
}

$(document).ready(function() {

    $("#navigation #js-fail").hide();
    $("#navigation #openmenu").show();
       
    $("#navigation #browse-button").live('click', function(event) {
        event.preventDefault();
        if($("#menu").css('display') == 'none') {
            showMenu(); 
        } else {
            hideMenu(); 
        }
    });
    $("body").click(function(event) {
        if (!$(event.target).closest('#nagivation, #navigation > div, #navigation > a').length) {
            hideMenu(); 
        };
    });

});
