jQuery(function($) {

    /* -----------------------------------------
    Floating Header
    ----------------------------------------- */
    if ( $("body").hasClass("floating-header") ){
        const header = document.querySelector('.adore-header');
        var lastScroll = 0;
        window.onscroll = function() {
            if (window.pageYOffset > 200) {
                header.classList.add('fix-header');
                setTimeout(function() { //give them a second to finish scrolling before doing a check
                    var scroll = $(window).scrollTop();
                    if (scroll > lastScroll + 30) {
                        $("body").removeClass("scroll-up");
                    } else if (scroll < lastScroll - 30) {
                        $("body").addClass("scroll-up");
                    }
                    lastScroll = scroll;
                }, 1000);
            } else {
                header.classList.remove('fix-header');
            }
        };
        $(window).on('load resize', function() {
            $(document).ready(function() {
                var divHeight = $('.bottom-header-part').height();
                $('.bottom-header-outer-wrapper').css('min-height', divHeight + 'px');
            });
        });
    }

    /* -----------------------------------------
    Banner Section
    ----------------------------------------- */
    $('.banner-section-wrapper.style-3').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        nextArrow: '<button class="adore-arrow slide-next fas fa-angle-right"></button>',
        prevArrow: '<button class="adore-arrow slide-prev fas fa-angle-left"></button>',
        responsive: [
        {
            breakpoint: 769,
            settings: {
                arrows: false,
            }
        }
        ]
    });

});