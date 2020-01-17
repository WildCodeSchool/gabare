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
