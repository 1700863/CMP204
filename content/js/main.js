
$(document).ready(function(){

    var $site = $('html, body'),
        $sections = $('section[id]');


    // Updates the menu items to make an item active in relation to page scroll
    function refreshMenuHighlight () {
        var userFocus = window.pageYOffset + ($(window).height() / 3)
            , userFocus = userFocus < 0 ? 0 : userFocus
            , $focus;

        // Check which menu item corresponds to the users view
        $sections.each(function(){
            if(userFocus > $(this).offset().top) {
                $focus = $('[data-nav-scroll][href="#' + $(this).attr('id') + '"]');
            } else {
                return false;
            }
        });

        // If this item isn't the active item, make it so
        if(!$focus.hasClass('active')) {
            $('nav .active').removeClass('active');
            $focus.addClass('active');
        }

    }

    // Bindings for nav scroll events
    $(document)
        .on('click', '[data-nav-scroll], .nav-sidebar__link a', function(event){
            event.preventDefault();
            var $target = $($(this).attr('href'));
            $site.stop();
            $site.animate({
                scrollTop: $target.position().top
            }, 1000, 'linear');
        })
        .on('scroll', function(){
            refreshMenuHighlight();
        });


});