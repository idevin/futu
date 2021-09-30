import inView from 'in-view'
import anime from 'animejs'
import Foundation from 'foundation-sites'

import('../sass/app.sass')

jQuery.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", Math.max(0, ((jQuery(window).height() - jQuery(this).outerHeight()) / 2) +
        jQuery(window).scrollTop()) + "px");
    this.css("left", Math.max(0, ((jQuery(window).width() - jQuery(this).outerWidth()) / 2) +
        jQuery(window).scrollLeft()) + "px");
    return this;
}

inView('.in-view-p').on('enter', function (e) {
    return anime({
        targets: e,
        opacity: [0, 1],
        duration: 500,
        loop: 1,
        translateX: [-500, 0],
        backgroundColor: '#FFF',
        easing: 'easeInOutQuad',
        complete: function () {
        }
    });
});

jQuery('.dot').center();
jQuery('.fullscreen').center();

let foundation = Foundation;

let topMenu = jQuery('.top-menu');

let animateTopmenu = function (from, to) {
    return anime({
        targets: ".top-menu.sticky",
        opacity: [0, 1],
        duration: 500,
        loop: 1,
        translateY: [-from, to],
        backgroundColor: '#FFF',
        easing: 'easeInOutQuad',
        complete: function () {
        }
    });
}

let tl = anime.timeline().add({
    targets: '.dot',
    keyframes: [
        {
            scale: [0.7, 1],
            easing: 'easeInOutQuad',
            duration: 500,
            backgroundColor: "#fcd436"
        },
        {
            scale: [1, 0.7],
            easing: 'easeInOutQuad',
            duration: 500,
            backgroundColor: "#fcd436"
        }
    ],
    loop: true
});

jQuery(window).on('resize', function () {
    jQuery('.dot').center();
});

jQuery(document).ready(function () {

    jQuery(document).foundation();

    jQuery(".fullscreen").center().show();

    setTimeout(function () {
        anime({
            targets: ".fullscreen",
            opacity: [1, 0],
            duration: 500,
            loop: 1,
            complete: function () {
                tl.pause();
                jQuery(".fullscreen").hide();
            }
        });
    }, 1000);

    jQuery('ul.dropdown.menu li a').on('mouseover', function () {

        /**
         * top bar animation
         * anime();
         */
    });

    const video = jQuery('<video />', {
        id: 'video',
        class: 'video-props'
    }).prop({
        muted: true,
        autoplay: true,
        loop: true,
    });

    jQuery('<source />', {
        type: 'video/mp4',
        src: 'src/videos/Head_Banner.mp4'
    }).appendTo(video);

    video.appendTo('.video-container');

    let animeObject = false;

    jQuery(document).on('scroll', function () {
        if (!(window.scrollY < 170)) {
            if (animeObject === false) {
                topMenu.addClass('border-bottom');
                animateTopmenu(topMenu.height(), 0);
            }
            animeObject = true;
        } else {
            animeObject = false;
            topMenu.removeClass('border-bottom');
            animateTopmenu(topMenu.height(), 0);
        }
    });
});