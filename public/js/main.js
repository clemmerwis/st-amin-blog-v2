/*  ---------------------------------------------------
    Template Name: Amin
    Description:  Amin magazine HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';
(function ($) {
    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        // sidebar menu dd fix
        $("#mobile-menu-wrap .slicknav_parent .slicknav_item").find("a").each(function () {
            var linkText = $(this).text();
            $(this).before(linkText + " " + '<i class="fa fa-angle-down"></i>');
            $(this).remove();
        });

        // stop and start spin w/ hover
        $(".nav-options .nav-menu").find(".mainitem").each(function () {
            $(this).hover(
                function () {
                    $(this).removeClass("spin");
                }, function () {
                    $(this).addClass("spin");
                }
            );
        })

        // Handle witch's picks hover ungrow
        $(".nav-options .nav-menu ul li.witchs-picks").hover(
            function () {
                // On hover in - remove ungrow class if it exists
                $(this).removeClass('ungrowing');
            },
            function () {
                // On hover out - add ungrow class, then remove it after animation
                var $this = $(this);
                $this.addClass('ungrowing');

                setTimeout(() => {
                    $this.removeClass('ungrowing');
                }, 400); // Match the ungrow animation duration
            }
        );

        // if login fails, click sign up modal again
        if ($('#failedLoginMessage').length) {
            $('.signup-switch-login').click();
        }

        if ($('#failedRegisterMessage').length) {
            $('.signup-switch').click();
        }

        // Simple and efficient scroll calculation with 780px header offset
        const bookCovers = document.querySelectorAll('.book-cover');
        const magazineBuyNows = document.querySelectorAll('.magazine-buy-now');
        const allSidebarElements = [...bookCovers, ...magazineBuyNows];

        const triggerPoint = 0.80; // 85% down the scrollable content
        const resetPoint = 0.15; // 15% reset point
        const headerHeight = 780; // details-hero-section height

        // Cache these values to avoid recalculating on every scroll
        let ticking = false;

        function checkScroll() {
            if (allSidebarElements.length > 0) {
                const currentScroll = window.scrollY;

                // Only calculate percentage for the area below the 780px header
                const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight - headerHeight;
                const scrollablePosition = Math.max(0, currentScroll - headerHeight);

                // Calculate percentage based only on the scrollable content area
                let scrollPercentage = scrollablePosition / scrollableHeight;

                // Clamp between 0 and 1
                scrollPercentage = Math.max(0, Math.min(1, scrollPercentage));

                allSidebarElements.forEach(function (element) {
                    if (scrollPercentage > triggerPoint && !element.classList.contains('activated')) {
                        element.classList.add('activated');
                    } else if (scrollPercentage <= resetPoint && element.classList.contains('activated')) {
                        element.classList.remove('activated');
                    }
                });
            }
            ticking = false; // Reset the tick flag
        }

        // Throttled scroll handler using requestAnimationFrame
        function onScroll() {
            if (!ticking) {
                requestAnimationFrame(checkScroll);
                ticking = true;
            }
        }

        // Use the throttled function
        $(window).on('scroll', onScroll);

        // Initial check after a brief delay to ensure DOM is ready
        setTimeout(checkScroll, 100);

        // Stripe checkout handler
        async function handleBuyNow(postId) {
            try {
                const button = event.target;
                const originalText = button.innerText || button.textContent;
                button.innerText = 'Loading...';
                button.style.pointerEvents = 'none';

                const response = await fetch(`/stripe/checkout/${postId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.url) {
                    window.location.href = data.url;
                } else {
                    button.innerText = originalText;
                    button.style.pointerEvents = 'auto';
                    alert('Unable to start checkout. Please try again.');
                }
            } catch (error) {
                console.error('Checkout error:', error);
                alert('Something went wrong. Please try again.');
                const button = event.target;
                if (button) {
                    button.innerText = 'Buy Now';
                    button.style.pointerEvents = 'auto';
                }
            }
        }

        // Make it globally accessible for onclick handlers
        window.handleBuyNow = handleBuyNow;
    });



    // $('#dataTables-example').dataTable();
    console.log('main.js loaded');

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    // Humberger Menu
    $(".humberger-open").on('click', function () {
        $(".humberger-menu-wrapper").addClass("show-humberger-menu");
        $(".humberger-menu-overlay").addClass("active");
        $(".nav-options").addClass("humberger-change");
    });

    $(".humberger-menu-overlay").on('click', function () {
        $(".humberger-menu-wrapper").removeClass("show-humberger-menu");
        $(".humberger-menu-overlay").removeClass("active");
        $(".nav-options").removeClass("humberger-change");
    });

    // Search model
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    // Create Account Form
    $('.signup-switch').on('click', function () {
        $('.signup-section').fadeIn(400);
    });

    $('.signup-close').on('click', function () {
        $('.signup-section').fadeOut(400);
    });

    // Login Form
    $('.signup-switch-login').on('click', function () {
        $('.signup-section-login').fadeIn(400);
    });

    $('.signup-login-close').on('click', function () {
        $('.signup-section-login').fadeOut(400);
    });

    // manually trigger on page that shows login form 
    if ($('.signup-section-login').data('page') === 'login') {
        $('.signup-section-login').fadeIn(400);
    }

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    var hero_s = $(".hero-slider");
    hero_s.owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*------------------
        Trending Slider
    --------------------*/
    $(".trending-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ['<span class="arrow_carrot-left"></span>', '<span class="arrow_carrot-right"></span>'],
        dotsEach: 2,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*------------------------
        Latest Review Slider
    --------------------------*/
    $(".lp-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: true,
        nav: true,
        navText: ['<span class="arrow_carrot-left"></span>', '<span class="arrow_carrot-right"></span>'],
        smartSpeed: 1200,
        autoHeight: false,
        dotsEach: 2,
        autoplay: true,
        responsive: {
            320: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });

    /*------------------------
        Update News Slider
    --------------------------*/
    $(".un-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ['<span class="arrow_carrot-left"></span>', '<span class="arrow_carrot-right"></span>'],
        smartSpeed: 1200,
        autoHeight: false,
        dotsEach: 2,
        autoplay: true,
        autoplayTimeout: 13600
    });

    /*------------------------
        Video Guide Slider
    --------------------------*/
    $(".vg-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ['<span class="arrow_carrot-left"></span>', '<span class="arrow_carrot-right"></span>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*------------------------
        Gallery Slider
    --------------------------*/
    $(".dg-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ['<span class="arrow_carrot-left"></span>', '<span class="arrow_carrot-right"></span>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*------------------
        Video Popup
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*------------------
        Barfiller
    --------------------*/
    $('#bar-1').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });
    $('#bar-2').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });
    $('#bar-3').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });
    $('#bar-4').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });
    $('#bar-5').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });
    $('#bar-6').barfiller({
        barColor: '#ffffff',
        duration: 2000
    });

    /*------------------
        Circle Progress
    --------------------*/
    $('.circle-progress').each(function () {
        var cpvalue = $(this).data("cpvalue");
        var cpcolor = $(this).data("cpcolor");
        var cpid = $(this).data("cpid");

        $(this).append('<div class="' + cpid + '"></div><div class="progress-value"></div>');

        if (cpvalue < 100) {

            $('.' + cpid).circleProgress({
                value: '0.' + cpvalue,
                size: 40,
                thickness: 2,
                startAngle: -190,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        } else {
            $('.' + cpid).circleProgress({
                value: 1,
                size: 40,
                thickness: 5,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        }
    });

    $('.circle-progress-1').each(function () {
        var cpvalue = $(this).data("cpvalue");
        var cpcolor = $(this).data("cpcolor");
        var cpid = $(this).data("cpid");

        $(this).append('<div class="' + cpid + '"></div><div class="progress-value"></div>');

        if (cpvalue < 100) {

            $('.' + cpid).circleProgress({
                value: '0.' + cpvalue,
                size: 60,
                thickness: 2,
                startAngle: -190,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        } else {
            $('.' + cpid).circleProgress({
                value: 1,
                size: 60,
                thickness: 5,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        }
    });

    $('.circle-progress-2').each(function () {
        var cpvalue = $(this).data("cpvalue");
        var cpcolor = $(this).data("cpcolor");
        var cpid = $(this).data("cpid");

        $(this).append('<div class="' + cpid + '"></div><div class="progress-value"></div>');

        if (cpvalue < 100) {

            $('.' + cpid).circleProgress({
                value: '0.' + cpvalue,
                size: 200,
                thickness: 5,
                startAngle: -190,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        } else {
            $('.' + cpid).circleProgress({
                value: 1,
                size: 200,
                thickness: 5,
                fill: cpcolor,
                emptyFill: "rgba(0, 0, 0, 0)"
            });
        }
    });
})(jQuery);
