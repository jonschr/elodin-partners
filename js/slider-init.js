jQuery(document).ready(function ($) {

    $('.loop-layout-partners_slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        centerMode: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 680,
                settings: {
                    centerMode: true,
                }
            },
        ]
    });

});