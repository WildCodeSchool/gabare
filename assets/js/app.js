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
const imgListOne = document.getElementById('imgListOne');
const scrollRightOne = document.getElementById('scroll-rightOne');
const scrollLeftOne = document.getElementById('scroll-leftOne');
const imgListTwo = document.getElementById('imgListTwo');
const scrollRightTwo = document.getElementById('scroll-rightTwo');
const scrollLeftTwo = document.getElementById('scroll-leftTwo');

scrollRight.addEventListener('click', (event) => {
    imgList.scrollBy(260, 0);
});

scrollLeft.addEventListener('click', (event) => {
    imgList.scrollBy(-260, 0);
});

scrollRightOne.addEventListener('click', (event) => {
    imgListOne.scrollBy(260, 0);
});

scrollLeftOne.addEventListener('click', (event) => {
    imgListOne.scrollBy(-260, 0);
});

scrollRightTwo.addEventListener('click', (event) => {
    imgListTwo.scrollBy(260, 0);
});

scrollLeftTwo.addEventListener('click', (event) => {
    imgListTwo.scrollBy(-260, 0);
});
