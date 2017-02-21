function updateSlideTeaser() {
    var sliderWidth = $('.home-slider').outerWidth();
    var teaserWidth = $('.home-slider .teaser').outerWidth();

    $('.home-slider .teaser').css({
        marginTop: -$('.home-slider .teaser').outerHeight() / 2,
        marginLeft: (sliderWidth / 2) - (teaserWidth / 2),
        opacity: 1
    });

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

function buildDatepicker() {
    $('.datepicker').datetimepicker({
        format: 'DD.MM.YYYY',
        keepOpen: true
    });
    $(".check-in").on("dp.hide", function (e) {
        $('.check-out').data("DateTimePicker").minDate(e.date);
    });
    $(".check-out").on("dp.hide", function (e) {
        $('.check-in').data("DateTimePicker").maxDate(e.date);
    });
}

$(document).ready(function () {
    createMobileNavigation();
    buildDatepicker();

    $('.owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        loop: true,
        autoplay: true,
        autoHeight: true,
        lazyLoad: false,
        autoplaySpeed: 1000,
        onInitialized: function () {
            updateSlideTeaser();
        },
        onTranslate: function (e) {
            $(e.target).find('.teaser').animate({'opacity': 0}, 500);
        },
        onTranslated: function (e) {
            $(e.target).find('.teaser').animate({'opacity': 1}, 500);
        }
    });

    $('.room-single-gallery').owlCarousel({
        items: 3,
        dots: false,
        nav: false
    });

    $(".fancybox").fancybox();

    $('.contact-form').submit(function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        $.ajax({
            type: 'POST',
            url: 'http://hotelcitysavoy.com/api/web/mailer/sendmail',
            data: {
                'subject': 'Nova poruka od: ' + data[0].value,
                'from': data[1].value,
                'to': 'reception@hotelcitysavoy.com',
                'body': data[2].value
            }
        }).done(function (response) {
            if (response.status === 200) {
                $('.contact-form')[0].reset();
                $('.contact-form .alert').show('fast');
            }
        });
    });

    $('.fast-booking-form').submit(function (e) {
        e.preventDefault();
        generateBookingModal($(this));
    });

    $('.make-request').click(function (e) {
        e.preventDefault();
        generateBookingModal($(this));
    });
});

function generateBookingModal(form) {
    $('#booking-modal').load('np-templates/booking.php', function () {
        var self = $(this);
        buildDatepicker();
        self.modal();
        if (form) {
            $.each(form.serializeArray(), function (_, kv) {
                self.find('[name="' + kv.name + '"]').val(kv.value);
            });
        }

        $(this).find('form').submit(function (e) {
            e.preventDefault();

            var formData = {};
            $.each($(this).serializeArray(), function (_, kv) {
                formData[kv.name] = kv.value;
            });

            $.ajax({
                type: 'POST',
                url: 'http://hotelcitysavoy.com/api/web/mailer/booking',
                data: {
                    'from': 'booking@hotelcitysavoy.com',
                    'to': 'reservations@hotelcitysavoy.com',
                    'body': formData
                }
            }).done(function (response) {
                if (response.status === 200) {
                    $('.alert-success-booking').addClass('animate-in');
                    self.modal('hide');
                    setTimeout(function () {
                        $('.alert-success-booking').removeClass('animate-in');
                        self.empty();
                    }, 3000);
                }
            });
        });
    });
}

$(window).resize(function () {
    updateSlideTeaser();
});