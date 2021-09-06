jQuery(document).ready(function () {

    let sidebar = jQuery('.sidebar-cart');
    let menubar = jQuery('.menubar');
    let filter_sidebar = jQuery('.filter-sidebar');

    // Shadow Screen
    function openShadowScreen() {
        jQuery('.shadow-screen').addClass('visible')
    }
    function closeShadowScreen() {
        jQuery('.shadow-screen').removeClass('visible');
    }

    // close function

    function removeOpenClass(element) {
        if (element.hasClass('open')) {
            element.removeClass('open');
            closeShadowScreen();
        }
    }

    // Open Sibar Mini Cart

    jQuery('.mini-cart__icon').on('click', function (e) {
        e.stopPropagation();
        removeOpenClass(menubar);

        sidebar.addClass('open');
        openShadowScreen();
    });

    // Open menubar

    jQuery('#btn-bar').on('click', function (e) {
        e.stopPropagation();

        removeOpenClass(sidebar);

        menubar.addClass('open');

        openShadowScreen()
    })

    // Open Submenu Mobile

    jQuery('.menubar__nav > li.menu-item-has-children').on('click', function (e) {
        e.stopPropagation();
        jQuery(this).toggleClass('show')
    });
    jQuery('.menubar__nav > li > a').on('click', function (e) {
        e.stopPropagation();
    });
    // close 

    jQuery('.close-float__icon').on('click', function () {

        removeOpenClass(sidebar);
        removeOpenClass(menubar);
        removeOpenClass(filter_sidebar);
    });


    // grid layout product
    jQuery('.product-view span[class^="product-view"]').on('click', function () {
        jQuery('.product-view span[class^="product-view"]').removeClass('active');
        jQuery(this).addClass('active');

        if (jQuery(this).hasClass('product-view-row')) {
            jQuery('ul.products').addClass('grid-row');
        } else {
            jQuery('ul.products').removeClass('grid-row');
        }
    });

    // filter sibar
    // Open menubar

    jQuery('.filter-icon').on('click', function (e) {
        e.stopPropagation();

        removeOpenClass(sidebar);

        filter_sidebar.addClass('open');

        openShadowScreen()
    })

    // // document click

    jQuery(document).on('click', function (e) {
        e.stopPropagation();

        let sidebar_length = jQuery(e.target).closest('.sidebar-cart').length;
        let menubar_length = jQuery(e.target).closest('.menubar').length;
        let filter_sidebar_length = jQuery(e.target).closest('.filter-sidebar').length;

        if (!sidebar_length) {
            removeOpenClass(sidebar);
        }
        if (!menubar_length) {
            removeOpenClass(menubar);
        }
        if (!filter_sidebar_length) {
            removeOpenClass(filter_sidebar);
        }
    })

    // menuFixed

    // var ofsetMenu = jQuery('header').offset();
    // jQuery(window).on('scroll', function () {
    //     if (jQuery(window).scrollTop() > ofsetMenu.top) {
    //         jQuery('header').addClass('menuFixed')
    //     } else {
    //         jQuery('header').removeClass('menuFixed')
    //     }
    // });

    // Open Search

    jQuery('.search-block__open').on('click', function () {
        jQuery('.search-block__form').toggleClass('visible');
    });



    // Increment - Decrement Amount product
    jQuery(document).on('click', '.quantity .increment-amount', function () {

        jQuery('.quantity input[type="number"]').trigger('change');

        let quantity = jQuery(this).closest('.quantity').find('input.input-text.qty').val();
        let num_qty = parseInt(quantity);
        // console.log(++num_qty);
        jQuery(this).closest('.quantity').find('input.input-text.qty').val(++num_qty)
    });

    jQuery(document).on('click', '.quantity .decrement-amount', function () {

        jQuery('.quantity input[type="number"]').trigger('change');
        let quantity = jQuery(this).closest('.quantity').find('input.input-text.qty').val();
        let num_qty = parseInt(quantity);

        if (num_qty > 1) {
            jQuery(this).closest('.quantity').find('input.input-text.qty').val(--num_qty)
        } else {
            return;
        }
    })

    // enable update cart
    jQuery('.quantity input[type="number"]').on('change', function () {
        jQuery('.woocommerce-cart-form .actions button.button').removeAttr("disabled");
        jQuery('.woocommerce-cart-form .actions button.button').attr("aria-disabled", false);

    })



    let submenu = jQuery('.header-nav__menu > li > .sub-menu li');

    submenu.mouseenter(function () {

        jQuery('.submenu-info').remove();
        let title = jQuery(this).find('.menu-item-link').attr('data-title');
        let thumb = jQuery(this).find('.menu-item-link').attr('data-thumb');
        let excerpt = jQuery(this).find('.menu-item-link').attr('data-excerpt');
        let url = jQuery(this).find('.menu-item-link').attr('data-url');

        let thumb_html = thumb ? `<img src="${thumb}" alt="">` : '';
        let html_submenu_info = `
                                <div class="submenu-info">
                                    <div class="submenu-info__ctn">
                                        <div class="submenu-info__content">
                                            <div class="submenu-info__title">${title}</div>
                                            <div class="submenu-info__excerpt">${excerpt}</div>
                                            <div class="submenu-info__link"><a href="${url}">Xem tất cả</a></div>
                                        </div>
                                        <div class="submenu-info__thumb">
                                          ${thumb_html}
                                        </div>
                                    </div>
                                </div>`;

        jQuery(this).closest('.sub-menu').append(html_submenu_info)
    })

    jQuery('.submenu-info').mouseleave(function (e) {
        e.stopPropagation();
        jQuery('.submenu-info').remove();
    })
    jQuery('.header-nav__menu > li').mouseleave(function (e) {
        e.stopPropagation();
        jQuery('.submenu-info').remove();
    });



    function convertNumberAttr(elm) {
        let rm_percent = Number(elm.replace('%', ''));
        let data_num = Math.round(rm_percent);

        return data_num;
    }



    function calculatorCircle(data) {
        // một vòng tròn = 20
        let a_circle = 100 / 5;
        let data_num = convertNumberAttr(data);


        let remainder = data_num % a_circle; // phần dư
        let int_num = data_num - remainder; // phần nguyên

        let arr_int = [];

        // tính phần nguyên để ra được vòng tròn
        for (let i = 0; i < int_num; ++i) {

            arr_int.push(20);

            int_num = int_num - 20;
        }

        arr_int.push(remainder); // đẩy phần dư vào mảng các phần nguyên trước đó

        return arr_int;
    }

    // set width circle

    function setWidthCircle(element, arr_circle) {

        element.each((index, elm) => {
            if (calculatorCircle(arr_circle)[index]) {
                let circle_w = (calculatorCircle(arr_circle)[index] / 20) * 100;
                jQuery(elm).css('width', circle_w + '%');
            }
        });
    }

    function getDataPercent(data) {
        data.each((index, element) => {
            var percent = jQuery(element).attr('data-percent');
            var circle = jQuery(element).closest('.attr-product__value').find('ul li span');
            setWidthCircle(circle, percent);
        })
    }

    let taste_percent = jQuery('.attr-product__percent-taste');
    let taste_bold_percent = jQuery('.attr-product__percent-taste-bold');
    let sour_percent = jQuery('.attr-product__percent-sour');

    getDataPercent(taste_percent);
    getDataPercent(taste_bold_percent);
    getDataPercent(sour_percent);



    // rating 

    jQuery(document).on('mouseover', '.woocommerce-Reviews .comment-form .stars a', function (e) {
        e.stopPropagation();

        var prevStars = jQuery(this).prevAll();

        jQuery(this).addClass('hovered');
        prevStars.addClass('hovered');
    });

    jQuery(document).on('mouseout', '.woocommerce-Reviews .comment-form .stars a', function (e) {
        e.stopPropagation();

        var prevStars = jQuery(this).prevAll();

        jQuery(this).removeClass('hovered');
        prevStars.removeClass('hovered');
    });

    setTimeout(() => {
        let ratings = jQuery('.comment-text .star-rating .rating');
        ratings.each((index, rating) => {

            var rating_ct = jQuery(rating).text();
            var rating_num = Number(rating_ct.trim());
            rating_num ? rating_num : 0;

        
            if (rating_num != 0) {
                jQuery(rating).closest('.star-rating').append('<div class="star-icon">Được xếp hạng&ensp;</div>');

                for (var i = 0; i < rating_num; ++i) {
                    jQuery(rating).closest('.star-rating').find('.star-icon').append('<i class="fas fa-star"></i>');
                }
            }
        });

    }, 500);


    // average rating star product

    let average_ratings = jQuery('.average-rating .val-average-rating');

    average_ratings.each( (index, average_rating) => {

        let val_rating = jQuery(average_rating).val();
        let num_rating = Number(val_rating.trim());

        let full_star = 5; // 5 sao = 100
        let one_star  = 1;  // 1 sao = 20

        let percent_rating = ( num_rating / full_star ) * 100;
        jQuery(average_rating).closest('.ratings-wrap').find('.front-stars').css('width', percent_rating + '%');
    }); 


}); // close ready 

