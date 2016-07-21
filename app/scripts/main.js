$(document).ready(function () {
    $('.home-slider .teaser').css({
        marginTop: -$('.home-slider .teaser').outerHeight() / 2,
        marginLeft: -$('.home-slider .teaser').outerWidth() / 2,
        opacity: 1
    });

    $('.owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000
    });

    $(".fancybox").fancybox();
});