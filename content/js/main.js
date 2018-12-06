
$(document).ready(function(){


    var $site = $('html, body'),
        $sections = $('section[id]');

    // SCROLL FUNC START
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

    // SCROLL FUNC END

    $('#carousel').slick({
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
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

    function applyValidationMessage($form, vMsg) {
        $form.find('.validation-messages').text('Please fix the highlighted issues');
        $.each(vMsg, function(key, val){
            $form.find('input[name="'+ key +'"]').siblings('.help-block').text(val);
        });
    }

    $(document).on('click', '[data-user-logout]', function(event) {
    
        event.preventDefault();

        $.ajax({
            url: './lib/logout.php',
            type: 'POST',
            data: {},
            success: function(reply) {
                location.reload();
            }
        });
    });


    $(document).on('click', '[data-user-auth]', function(event) {
        event.preventDefault();


        var $form = $(this).closest('form'),
            data = getDataFromForm($form);

        $form.find('.validation-messages').text('');
        $form.find('.help-block').text('');

        $.ajax({
            url: './lib/userAuth.php',
            type: 'POST',
            data: data,
            success: function(reply) {
                if (reply.validationError) {
                    applyValidationMessage($form, reply.validationError);
                } else {
                    location.reload();
                }
            },
            error: function(response){
                var errors = JSON.parse(response.responseText).validationError;
                applyValidationMessage($form, errors);
            }
        });
    });


    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }

    
    $(document).on('click', '[data-track-select]', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form'),
            data = {submit: "vote"};

        $form.find('.validation-messages').text('');
        $form.find('.help-block').text('');

        data["track"] = $('input:checked').val();

        data["username"] = getCookie('user');

        $.ajax({
            url: './lib/vote.php',
            type: 'POST',
            data: data,
            success: function(reply) {
                location.reload();
            }
        });
    });


});

