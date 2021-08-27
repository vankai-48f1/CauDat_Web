<?php

// woocommerce support images
add_theme_support('woocommerce', array(
    'woo_large' => 900
));


// thay đổi ký hiệu tiền tệ VND
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'VND':
            $currency_symbol = 'VND';
            break;
    }
    return $currency_symbol;
}






// ajax cart number 
add_filter('woocommerce_add_to_cart_fragments', 'misha_add_to_cart_fragment');

function misha_add_to_cart_fragment($fragments)
{

    global $woocommerce;

    $fragments['.cart-number'] = '<div class="mini-cart__amount cart-number">' . $woocommerce->cart->cart_contents_count . '</div>';
    return $fragments;
}




// remove action woocommerce

function my_remove_default_woo()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

    remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
    remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
}
add_action('init', 'my_remove_default_woo', 10);





// add rating 

function caudat_add_rating()
{
    echo    '<div class="ratings-wrap cl-prm">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>';
}

// add_action('woocommerce_after_shop_loop_item_title', 'caudat_add_rating', 5);





// Change text add to cart

add_filter('woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 30, 2);
function replace_loop_add_to_cart_button($button, $product)
{
    $button_text = __("Buy now", "woocommerce");
    $button = '<a class="m_button_add_to_cart hover-red" href="' . $product->get_permalink() . '">' . $button_text .
        '&ensp;<span class="cart-icon"><i class="fas fa-cart-plus"></i>&ensp;<i class="fas fa-angle-double-right"></i></span>' .
        '</a>';

    return $button;
}




// Hover translate thumbnail product

if (!function_exists('caudat_woocommerce_template_loop_product_thumbnail')) {

    /**
     * Get the product thumbnail for the loop.
     */
    function caudat_woocommerce_template_loop_product_thumbnail()
    {
        global $product;
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<div class="woo-loop-thumbnail">';

        echo woocommerce_get_product_thumbnail();

        $categories = $product->get_category_ids();

        if (in_array(20, $categories)) :
            get_template_part('template-parts/attribute', 'product');
        endif;
        echo '</div>';
    }

    add_action('woocommerce_before_shop_loop_item_title', 'caudat_woocommerce_template_loop_product_thumbnail', 10);
}




if (!function_exists('caudat_woocommerce_catalog_ordering')) {

    /**
     * Output the product sorting options.
     */
    function caudat_woocommerce_catalog_before_loop()
    {
        echo '<div class="product-header">';
        echo '<div class="product-header-left">';
        echo '<div class="filter-icon"></div>';
        woocommerce_catalog_ordering();
        echo '</div>';


        echo '<div class="product-header-right">';
        woocommerce_result_count();

        echo '<div class="product-view">
                <span class="product-view-column active"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                <span class="product-view-row"><i class="fas fa-list"></i></span>
            </div>';

        echo '</div>'; // close right


        echo '</div>'; // close header
    }
    add_action('woocommerce_before_shop_loop', 'caudat_woocommerce_catalog_before_loop', 30);
}


// woocommerce_template_loop_add_to_cart

if (!function_exists('caudat_woocommerce_template_loop_add_to_cart')) {
    function caudat_woocommerce_template_loop_add_to_cart()
    {
        global $product;
        echo '<div class="product-info">';
        woocommerce_template_loop_product_link_open(); // Open link
        woocommerce_template_loop_product_title(); // Title product
        caudat_add_rating(); // Rating
        woocommerce_template_loop_price(); // Price product

        $categories = $product->get_category_ids();

        if (in_array(20, $categories)) :
            get_template_part('template-parts/attribute', 'product');
        endif;

        woocommerce_template_loop_product_link_close(); // Close link

        woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }

    add_action('woocommerce_after_shop_loop_item', 'caudat_woocommerce_template_loop_add_to_cart', 10);
}


if (!function_exists('caudat_single_product_description')) {

    function caudat_single_product_description()
    {
        woocommerce_output_product_data_tabs();
    }

    add_action('caudat_description_tabs', 'caudat_single_product_description');
}

// Single product 

function caudat_single_product_gu()
{
    global $product;

    if ($product->get_attribute('pa_gu')) :
        echo '<div class="sg-product-gu">( ' . $product->get_attribute('pa_gu') . ')</div>';
    endif;
}

add_action('woocommerce_single_product_summary', 'caudat_single_product_gu', 7);


function caudat_descriptions_content()
{
    get_template_part('template-parts/description', 'product');
}

add_action('caudat_descriptions', 'caudat_descriptions_content', 5);


// add addtribute product after price
function caudat_attribute_after_price()
{
    global $product;
    $categories = $product->get_category_ids();

    if (in_array(20, $categories)) :
        get_template_part('template-parts/attribute', 'product');
    endif;
}

add_action('woocommerce_single_product_summary', 'caudat_attribute_after_price', 15);




// Rename tabs description product
add_filter('woocommerce_product_tabs', 'caudat_rename_tabs_product');

function caudat_rename_tabs_product($tabs)
{
    $tabs['description']['title'] = 'Chi tiết sản phẩm';

    $cach_pha = get_field('cach_pha');
    if ($cach_pha) {
        $tabs['additional_information']['title'] = 'Cách pha';
        $tabs['additional_information']['callback'] = 'caudat_cach_pha';
    } else {

        add_filter( 'woocommerce_product_tabs', 
        function ($tabs) {
            unset( $tabs['additional_information'] );
            return $tabs;
        }
        , 98 );
    }

    return $tabs;
}

function caudat_cach_pha()
{
    echo get_field('cach_pha');
}
// Rename tabs description heading product
add_filter('woocommerce_product_description_heading', 'caudat_rename_tabs_heading_product');
function caudat_rename_tabs_heading_product($heading)
{

    return '';
}

// Related product
add_action('woocommerce_after_single_product_summary', 'caudat_woocommerce_output_related_products', 20);

function caudat_woocommerce_output_related_products()
{

    $args = array(
        'posts_per_page' => 5,
        'columns'        => 5,
        'orderby'        => 'rand', // @codingStandardsIgnoreLine.
    );

    woocommerce_related_products(apply_filters('woocommerce_output_related_products_args', $args));
}

add_filter('woocommerce_product_related_products_heading', function () {

    return 'Sản phẩm liên quan';
});


//  wrap add to cart

function caudat_woocommerce_before_add_to_cart_button()
{
    echo '<div class="wrap-add-to-cart">';
}

function caudat_woocommerce_after_add_to_cart_button()
{
    echo '</div>';
}


add_action('woocommerce_before_add_to_cart_button', 'caudat_woocommerce_before_add_to_cart_button');
add_action('woocommerce_after_add_to_cart_button', 'caudat_woocommerce_after_add_to_cart_button');


// dynamic price
function caudat_variable_product_elements()
{
    if (is_product()) {
        global $post;
        $product = wc_get_product($post->ID);
        if ($product->is_type('variable')) {

            // remove price after title
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

            // add title before dynamic price
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
            add_action('woocommerce_before_variations_form', 'woocommerce_template_single_title', 10);

            // add price dynamic after new title
            remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
            add_action('woocommerce_before_variations_form', 'woocommerce_single_variation', 20);

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            add_action('woocommerce_before_variations_form', 'woocommerce_template_single_excerpt', 30);

            // remove gu after defaul title
            remove_action('woocommerce_single_product_summary', 'caudat_single_product_gu', 7);
            add_action('woocommerce_before_variations_form', 'caudat_single_product_gu', 13);

            // remove gu after defaul title
            remove_action('woocommerce_single_product_summary', 'caudat_attribute_after_price', 15);
            add_action('woocommerce_before_variations_form', 'caudat_attribute_after_price', 22);

            // remove rating defaul single product
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
            add_action('woocommerce_before_variations_form', 'caudat_template_single_rating', 18);
        }
    }
}
add_action('woocommerce_before_single_product', 'caudat_variable_product_elements');


// // define the woocommerce_cart_contents_count callback 
// function filter_woocommerce_cart_contents_count($unique_product_qty) { 
//     // make filter magic happen here... 
//     $unique_product_qty = count(WC()->cart->get_cart());
//     return $unique_product_qty; 
// };          
// // add the filter 
// add_filter( 'woocommerce_cart_contents_count', 'filter_woocommerce_cart_contents_count', 15, 1 );


// custom rating 

function caudat_template_single_rating () {
    if ( post_type_supports( 'product', 'comments' ) ) {
        wc_get_template( 'single-product/rating.php' );
    }
}




// custom check-out form

// remove field checkout
add_filter('woocommerce_checkout_fields', 'remove_field_checkout');

function remove_field_checkout($fields)
{
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_last_name']);

    return $fields;
}




add_filter('woocommerce_checkout_fields', 'm_custom_override_checkout_fields');

// Our hooked in function - $fields is passed via the filter!
function m_custom_override_checkout_fields($fields)
{
    $fields['billing']['billing_first_name'] = array(
        'type' => 'text',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('Họ tên*', 'placeholder', 'woocommerce'),
        'required' => true,
        'priority' => 1
    );

    $fields['billing']['billing_phone'] = array(
        'type' => 'number',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('Điện thoại', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('m-col-50 m-billing-phone'),
        'priority' => 2
    );

    $fields['billing']['billing_email'] = array(
        'type' => 'text',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('E-mail', 'placeholder', 'woocommerce'),
        'required' => false,
        'class' => array('m-col-50 m-billing-email'),
        'priority' => 3
    );

    $fields['billing']['billing_address_1'] = array(
        'type' => 'text',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('Địa chỉ*', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('m-col-50 m-billing-address'),
        'priority' => 4
    );

    $fields['billing']['billing_last_name'] = array(
        'type' => 'hidden',
        'label' => __(null, 'woocommerce'),
        'required' => false,
        'class' => array('d-none'),
        'priority' => 6,
    );

    $fields['billing']['m_coupon_code'] = array(
        'type' => 'text',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('Promo code', 'placeholder', 'woocommerce'),
        'required' => false,
        'priority' => 6,
        'class' => array('m-col-50 m_cus_coupon_code'),
    );

    $fields['billing']['billing_notice'] = array(
        'type' => 'textarea',
        'label' => __(null, 'woocommerce'),
        'placeholder' => _x('Chú thích đơn hàng', 'placeholder', 'woocommerce'),
        'required' => false,
        'priority' => 7
    );



    return $fields;
}




// Before checkout add container

function caudat_open_container_checkout()
{
    echo '<div class="checkout-container">';
}
add_action('woocommerce_before_checkout_form', 'caudat_open_container_checkout');

function caudat_close_container_checkout()
{
    echo '</div>';
}
add_action('woocommerce_after_checkout_form', 'caudat_close_container_checkout');





// custom coupon
function caudat_checkout_coupon_form()
{
    wc_get_template(
        'checkout/form-coupon.php',
        array(
            'checkout' => WC()->checkout(),
        )
    );
}
add_action('woocommerce_after_checkout_form', 'caudat_checkout_coupon_form', 5);

add_action('woocommerce_thankyou', 'thankyou_custom_items_data', 20, 1);
function thankyou_custom_items_data($order_id)
{
    // Get an instance of the the WC_Order Object
    $order = wc_get_order($order_id);

    $items_data = array();

    foreach ($order->get_items() as $item_id => $item) {

        // Get an instance of corresponding the WC_Product object
        $product = $item->get_product();

        $items_data[$item_id] = array(
            'name'       => $product->get_name(),
            'sku'        => $product->get_sku(),
            'thumbnail'  => $product->get_image(),
            'quantity'   => $item->get_quantity(),
            'item_total' => number_format($item->get_total(), 2)
        );
    }
}



// pagination product
add_filter('loop_shop_per_page', 'caudat_change_per_page_pagination_shop', 20);

function caudat_change_per_page_pagination_shop($cols)
{
    $cols = 9;
    return $cols;
}

function caudat_pagination_product()
{
    echo '<div class="pagination-product">';
    m_paginate();
    echo '</div>';
}

add_action('woocommerce_after_shop_loop', 'caudat_pagination_product', 10);
