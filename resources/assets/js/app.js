window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
global.$ = global.jQuery = require('jquery');
global.Slideout = require('slideout/dist/slideout.min.js');
global.SimpleBar = require('simplebar/dist/simplebar.min.js');
global.owlCarousel = require('owl.carousel/dist/owl.carousel.min.js');

// -----------------------------------------
//             THEME CHANGE
// -----------------------------------------

window.onload = function () {
    if (document.cookie.split(';').filter((item) => item.includes('dark=true')).length) {
        document.documentElement.setAttribute('data-theme', 'dark');
        checkbox.setAttribute('checked', true);
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
};

let checkbox = document.querySelector('input[id=theme-switch]');

checkbox.addEventListener('change', function () {
    if (this.checked) {
        trans();
        document.documentElement.setAttribute('data-theme', 'dark');
        document.cookie = "dark=true";
    } else {
        trans();
        document.documentElement.setAttribute('data-theme', 'light');
        document.cookie = "dark=false";
    }
});

let trans = () => {
    document.documentElement.classList.add('transition');
    window.setTimeout(() => {
        document.documentElement.classList.remove('transition')
    }, 500)
};

// -----------------------------------------
//             SLIDEOUT MENU
// -----------------------------------------

let slideout = new Slideout({
    'panel': document.getElementById('panel'),
    'menu': document.getElementById('menu'),
    'side': 'right',
    'padding': 256,
    'tolerance': 70
});

slideout.on('translate', function () {
    $('#menu').show();
});

slideout.on('beforeopen', function () {
    $('.main-top-navbar-sidebar-toggle-btn').addClass('visible');
    $('#menu').show();
});

slideout.on('close', function () {
    $('.main-top-navbar-sidebar-toggle-btn').removeClass('visible');
    $('#menu').hide();
});

slideout.on('beforeclose', function () {
    $('.main-top-navbar-sidebar-toggle-btn').removeClass('visible');
});

// // Toggle button
document.querySelector('.main-top-navbar-sidebar-toggle-btn').addEventListener('click', function () {
    $(this).addClass('visible');
    slideout.toggle();
});

// -----------------------------------------
//             CARD SLIDER
// -----------------------------------------

$(document).ready(function () {
    $('.other-sports-games-carousel').owlCarousel({
        loop: true,
        margin: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            800: {
                items: 2
            },
            1100: {
                items: 3
            },
            1400: {
                items: 5
            }
        }
    })
});

// sidebar toggler button animation toggle
//
//
// let sidebarToggleBtn = document.getElementById("top-navbar-sidebar-toggler");
// sidebarToggleBtn.addEventListener( "click", function () {
//     sidebarToggleBtn.classList.toggle("visible");
//

// -----------------------------------------
//             HIDE NAV ON SCROLL
// -----------------------------------------

// let didScroll;
// let lastScrollTop = 0;
// let delta = 5;
// let navbarHeight = $('nav').outerHeight();
//
// $(window).scroll(function (event) {
//     didScroll = true;
// });
//
// setInterval(function () {
//     if (didScroll) {
//         hasScrolled();
//         didScroll = false;
//     }
// }, 250);
//
// function hasScrolled() {
//     let st = $(this).scrollTop();
//     if (Math.abs(lastScrollTop - st) <= delta)
//         return;
//     if (st > lastScrollTop && st > navbarHeight) {
//         // Scroll Down
//         $('.mobile-nav').addClass('nav-up').removeClass('nav-down');
//         $('.mobile-nav-bottom').addClass('mobile-down').removeClass('mobile-up');
//         $('.right-menu-inner').addClass('m-nav-hidden');
//         $('.matches-league-header').addClass('m-nav-hidden');
//         $('.matches-league-header-min').addClass('m-nav-hidden');
//     } else {
//         // Scroll Up
//         if (st + $(window).height() < $(document).height()) {
//             $('.mobile-nav').removeClass('nav-up').addClass('nav-down');
//             $('.mobile-nav-bottom').removeClass('mobile-down').addClass('mobile-up');
//             $('.right-menu-inner').removeClass('m-nav-hidden');
//             $('.matches-league-header').removeClass('m-nav-hidden');
//             $('.matches-league-header-min').removeClass('m-nav-hidden');
//         }
//     }
//
//     lastScrollTop = st;
// }
