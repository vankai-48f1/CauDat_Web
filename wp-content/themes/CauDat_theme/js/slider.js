jQuery(document).ready( function () {
    // function slider 

    function generalSingleSlider(slider) {
        jQuery(slider).slick({
            dots: true,
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
        });
    }

    generalSingleSlider('.section-slider')
    generalSingleSlider('.ss-collections__list')



    jQuery('.ss-product__slider').slick({
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        responsive: [
            {
              breakpoint: 990,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            }
        ]
    });
})