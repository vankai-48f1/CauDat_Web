<?php


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
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<div class="woo-loop-thumbnail">';

        echo woocommerce_get_product_thumbnail();
        get_template_part('template-parts/attribute', 'product');

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
        echo '<div class="product-info">';
        woocommerce_template_loop_product_link_open(); // Open link
        woocommerce_template_loop_product_title(); // Title product
        caudat_add_rating(); // Rating
        woocommerce_template_loop_price(); // Price product
        get_template_part('template-parts/attribute', 'product');
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
    echo '<div class="sg-product-gu">( ' . $product->get_attribute('pa_gu') . ')</div>';
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
    get_template_part('template-parts/attribute', 'product');
}

add_action('woocommerce_single_product_summary', 'caudat_attribute_after_price', 15);




// Rename tabs description product
add_filter( 'woocommerce_product_tabs', 'caudat_rename_tabs_product' );

function caudat_rename_tabs_product( $tabs ) {
	$tabs['description']['title'] = 'Chi tiết sản phẩm';

	return $tabs;

}

// Rename tabs description heading product
add_filter( 'woocommerce_product_description_heading', 'caudat_rename_tabs_heading_product' );
function caudat_rename_tabs_heading_product( $heading ){

	return '';
	
}

// Related product
add_action('woocommerce_after_single_product_summary', 'caudat_woocommerce_output_related_products', 20);

function caudat_woocommerce_output_related_products() {

    $args = array(
        'posts_per_page' => 5,
        'columns'        => 5,
        'orderby'        => 'rand', // @codingStandardsIgnoreLine.
    );

    woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

add_filter('woocommerce_product_related_products_heading',function(){

    return 'Sản phẩm liên quan';
 
 });