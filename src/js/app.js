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

let lastScrollTop = 0;
let scroll = 'down';

$(window).scroll(function (event) {
    let st = $(this).scrollTop();
    if (st > lastScrollTop) {
        scroll = 'down';
    } else {
        scroll = 'up';
    }
    lastScrollTop = st;
});

inView('.in-view-x').on('enter', function (e) {
    let from = $(e).data('from');
    let to = $(e).data('to');

    let t = $(e).data('translate');

    if (typeof from === 'undefined') {
        from = -500;
    }

    if (typeof to === 'undefined') {
        to = 0;
    }

    let translate = [from, to];

    let params = {
        targets: e,
        opacity: [0.5, 1],
        duration: 800,
        loop: 1,
        backgroundColor: '#FFF',
        easing: 'easeOutExpo',
        complete: function () {
            this.animatables.forEach(
                e => console.log(jQuery(e.target).addClass('gray-image'))
            );
        }
    };

    if (typeof t === 'undefined') {
        t = 'X';
    }


    if (scroll === 'down') {
        if (t === 'Y' && translate[0] > 0) {
            translate[0] = -translate[0];
        }
    } else {
        if (t === 'Y' && translate[0] < 0) {
            translate[0] = Math.abs(translate[0]);
        }
    }

    params['translate' + t] = translate;

    return anime(params);
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

let resize = false;

function showMenu() {

    resize = true;

    let wWidth = jQuery(window).width();
    console.log(wWidth);

    let params2 = {
        targets: '.off-c',
        left: [-20, 0],
        opacity: [0, 1],
        duration: 800,
        loop: 1,
        easing: 'easeOutExpo',
        complete: function () {
        }
    };

    let params3 = {
        targets: '.off-c',
        left: [0, -20],
        opacity: [1, 0],
        duration: 900,
        loop: 1,
        easing: 'easeInExpo',
        complete: function () {
        }
    };

    if (wWidth < 651) {
        setTimeout(function () {
            anime(params2);
        }, 1000);

    } else {
        anime(params3);
    }
}

jQuery(window).on('resize', function () {
    jQuery('.dot').center();
});

jQuery(document).ready(function () {

    showMenu();

    jQuery(document).foundation();
    let offCannvas = $('.off-canvas');
    offCannvas.on('opened.zf.offCanvas', function () {
        console.log('opened.zf.offCanvas', this);

        jQuery(this).addClass();

        let options = {
            targets: '.off-c',
            left: [jQuery(this).width()-20, jQuery(this).width() - 1],
            backgroundColor: [ '#4f1e61', '#4f1e61'],
            opacity: [0, 1],
            duration: 500,
            loop: 1,
            easing: 'easeInExpo',
            complete: function () {
            }
        };

        anime(options);
    });

    offCannvas.on('close.zf.offCanvas', function () {
        console.log('close.zf.offCanvas', this);

        let options = {
            targets: '.off-c',
            left: [jQuery(this).width(), 0],
            backgroundColor: '#fcd436',
            duration: 500,
            opacity: [0, 1],
            loop: 1,
            easing: 'easeInExpo',
            complete: function () {
            }
        };

        anime(options);
    });

    offCannvas.on('openedEnd.zf.offCanvas', function () {
        console.log('openedEnd.zf.offCanvas');
    });

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

    let dotFooter = jQuery('.dot-footer');

    dotFooter.hover(function () {
        $(this).css('cursor', 'pointer');

    }, function () {
        $(this).css('cursor', 'default')
    });

    dotFooter.click(function () {
        jQuery([document.documentElement, document.body]).animate(
            {scrollTop: jQuery('#top').offset().top},
            500);
        return false;
    });
});