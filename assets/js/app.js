/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// eslint-disable-next-line no-unused-vars
const $ = require('jquery');
// eslint-disable-next-line import/no-extraneous-dependencies
require('bootstrap');
// eslint-disable-next-line import/no-extraneous-dependencies

require('@fortawesome/fontawesome-free/css/all.css');

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
});

// eslint-disable-next-line func-names
$('.counter-up').each(function () {
    $(this)
        .prop('Counter', 0)
        .animate({
            Counter: $(this)
                .text(),
        }, {
            duration: 4000,
            easing: 'swing',
            step(now) {
                $(this)
                    .text(Math.ceil(now));
            },
        });
});

const imgList = document.getElementById('imgList');
const scrollRight = document.getElementById('scroll-right');
const scrollLeft = document.getElementById('scroll-left');
const imgList1 = document.getElementById('imgList1');
const scrollRight1 = document.getElementById('scroll-right1');
const scrollLeft1 = document.getElementById('scroll-left1');

scrollRight.addEventListener('click', (event) => {
    imgList.scrollBy(260, 0);
});

scrollLeft.addEventListener('click', (event) => {
    imgList.scrollBy(-260, 0);
});

scrollRight1.addEventListener('click', (event) => {
    imgList1.scrollBy(260, 0);
});

scrollLeft1.addEventListener('click', (event) => {
    imgList1.scrollBy(-260, 0);
});
