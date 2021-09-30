import jQuery from 'jquery-slim'
import Foundation from 'foundation-sites'
import 'fitvids'
import 'motion-ui'
import inView from 'in-view'
import anime from 'animejs'

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
    // console.log(e);
});

jQuery('.dot').center();
jQuery('.fullscreen').center();
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
     jQuery(".video-container").fitVids();
    // fitvids(".video-container");
    // jQuery(document).foundation();
    console.log(fitvids(".video-container"));
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

    // video.appendTo('.video-container');

    jQuery(document).on('scroll', function () {
        let animeObject = false;
        if (!(window.scrollY < 170) && !(window.scrollY > 180)) {

            if (animeObject === false) {
                // setTimeout(function () {
                anime({
                    targets: ".top-menu.sticky",
                    opacity: [0, 1],
                    duration: 500,
                    loop: 1,
                    backgroundColor: '#FFF',
                    // borderBottomRadius: ['0%', '10%'],
                    easing: 'easeInOutQuad',
                    complete: function () {
                        // tl.pause();
                        // jQuery(".fullscreen").hide();
                    }
                });
            }
            animeObject = true;
            // }, 1000);
            jQuery('.top-menu').addClass('border-bottom');
        } else {
            // animeObject = true;
            jQuery('.top-menu').removeClass('border-bottom');
        }
    });

});