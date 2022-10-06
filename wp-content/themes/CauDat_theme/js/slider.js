jQuery(document).ready(function () {
  // function slider 

  function generalSingleSlider(slider) {
    jQuery(slider).slick({
      dots: true,
      arrows: false,
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
    });
  }

  // generalSingleSlider('.section-slider')
  generalSingleSlider('.ss-collections__list')
  generalSingleSlider('.members')

  jQuery('.section-slider').slick({
    dots: true,
    arrows: false,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
  });

  jQuery('.ss-product__slider').slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 2000,
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

  jQuery('.about-us__slider').slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 5000,
  });


  jQuery('.showroom-info__gallery').slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 5000,
  });

  jQuery('.about-us__top-slide').slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 5000,
  });
})