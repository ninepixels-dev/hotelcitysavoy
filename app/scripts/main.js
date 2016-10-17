function updateSlideTeaser() {
    var sliderWidth = $('.home-slider').outerWidth();
    var teaserWidth = $('.home-slider .teaser').outerWidth();

    $('.home-slider .teaser').css({
        marginTop: -$('.home-slider .teaser').outerHeight() / 2,
        marginLeft: (sliderWidth / 2) - (teaserWidth / 2),
        opacity: 1
    });

    console.log($('.home-slider .teaser').outerWidth());
}
function createMobileNavigation() {
    var mainNavigation = $('.container.header .main-navigation');

    mainNavigation.after('<div class="mobile-navigation"><button class="btn btn-mobile"><span></span></button><ul></ul></div<>');
    mainNavigation.find('.col-md-5 > li').each(function () {
        $('.mobile-navigation ul').append('<li>' + $(this).html() + '</li>');
    });

    $('.mobile-navigation .btn-mobile').click(function () {
        $(this).parent('.mobile-navigation').toggleClass('open');
        $('body').toggleClass('mobile-nav-open');
    });

    $('.mobile-navigation li').has('ul').children('a').click(function (event) {
        event.preventDefault();
    });
}

$(document).ready(function () {
    updateSlideTeaser();
    createMobileNavigation();

    $('.owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        loop: true,
        autoplay: true,
        autoHeight: true,
        autoplaySpeed: 1000
    });

    $(".fancybox").fancybox();
});

$(window).resize(function () {
    updateSlideTeaser();
});

$(window).load(function () {
    updateSlideTeaser();
});