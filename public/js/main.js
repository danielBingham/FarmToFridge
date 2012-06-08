/**
* File: main.js
*
* Description:  Primary javascript file for Farm to Fridge open source farmer's market. 
*      Contains all javascript that will be used on multiple pages, or as part of the 
*      layout of the site. 
*/


// {{{ hideMenu(jqMenuParent)

/**
* Hide the menu passed as a JQuery object.
*/
function hideMenu(jqMenuParent) { 
    jqMenuParent.children(".close-menu").hide();
    jqMenuParent.children(".open-menu").show(); 
    jqMenuParent.children(".menu").hide();
}

// }}}
// {{{ showMenu(jqMenuParent)

/**
* Show the menu passed as a JQuery object.
*/
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

// }}}

// {{{ refreshCartMenu()

function refreshCartMenu() {
    $.ajax({
        url: '/cart/refresh-menu',
        success: function(data) {
            var jsonData = jQuery.parseJSON(data);
            $("#cart #items").html(jsonData.order[0].items);
            $("#cart #products").html(jsonData.order[0].products);
            $("#cart #total").html(jsonData.order[0].total);
            $("#cart #display-total-open").css('display', 'inline-block').html('( ' + jsonData.order[0].total + ' )');
            $("#cart #display-total-close").css('display', 'inline-block').html('( ' + jsonData.order[0].total + ' )'); 
        }
    });
}

// }}}

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
        }
        if (!$(event.target).closest("#grower, #grower > div, #grower > a").length) {
            hideMenu($("#grower")); 
        }
        if (!$(event.target).closest("#account, #account > div, #account > a").length) {
            hideMenu($("#account")); 
        }
        if (!$(event.target).closest("#cart, #cart > div, #cart > a").length) {
            hideMenu($("#cart")); 
        }
        if(!$(event.target).closest(".amount-form").length) {
            $(".amount-form .amount").val(''); 
            $(".amount-form").hide();
        }
    });

    $("a.add-to-cart-link").live('click', function(event) {
        event.preventDefault();
        var productOffset = $(this).parents('.product').offset();
        var buttonOffset = $(this).offset();


        var amountForm = $(this).parents('.product').children('.amount-form');
        amountForm.css('top', buttonOffset.top - productOffset.top);
        amountForm.css('left', buttonOffset.left - productOffset.left);
        amountForm.css('display', 'block');

        amountForm.children('input').focus();
    });


    $(".amount-form .amount").live('keyup', function(event) {
        if(event.keyCode == 13) {
            var id = $(this).siblings(".product-id").val();
            var amount = $(this).val();

            $.ajax({
                url: '/cart/add/id/' + id + '/amount/' + amount,
                success: function(data) {
                    $(".amount-form .amount").val('');
                    $(".amount-form").hide(); 
                    refreshCartMenu();
                }
            });  
        }
    });
});