window.onload = function () {

    setTimeout(() => {
        var stars = document.querySelectorAll('.woocommerce-Reviews .comment-form .stars a');

        stars.forEach((star) => {

            star.addEventListener('click', function (e) {

                stars.forEach((sibling) => {
                    if (sibling.classList.contains('selected')) {
                        sibling.classList.remove('selected');
                    }
                })

                var prevStars = e.target.previousElementSibling;

                e.target.classList.add('selected');

                for (let i = 0; prevStars != null; ++i) {

                    prevStars.classList.add('selected');

                    prevStars = prevStars.previousElementSibling;
                }
            })
        });

    }, 500)

}

// coupon checkout
var parentCoupon = document.getElementById("m_coupon_code_field");
if (parentCoupon) {
    coupon = document.getElementById("m_coupon_code"),
        wrapCoupon = parentCoupon.querySelector(".woocommerce-input-wrapper");

    var tag = document.createElement("span"),
        text = document.createTextNode("Áp dụng");
    tag.classList.add('submit_coupon');
    tag.appendChild(text);
    wrapCoupon.appendChild(tag);

    var submitCoupon = parentCoupon.querySelector(".submit_coupon"),
        inputHiddenCoupon = document.getElementById("coupon_code");

    coupon.onfocus = function () {
        submitCoupon.style.display = "inline-block";
    }

    submitCoupon.addEventListener('click', function () {
        var valCoupon = coupon.value,
            buttonHiddenSubmit = document.querySelector('.checkout_coupon button[type="submit"]');

        inputHiddenCoupon.setAttribute('value', valCoupon);
        buttonHiddenSubmit.click();

    });
}


// back to top

let buttonBackToTop = document.getElementById('backtotop-btn');

window.onscroll = function () { scrollFunction() };

function scrollFunction() {

    if (document.body.scrollTop > 1500 || document.documentElement.scrollTop > 1500) {
        buttonBackToTop.classList.add('show-btn')
    } else {
        buttonBackToTop.classList.remove('show-btn');
    }
}

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}