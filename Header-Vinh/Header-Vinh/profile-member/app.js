$(document).ready(function(){
    $('.list-meamber').slick({
        slidesToShow: 1,

        //Tự động chạy
        autoplay: true,
        autoplaySpeed: 2000,

        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        dots: true,
    });
});