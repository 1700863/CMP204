
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

    

    function getDataFromForm($form) {
        var data = {};

        $form.find('input').each(function(index, element){
            var $el = $(element);
            if($el.attr('name'))
                data[$el.attr('name')] = $el.val();
        });

        return data;

    }
        

    $(document)
        .on('click', '[data-login]', function(event) {
            event.preventDefault();

            var data = getDataFromForm($(this).closest('form'));
            console.log(data);

            $.ajax({
                url: './lib/login.php',
                type: 'POST',
                data: data,
                success: function() {
                    console.log('SUCCESS');
                },
                error: function(){
                    console.log('ERROR');
                }
            });
        })
        .on('click', '[data-register]', function(event) {
            event.preventDefault();

            var data = getDataFromForm($(this).closest('form'));
            console.log(data);

            $.ajax({
                url: './lib/register.php',
                type: 'POST',
                data: data,
                success: function() {
                    console.log('SUCCESS');
                },
                error: function(){
                    console.log('ERROR');
                }
            });
        });


});