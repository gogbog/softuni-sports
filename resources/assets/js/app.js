window.Popper = require('popper.js');
require('bootstrap/dist/js/bootstrap.js');
global.$ = global.jQuery = require('jquery');
global.Slideout = require('slideout/dist/slideout.min.js');
global.SimpleBar = require('simplebar/dist/simplebar.min.js');
global.owlCarousel = require('owl.carousel/dist/owl.carousel.min.js');

// -----------------------------------------
//             THEME CHANGE
// -----------------------------------------

let checkbox = document.querySelector('input[id=theme-switch]');
window.onload = function () {
    if (document.cookie.split(';').filter((item) => item.includes('dark=true')).length) {
        document.documentElement.setAttribute('data-theme', 'dark');
        checkbox.setAttribute('checked', true);
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
};

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

let odds_checkbox = document.querySelector('input[id=odds-switch]');
let table_rows = document.querySelectorAll('.odds-table td');

window.onload = function () {
    if (document.cookie.split(';').filter((item) => item.includes('odd=american')).length) {
        odds_checkbox.setAttribute('checked', true);
        table_rows.forEach(function (row) {
            row.setAttribute('data-odd', 'american');
        });
    } else {
        table_rows.forEach(function (row) {
            row.setAttribute('data-odd', 'decimal');
        });
    }

};
if (document.body.contains(odds_checkbox)){

    odds_checkbox.addEventListener('change', function () {
        if (this.checked) {
            table_rows.forEach(function (row) {
                row.setAttribute('data-odd', 'american');
            });
            document.cookie = "odd=american";
        } else {
            table_rows.forEach(function (row) {
                row.setAttribute('data-odd', 'decimal');
            });
            document.cookie = "odd=decimal";
        }
    });
}

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
    'padding': 300,
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

let searchForm = document.getElementById("search_form");
let searchFormInput = document.getElementById("search_form_input");
searchForm.addEventListener( "click", function () {
    searchForm.classList.add("active");
    searchFormInput.focus();
});

searchForm.addEventListener( "focusout", function () {
    searchForm.classList.remove("active");
});

//Converter
let odds = {
    home: document.getElementById("homeOdds").innerHTML,
    draw: document.getElementById("drawOdds").innerHTML,
    away: document.getElementById("awayOdds").innerHTML
};

let americanCookie = document.getElementById("cookie-status").innerHTML; //cookie status

$('#odds-switch').on('change', function (e) {

    // IF AMERICAN COOKIE IS SET TO TRUE, THEN CONVERT FROM DECIMAL TO AMERICAN ODDS
    if (americanCookie === "T") {

        let americanOdds = {

            home: (odds.home - 1) * 100,
            draw: (odds.draw - 1) * 100,
            away: (odds.away - 1) * 100,

        };

       $("#tableHomeTD").innerHTML = americanOdds.home;
       $("#tableDrawTD").innerHTML = americanOdds.draw;
       $("#tableAwayTD").innerHTML = americanOdds.away;

        americanCookie.innerHTML = 'F'; // TODO COOKIE TO BE CHANGED TO FALSE FOR NEXT ITERATION
    }

    // IF AMERICAN COOKIE IS SET TO FALSE, THEN CONVERT FROM AMERICAN TO DECIMAL ODDS
    if (americanCookie === "F") {

        let decimalOdds = {

            home: (odds.home / 100) + 1,
            draw: (odds.draw / 100) + 1,
            away: (odds.away / 100) + 1,

        };

        $("#tableHomeTD").innerHTML = decimalOdds.home;
        $("#tableDrawTD").innerHTML = decimalOdds.draw;
        $("#tableAwayTD").innerHTML = decimalOdds.away;

        americanCookie.innerHTML = 'T';
    }

});