import jQuery from 'jquery-slim'
import('foundation-sites')
import('fitvids')
import('motion-ui')

import('../sass/app.sass')

$.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
        $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
        $(window).scrollLeft()) + "px");
    return this;
}

inView('.in-view-p').on('enter', function (e) {
    // console.log(e);
});

$('.dot').center();
$('.fullscreen').center();
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

$(window).on('resize', function () {
    $('.dot').center();
});

$(document).ready(function () {
    $(".fullscreen").center().show();
    $("#thing-with-videos").fitVids();
    setTimeout(function () {
        anime({
            targets: ".fullscreen",
            opacity: [1, 0],
            duration: 500,
            loop: 1,
            complete: function () {
                tl.pause();
                $(".fullscreen").hide();
            }
        });
    }, 1000);

    $('ul.dropdown.menu li a').on('mouseover', function () {

        /**
         * top bar animation
         * anime();
         */
    });
    $(".video-container").fitVids();
    $(document).foundation();

    const video = $('<video />', {
        id: 'video',
        class: 'video-props'
    }).prop({
        muted: true,
        autoplay: true,
        loop: true,
    });

    $('<source />', {
        type: 'video/mp4',
        src: 'videos/Head_Banner.mp4'
    }).appendTo(video);

    // video.appendTo('.video-container');

    $(document).on('scroll', function () {
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
                        // $(".fullscreen").hide();
                    }
                });
            }
            animeObject = true;
            // }, 1000);
            $('.top-menu').addClass('border-bottom');
        } else {
            // animeObject = true;
            $('.top-menu').removeClass('border-bottom');
        }
    });

});