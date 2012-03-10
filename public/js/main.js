

function hideMenu(jqMenuParent) { 
    jqMenuParent.children(".close-menu").hide();
    jqMenuParent.children(".open-menu").show(); 
    jqMenuParent.children(".menu").hide();
}

function showMenu(jqMenuParent) {
    jqMenuParent.children(".open-menu").hide();
    jqMenuParent.children(".close-menu").show();
    jqMenuParent.children(".menu").css('display', 'block');
    
    var offset = jqMenuParent.children(".close-menu").offset();
    var height = jqMenuParent.children(".close-menu").innerHeight();
    
    var jqMenu = jqMenuParent.children(".menu"); 
    jqMenu.css('min-width', jqMenuParent.innerWidth());
    jqMenu.css('top', offset.top+height-5);
    if(jqMenuParent.hasClass('menu-left')) { 
        jqMenu.css('left', offset.left);
    } else if(jqMenuParent.hasClass('menu-right')) {
        if(jqMenu.innerWidth() > jqMenuParent.innerWidth()) {
            jqMenu.css('left', offset.left - (jqMenu.innerWidth()-jqMenuParent.innerWidth()));
        } else {
            jqMenu.css('left', offset.left);
        }
    }
}

$(document).ready(function() {

    $(".js-fail").hide();
    $(".open-menu").show();
       
    $(".open-button").live('click', function(event) {
        event.preventDefault();
        showMenu($(this).parents(".menu-parent")); 
    });
    $(".close-button").live('click', function(event) {
        event.preventDefault();
        hideMenu($(this).parents(".menu-parent"));
    });


    $("body").click(function(event) {
        if (!$(event.target).closest("#navigation, #navigation > div, #navigation > a").length) {
            hideMenu($("#navigation")); 
        };
        if (!$(event.target).closest("#grower, #grower > div, #grower > a").length) {
            hideMenu($("#grower")); 
        };
        if (!$(event.target).closest("#account, #account > div, #account > a").length) {
            hideMenu($("#account")); 
        };
        if (!$(event.target).closest("#cart, #cart > div, #cart > a").length) {
            hideMenu($("#cart")); 
        };
    });

});
