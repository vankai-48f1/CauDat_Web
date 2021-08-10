jQuery(document).ready(function () {


    // Shadow Screen
    function openShadowScreen() {
        jQuery('.shadow-screen').addClass('visible')
    }
    function closeShadowScreen() {
        jQuery('.shadow-screen').removeClass('visible');
    }



    // Open Search

    jQuery('.search-block__open').on('click', function () {
        jQuery('.search-block__form').toggleClass('visible');
    });



    // Open Sibar Mini Cart

    jQuery('.mini-cart__icon').on('click', function (e) {
        e.stopPropagation();

        jQuery('.sidebar-cart').addClass('open');
        openShadowScreen()
    });




    // Open menubar

    jQuery('#btn-bar').on('click', function (e) {
        e.stopPropagation();

        jQuery('.menubar').addClass('open');

        openShadowScreen()
    })



    // Open Submenu Mobile

    jQuery('.menubar ul li').on('click', function () {
        jQuery('.menubar ul li').removeClass('show');
        if (jQuery(this).hasClass('menu-item-has-children')) {
            jQuery(this).addClass('show')
        }
    });


    // document click

    function documentClick(element, closest, remove) {

        if (!element) {
            jQuery(closest).removeClass(remove)
            closeShadowScreen()
        } else {
            openShadowScreen()
        }
    }

    jQuery(document).on('click', function (e) {
        e.stopPropagation();

        let mini_cart = jQuery(e.target).closest('.sidebar-cart').length;
        let menubar = jQuery(e.target).closest('.menubar').length;

        documentClick(mini_cart, '.sidebar-cart', 'open')

        documentClick(menubar, '.menubar', 'open')
    })



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

    // menuFixed

    // var ofsetMenu = jQuery('header').offset();
    // jQuery(window).on('scroll', function () {
    //     if (jQuery(window).scrollTop() > ofsetMenu.top) {
    //         jQuery('header').addClass('menuFixed')
    //     } else {
    //         jQuery('header').removeClass('menuFixed')
    //     }
    // });



    // Increment - Decrement Amount product
    jQuery(document).on('click', '.quantity .increment-amount', function () {

        let quantity = jQuery(this).closest('.quantity').find('input.input-text.qty').val();
        let num_qty = parseInt(quantity);
        // console.log(++num_qty);
        jQuery(this).closest('.quantity').find('input.input-text.qty').val(++num_qty)
    });

    jQuery(document).on('click', '.quantity .decrement-amount', function () {

        let quantity = jQuery(this).closest('.quantity').find('input.input-text.qty').val();
        let num_qty = parseInt(quantity);
        
        if (num_qty > 1) {
            jQuery(this).closest('.quantity').find('input.input-text.qty').val(--num_qty)
        } else {
            return;
        }
    })
})

