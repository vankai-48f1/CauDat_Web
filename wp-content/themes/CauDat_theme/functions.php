<?php
// Thêm ảnh đại diện
add_theme_support('post-thumbnails');

function my_custom_wc_theme_support()
{

    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-lightbox');

    add_theme_support('wc-product-gallery-slider');
    // add_theme_support('wc-product-gallery-zoom');
}
add_action('after_setup_theme', 'my_custom_wc_theme_support');



// Ảnh này sẽ hiện ở ngoài blog
add_image_size('blog-thumbnail', 700, 350, true);

// Ảnh này sẽ hiện ở trong post
add_image_size('post-large', 900, 600, true);

add_image_size('post-small', 300, 300, true);

add_image_size('product-home', 600, 600, true);

add_theme_support('woocommerce', array(
    'thumbnail_image_width' => 200,
    'gallery_thumbnail_image_width' => 100,
    'medium_image' => 600,
));

// Khai báo menu
function register_my_menu()
{
    register_nav_menu('main-menu', __('Main Menu')); // đặt tên là Header Menu
    register_nav_menu('footer-menu', __('Footer Menu'));
    register_nav_menu('language', __('Language'));
    register_nav_menu('cate_product', __('Danh mục sản phẩm'));
    register_nav_menu('cate_news', __('Danh mục tin tức'));
}
add_action('init', 'register_my_menu');

// Khai báo sidebar
function mini_blog_widgets_init()
{
    register_sidebar(array(
        'name'            => __('Sidebar', 'sidebar'),
        'id'             => 'sidebar',
        'description'     => __('Sidebar')
    ));

    register_sidebar(array(
        'name'            => __('Search'),
        'id'             => 'search',
        'description'     => __('Search')
    ));

    register_sidebar(array(
        'name'            => __('Search product'),
        'id'             => 'search-product',
        'description'     => __('Search product'),
        'before_widget'   => '<div class="search-product">',
        'after_widget'   => '</div>',
    ));

    register_sidebar(array(
        'name'            => __('Login'),
        'id'             => 'login',
        'description'     => __('Login')
    ));

    register_sidebar(array(
        'name'            => __('Mini Cart'),
        'id'             => 'mini-cart',
        'description'     => __('Mini Cart'),
        'before_widget'   => '<div>',
        'after_widget'   => '</div>',
    ));

    // register_sidebar(array(
    //     'name'            => __('Lọc theo Gu'),
    //     'id'             => 'filter-gu',
    //     'description'     => __('Lọc theo Gu'),
    //     'before_title'   => '<h3>',
    //     'after_title'   => '</h3>',
    //     'before_widget'   => '<div class="filter-gu">',
    //     'after_widget'   => '</div>',
    // ));

    register_sidebar(array(
        'name'            => __('Lọc theo kg'),
        'id'             => 'filter-kg',
        'description'     => __('Lọc theo kg'),
        'before_title'   => '<h3>',
        'after_title'   => '</h3>',
        'before_widget'   => '<div class="filter-kg">',
        'after_widget'   => '</div>',
    ));

    register_sidebar(array(
        'name'            => __('Lọc theo giá'),
        'id'             => 'filter-price',
        'description'     => __('Lọc theo giá'),
        'before_title'   => '<h3>',
        'after_title'   => '</h3>',
        'before_widget'   => '<div class="filter-price">',
        'after_widget'   => '</div>',
    ));
}
add_action('widgets_init', 'mini_blog_widgets_init');


// Tạo related posts
function mini_blog_related_post($title = 'Bài viết liên quan', $count = 5)
{

    global $post;
    $tag_ids = array();
    $current_cat = get_the_category($post->ID);
    $current_cat = $current_cat[0]->cat_ID;
    $this_cat = '';
    $tags = get_the_tags($post->ID);
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->term_id;
        }
    } else {
        $this_cat = $current_cat;
    }

    $args = array(
        'post_type'   => get_post_type(),
        'numberposts' => $count,
        'orderby'     => 'rand',
        'tag__in'     => $tag_ids,
        'cat'         => $this_cat,
        'exclude'     => $post->ID
    );
    $related_posts = get_posts($args);

    if (empty($related_posts)) {
        $args['tag__in'] = '';
        $args['cat'] = $current_cat;
        $related_posts = get_posts($args);
    }
    if (empty($related_posts)) {
        return;
    }
    $post_list = '';
    foreach ($related_posts as $related) {

        $post_list .= '<div class="media mb-4 ">';
        $post_list .= '<img class="mr-3 img-thumbnail" style="width: 150px" src="' . get_the_post_thumbnail_url($related->ID, 'post-small') . '" alt="Generic placeholder image">';
        $post_list .= '<div class="media-body align-self-center">';
        $post_list .= '<h5 class="mt-0"><a href="' . get_permalink($related->ID) . '">' . $related->post_title . '</a></h5>';
        $post_list .= get_the_category($related->ID)[0]->cat_name;

        $post_list .= '</div>';
        $post_list .= '</div>';
    }

    return sprintf('
			<div class="card my-4">
				<h4 class="card-header">%s</h4>
				<div class="card-body">%s</div>
			</div>
		', $title, $post_list);
}



function m_logo_web($wp_customize)
{
    $wp_customize->add_section(
        'logo',
        array(
            'title' => 'Logo',
            'description' => 'logo',
            'priority' => 25
        )
    );

    $wp_customize->add_setting('Logo', array('default' => ''));
    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'Logo', array(
            'label' => 'Logo',
            'section' => 'logo',
            'settings' => 'Logo'
        ))
    );

    $wp_customize->add_setting('Logo-ft', array('default' => ''));
    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'Logo-ft', array(
            'label' => 'Logo footer',
            'section' => 'logo',
            'settings' => 'Logo-ft'
        ))
    );
}
add_action('customize_register', 'm_logo_web');


// add_filter('nav_menu_link_attributes', 'menu_post_ids');
// function menu_post_ids($title, $item, $args, $depth)
// {
//     // $postid = url_to_postid($val['href']);
//     // $val['data-postid'] = $postid;
//     echo '<pre>', var_dump($item->post_excerpt ),'</pre>';
//     // return $val;
// }

// add theme option menu bar admin 
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}


// PAGINATION

if (!function_exists('m_paginate')) {
    function m_paginate()
    {
        if (paginate_links() != '') { ?>
            <div class="pagination-post">
                <?php
                global $wp_query;
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'prev_text'    => __('<i class="far fa-chevron-double-left"></i>'),
                    'next_text'    => __('<i class="far fa-chevron-double-right"></i>'),
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages
                ));
                ?>
            </div>
        <?php }
    }
}


// function part
require_once get_template_directory() . '/func-part/breadcrumbs.php';
require_once get_template_directory() . '/func-part/custom-woo.php';


// Ajax add to cart 

require_once get_template_directory() . '/func-part/ajax-add-to-cart.php';


// custom menu

//add_filter('nav_menu_link_attributes', 'caudat_main_menu', 10, 3);
function caudat_main_menu($atts, $item, $args)
{

    $main_menu = wp_get_nav_menu_items('main-menu');
    $secondary_menu = wp_get_nav_menu_items('secondary-menu');

    $page_ids = array();

    // Menu Main
    if ($main_menu) {
        addAddtributeMenuItem($main_menu, $item->ID, $atts);
    }
    // Menu Secondary
    if ($secondary_menu) {
        addAddtributeMenuItem($secondary_menu, $item->ID, $atts);
    }


    return $atts;
}

/**
 * Insert attribute to menu item
 *
 *
 * @param menu    $menu  array menu items of a navigation menu.
 * @param menu_item_id    $menu_item_id  id item menu.
 * @return void 
 */
function addAddtributeMenuItem($menu, $menu_item_id, &$atts)
{
    //var_dump($atts);
    foreach ($menu as $menu_item) {

        if ($menu_item_id == $menu_item->ID) {
            $atts['class'] = 'menu-item-link';
            if ($menu_item->type === 'post_type') {
                $atts['data-thumb'] = get_the_post_thumbnail_url($menu_item->object_id);
                $atts['data-excerpt'] = $menu_item->description;
            }
            if ($menu_item->type === 'taxonomy') {
                $thumb_id    = get_term_meta($menu_item->object_id, 'thumbnail_id', true);
                $img_src     = wp_get_attachment_url($thumb_id);

                $atts['data-title'] = $menu_item->title;
                $atts['data-url'] = $menu_item->url;

                $atts['data-thumb'] = $img_src;
                $atts['data-excerpt'] = category_description($menu_item->object_id);
            }
        }
    }
}


// custom comment

if (!class_exists('Caudat_Custom_Walker_Comment')) {
    class Caudat_Custom_Walker_Comment extends Walker_Comment
    {
        protected function comment($comment, $depth, $args)
        {
            if ('div' === $args['style']) {
                $tag       = 'div';
                $add_below = 'comment';
            } else {
                $tag       = 'li';
                $add_below = 'div-comment';
            }

            $commenter          = wp_get_current_commenter();
            $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

            if ($commenter['comment_author_email']) {
                $moderation_note = __('Your comment is awaiting moderation.');
            } else {
                $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
            }
        ?>
            <<?php echo $tag; ?> <?php comment_class($this->has_children ? 'parent' : '', $comment); ?> id="comment-<?php comment_ID(); ?>">
                <?php if ('div' !== $args['style']) : ?>
                    <div id="div-comment-<?php comment_ID(); ?>" class="comment-body comment-row">
                    <?php endif; ?>

                    <div class="comment-awaiting">
                        <?php if ('0' == $comment->comment_approved) : ?>
                            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                            <br />
                        <?php endif; ?>
                    </div>
                    <div class="comment-author vcard comment-block">
                        <?php
                        if (0 != $args['avatar_size']) {
                            echo get_avatar($comment, $args['avatar_size']);
                        }
                        ?>
                        <div class="comment-meta-wrap">
                            <div class="comment-author-name">
                                <?php
                                $comment_author = get_comment_author_link($comment);

                                if ('0' == $comment->comment_approved && !$show_pending_links) {
                                    $comment_author = get_comment_author($comment);
                                }

                                printf(
                                    /* translators: %s: Comment author link. */
                                    __('%s <span class="says">says:</span>'),
                                    sprintf('<cite class="fn">%s</cite>', $comment_author)
                                );
                                ?>

                                <div class="comment-meta commentmetadata ">
                                    <?php
                                    printf(
                                        '<a href="%s">%s</a>',
                                        esc_url(get_comment_link($comment, $args)),
                                        sprintf(
                                            /* translators: 1: Comment date, 2: Comment time. */
                                            __('%1$s'),
                                            get_comment_date('', $comment)
                                        )
                                    );

                                    edit_comment_link(__('(Edit)'), ' &nbsp;&nbsp;', '');
                                    ?>
                                </div>
                            </div>

                            <div class="comment-user-content">
                                <?php
                                comment_text(
                                    $comment,
                                    array_merge(
                                        $args,
                                        array(
                                            'add_below' => $add_below,
                                            'depth'     => $depth,
                                            'max_depth' => $args['max_depth'],
                                        )
                                    )
                                );
                                ?>
                            </div>
                            <?php
                            comment_reply_link(
                                array_merge(
                                    $args,
                                    array(
                                        'add_below' => $add_below,
                                        'depth'     => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'before'    => '<div class="reply">',
                                        'after'     => '</div>',
                                    )
                                )
                            );
                            ?>
                        </div>
                    </div>

                    <?php if ('div' !== $args['style']) : ?>
                    </div>
                <?php endif; ?>
        <?php
        }
    }
}


// change reply text

function caudat_comment_reply_text($link)
{
    $link = str_replace('Reply', 'Trả lời 123', $link);
    return $link;
}
add_filter('comment_reply_link', 'caudat_comment_reply_text');


// change logo login
function my_login_logo()
{ ?>
        <style type="text/css">
            #login h1 a,
            .login h1 a {
                background-image: url('<?php echo get_template_directory_uri(); ?>/images/Logo-from-cau-dat.png');
                background-size: 150px;
                background-position: center;
                width: 100%;
            }
        </style>
    <?php }
add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');




if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title'    => __('Popup'),
            'icon_url'      => 'dashicons-admin-plugins',
        )
    );
}

// Redirect after login
function caudat_custom_after_login()
{
    return home_url();
}
add_filter('woocommerce_login_redirect', 'caudat_custom_after_login');


// Insert coupon code to database
function cau_dat_insert_data_to_database()
{
    global $wpdb;
    $date = date('Y-m-d H:i:s');
    $referenceId = uniqid();
    $table = 'wp_caudatposts';
    $table_2 = 'wp_caudatpostmeta';

    for ($i = 1; $i <= 500; $i++) { // start for
        echo str_pad($i, 3, '0', STR_PAD_LEFT);

        // Table 1
        $data = array(
            'post_author' => 7,
            'post_date' => $date,
            'post_date_gmt' => $date,
            'post_content' => '',
            'post_title' => 'FCD_PVD' . str_pad($i, 3, '0', STR_PAD_LEFT),
            'post_excerpt' => 'Event 18/10',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'fcd_pvd' . str_pad($i, 3, '0', STR_PAD_LEFT),
            'to_ping'   => '',
            'pinged'   => '',
            'post_modified'   => $date,
            'post_modified_gmt'   => $date,
            'post_content_filtered'   => '',
            'post_parent'   => 0,
            'guid'  => '',
            'menu_order' => 0,
            'post_type' => 'shop_coupon',
            'post_mime_type' => '',
            'comment_count' => 0,
        );


        $wpdb->insert($table, $data);
        $coupon_id = $wpdb->insert_id;
        echo $coupon_id;

        // Table 2
        $data_2 = array(
            array(
                'post_id' => $coupon_id,
                'meta_key' => '_edit_lock',
                'meta_value' => strtotime($date)
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => '_edit_last',
                'meta_value' => '1'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'discount_type',
                'meta_value' => 'fixed_product'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'coupon_amount',
                'meta_value' => '30000'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'individual_use',
                'meta_value' => 'yes'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'usage_limit',
                'meta_value' => '1'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'usage_limit_per_user',
                'meta_value' => '1'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'limit_usage_to_x_items',
                'meta_value' => '0'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'usage_count',
                'meta_value' => '0'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'date_expires',
                'meta_value' => '1668963600'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'free_shipping',
                'meta_value' => 'no'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'product_categories',
                'meta_value' => 'a:1:{i:0;i:20;}'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'exclude_product_categories',
                'meta_value' => 'a:6:{i:0;i:25;i:1;i:22;i:2;i:23;i:3;i:21;i:4;i:163;i:5;i:24;}'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'exclude_sale_items',
                'meta_value' => 'no'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => 'minimum_amount',
                'meta_value' => '100000'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => '_wc_gla_sync_status',
                'meta_value' => 'not-synced'
            ),
            array(
                'post_id' => $coupon_id,
                'meta_key' => '_used_by',
                'meta_value' => '7'
            )
        );
        foreach ($data_2 as $item) {
            $wpdb->insert($table_2, $item);
        }
    } // end for
}
add_action('wp_ajax_insert_data', 'cau_dat_insert_data_to_database');
add_action('wp_ajax_nopriv_insert_data', 'cau_dat_insert_data_to_database');

// Custom sale price
// For variable product
add_filter('woocommerce_variable_price_html', 'custom_variable_prices_range_formatted', 100, 2);
function custom_variable_prices_range_formatted($price, $product)
{
    global $woocommerce_loop;
    // Not on single products
    if ((is_product() && isset($woocommerce_loop['name']) && !empty($woocommerce_loop['name'])) || !is_product()) {
        // For on sale variable product
        $regular_price_min = $product->get_variation_regular_price('min', true);
        $regular_price_max = $product->get_variation_regular_price('max', true);
        if ($product->is_on_sale()) {

            $active_price_min = $product->get_variation_price('min', true);
            $active_price_max = $product->get_variation_price('max', true);


            if ($regular_price_min !== $active_price_min || $regular_price_max !== $active_price_max) {
                // Regular price range (for <del> html tag)
                if ($regular_price_min !== $regular_price_max) {
                    $regular_price_del_html = sprintf(
                        '<del class="custom-before-sale-price">%s – %s</del>',
                        wc_price($regular_price_min) . get_mass_follow_price_product($product, $regular_price_min),
                        wc_price($regular_price_max) . get_mass_follow_price_product($product, $regular_price_max)
                    );
                } else {
                    $regular_price_del_html = sprintf(
                        '<del class="custom-before-sale-price">%s</del>',
                        wc_price($regular_price_min) . get_mass_follow_price_product($product, $regular_price_min)
                    );
                }

                // Active price range (for <ins> html tag)
                if ($active_price_min !== $active_price_max) {
                    $active_price_ins_html = sprintf(
                        '<ins class="custom-after-sale-price">%s – %s</ins>',
                        wc_price($active_price_min) . get_mass_follow_price_product($product, $active_price_min),
                        wc_price($active_price_max) . get_mass_follow_price_product($product, $active_price_max)
                    );
                } else {
                    $active_price_ins_html = sprintf(
                        '<ins class="custom-after-sale-price">%s</ins>',
                        wc_price($active_price_min) . get_mass_follow_price_product($product, $active_price_min)
                    );
                }

                $price = sprintf('<p class="custom-price-variation">%s %s</p>', $regular_price_del_html, $active_price_ins_html);
            }
        } else {
            $price = sprintf(
                        '%s – %s',
                        wc_price($regular_price_min) . get_mass_follow_price_product($product, $regular_price_min),
                        wc_price($regular_price_max) . get_mass_follow_price_product($product, $regular_price_max)
                    );
            
            // $price =  wc_price($regular_price_min) . get_mass_follow_price_product($product, $regular_price_min) .'–'. 
            //         wc_price($regular_price_max) . get_mass_follow_price_product($product, $regular_price_max);
        }
    }
    return $price;
}

// Custom price simple product
add_filter('woocommerce_get_price_html', 'custom_price_simple_product_html', 100, 2);
function custom_price_simple_product_html($price, $product)
{

    if ($product->is_type('simple')) {
        $price_rgl = $product->get_regular_price();
        $price_sale = $product->get_sale_price();
        if (!empty($price_sale) && $price_sale !== $price_rgl) {
            $regular_price_del_html = sprintf(
                '<del class="custom-before-sale-price">%s</del>', wc_price($price_rgl)
            );

            $active_price_ins_html = sprintf(
                '<ins class="custom-after-sale-price">%s</ins>', wc_price($price_sale)
            );
        } else {
            $regular_price_del_html = '';
            $active_price_ins_html = sprintf(
                '<ins>%s</ins>', wc_price($price_rgl)
            );
        }

        $price_html = $regular_price_del_html . $active_price_ins_html;

        $price = sprintf('<p class="price custom-price-simple-product">%s</p>', $price_html);
    }

    return $price;
}

// Lấy khối lượng theo mức giá sản phẩm
function get_mass_follow_price_product($product, $price)
{
    if ($product->is_type('variable')) {
        
        if(!$product->get_attribute( 'pa_khoi-luong' )) return false;
        
        $variations = $product->get_available_variations();
        foreach ($variations as $variation) {
            if ((float) $price == $variation['display_regular_price'] || (float) $price == $variation['display_price']) {
                $mass = '&nbsp;(' . $variation['attributes']['attribute_pa_khoi-luong'] . ')';
                break;
            } else {
                $mass = '';
            }
        }
        return $mass;
    }
    return false;
}


/*
 * Thêm nút Xem thêm vào phần mô tả của danh mục sản phẩm
 * Author: Le Van Toan - https://levantoan.com
*/
add_action('wp_footer', 'devvn_readmore_taxonomy_flatsome');
function devvn_readmore_taxonomy_flatsome()
{

    ?>
        <style>
            .term-description {
                overflow: hidden;
                position: relative;
                margin-bottom: 20px;
                padding-bottom: 25px;
            }

            .devvn_readmore_taxonomy_flatsome {
                text-align: center;
                cursor: pointer;
                position: absolute;
                z-index: 10;
                bottom: 0;
                width: 100%;
                background: #fff;
            }

            .devvn_readmore_taxonomy_flatsome:before {
                height: 55px;
                margin-top: -45px;
                content: "";
                background: -moz-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
                background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
                background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff00', endColorstr='#ffffff', GradientType=0);
                display: block;
            }

            .devvn_readmore_taxonomy_flatsome a {
                color: #000;
                display: block;

            }

            .devvn_readmore_taxonomy_flatsome span.arrow {
                top: -5px;
            }

            .devvn_readmore_taxonomy_flatsome span,
            .devvn_readmore_taxonomy_flatsome span span {
                display: block;
                right: 0;
                left: 0;
                margin: auto;
                position: absolute;
            }

            .devvn_readmore_taxonomy_flatsome span.arrow:before {
                content: "";
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAMCAYAAAAH4W+EAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDQ4OCwgMjAyMC8wNy8xMC0yMjowNjo1MyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDc3NEIyN0EyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDc3NEIyNzkyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjAgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozNjdCMUQ3OTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozNjdCMUQ3QTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ph5ikagAAAGHSURBVHjaYmAAAg8Pj14vLy87Bjzg////JGFPT09GHx8fNnxmguwE2Q1iMwI1eAI1bgPZxcjIOJ+Dg6Ns/fr1b3E5hhjg7e3NuG3bNpyKAwMDhX/8+NEFNC8J7AhGRi8mHh6evUBGHRD/AkkAFVwHujQWmwFANWCMx4eMYWFheB0BMhtkB8guoFk/QXaD3QBTAAxG1b9//84AKnCCWrqPmZk5Y8uWLbfxRRdSKDADHfAXl1pC5jNiczFQcS8Qi4JcDBRqBbq4c/Xq1b+wWRAaGgoygxEo/w+HPNuXL1/KgcxqoJnsQDNfA3Ex0NGLUUIbh2YhoOZuoMZEqJobTExM6UDNhxhIAKDE+O/fv5lApgYsDQI9VQp09DuMaKeWQZR6hBmfgbdv335oaGg4+zcQAB1hDTTYFMhMUlNTewGUu4QrMf769WszUK0NKAMAcRMvL2/Mxo0b7+Gzi5HYYCaU2MhJ7GQ5BF9ihkrhTYxUdwhagZSIZAbRaYhqDsGSmBnIyVXIACDAAM34JXWPolNhAAAAAElFTkSuQmCC);
                display: block;
                width: 25px;
                right: 0;
                left: 0;
                top: -5px;
                margin: auto;
                position: absolute;
                opacity: 1;
                height: 15px;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .devvn_readmore_taxonomy_flatsome .arrow:before {
                animation: animate-arrow-3 1s ease-in-out infinite .2s;
            }

            .devvn_readmore_taxonomy_flatsome span span {
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAMCAYAAAAH4W+EAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDQ4OCwgMjAyMC8wNy8xMC0yMjowNjo1MyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDc3NEIyN0EyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDc3NEIyNzkyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjAgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozNjdCMUQ3OTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozNjdCMUQ3QTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ph5ikagAAAGHSURBVHjaYmAAAg8Pj14vLy87Bjzg////JGFPT09GHx8fNnxmguwE2Q1iMwI1eAI1bgPZxcjIOJ+Dg6Ns/fr1b3E5hhjg7e3NuG3bNpyKAwMDhX/8+NEFNC8J7AhGRi8mHh6evUBGHRD/AkkAFVwHujQWmwFANWCMx4eMYWFheB0BMhtkB8guoFk/QXaD3QBTAAxG1b9//84AKnCCWrqPmZk5Y8uWLbfxRRdSKDADHfAXl1pC5jNiczFQcS8Qi4JcDBRqBbq4c/Xq1b+wWRAaGgoygxEo/w+HPNuXL1/KgcxqoJnsQDNfA3Ex0NGLUUIbh2YhoOZuoMZEqJobTExM6UDNhxhIAKDE+O/fv5lApgYsDQI9VQp09DuMaKeWQZR6hBmfgbdv335oaGg4+zcQAB1hDTTYFMhMUlNTewGUu4QrMf769WszUK0NKAMAcRMvL2/Mxo0b7+Gzi5HYYCaU2MhJ7GQ5BF9ihkrhTYxUdwhagZSIZAbRaYhqDsGSmBnIyVXIACDAAM34JXWPolNhAAAAAElFTkSuQmCC);
                width: 25px;
                top: 9px;
                height: 15px;
                opacity: .3;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .devvn_readmore_taxonomy_flatsome .arrow span {
                animation: animate-arrow-1 1s ease-in-out infinite;
            }

            .devvn_readmore_taxonomy_flatsome span.arrow:after {
                content: "";
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAMCAYAAAAH4W+EAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDQ4OCwgMjAyMC8wNy8xMC0yMjowNjo1MyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDc3NEIyN0EyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDc3NEIyNzkyRDY0MTFFQjkzMDRBMjIxNzc0RTBDODQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjAgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozNjdCMUQ3OTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozNjdCMUQ3QTJDQUIxMUVCOENCRERGNDFFOTA1OTlERCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ph5ikagAAAGHSURBVHjaYmAAAg8Pj14vLy87Bjzg////JGFPT09GHx8fNnxmguwE2Q1iMwI1eAI1bgPZxcjIOJ+Dg6Ns/fr1b3E5hhjg7e3NuG3bNpyKAwMDhX/8+NEFNC8J7AhGRi8mHh6evUBGHRD/AkkAFVwHujQWmwFANWCMx4eMYWFheB0BMhtkB8guoFk/QXaD3QBTAAxG1b9//84AKnCCWrqPmZk5Y8uWLbfxRRdSKDADHfAXl1pC5jNiczFQcS8Qi4JcDBRqBbq4c/Xq1b+wWRAaGgoygxEo/w+HPNuXL1/KgcxqoJnsQDNfA3Ex0NGLUUIbh2YhoOZuoMZEqJobTExM6UDNhxhIAKDE+O/fv5lApgYsDQI9VQp09DuMaKeWQZR6hBmfgbdv335oaGg4+zcQAB1hDTTYFMhMUlNTewGUu4QrMf769WszUK0NKAMAcRMvL2/Mxo0b7+Gzi5HYYCaU2MhJ7GQ5BF9ihkrhTYxUdwhagZSIZAbRaYhqDsGSmBnIyVXIACDAAM34JXWPolNhAAAAAElFTkSuQmCC);
                display: block;
                width: 25px;
                top: 2px;
                right: 0;
                left: 0;
                margin: auto;
                position: absolute;
                opacity: .5;
                height: 15px;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .devvn_readmore_taxonomy_flatsome .arrow:after {
                animation: animate-arrow-2 1s ease-in-out infinite .1s;
            }

            /*  .devvn_readmore_taxonomy_flatsome a:after {
                content: '';
                width: 0;
                right: 0;
                border-top: 6px solid #e90000;
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                display: inline-block;
                vertical-align: middle;
                margin: -2px 0 0 5px;
            }*/
            .devvn_readmore_taxonomy_flatsome_less:before {
                display: none;
            }

            /* .devvn_readmore_taxonomy_flatsome_less a:after {
                border-top: 0;
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                border-bottom: 6px solid #318A00;
            }*/
            @keyframes animate-arrow-1 {
                0% {
                    transform: translateY(-40px);
                    opacity: 0;
                }

                <style>70%,
                100% {
                    transform: translateY(0);
                    opacity: .3;
                }
            }

            @keyframes animate-arrow-2 {
                0% {
                    transform: translateY(-40px);
                    opacity: 0;
                }

                <style>70%,
                100% {
                    transform: translateY(0);
                    opacity: .3;
                }
            }

            @keyframes animate-arrow-3 {
                0% {
                    transform: translateY(-40px);
                    opacity: 0;
                }

                <style>70%,
                100% {
                    transform: translateY(0);
                    opacity: .3;
                }
            }
        </style>
        <script>
            (function($) {
                $(document).ready(function() {
                    $(window).on('load', function() {
                        if ($('.term-description').length > 0) {
                            var wrap = $('.term-description');
                            var current_height = wrap.height();
                            var your_height = 320;
                            if (current_height > your_height) {
                                wrap.css('height', your_height + 'px');
                                wrap.append(function() {
                                    return '<div class="devvn_readmore_taxonomy_flatsome devvn_readmore_taxonomy_flatsome_show"><a title="Xem thêm" href="javascript:void(0);"><span class="arrow"><span></span></span>Xem thêm</a></div>';
                                });
                                wrap.append(function() {
                                    return '<div class="devvn_readmore_taxonomy_flatsome devvn_readmore_taxonomy_flatsome_less" style="display: none"><a title="Thu gọn" href="javascript:void(0);">Thu gọn </a></div>';
                                });
                                $('body').on('click', '.devvn_readmore_taxonomy_flatsome_show', function() {
                                    wrap.removeAttr('style');
                                    $('body .devvn_readmore_taxonomy_flatsome_show').hide();
                                    $('body .devvn_readmore_taxonomy_flatsome_less').show();
                                });
                                $('body').on('click', '.devvn_readmore_taxonomy_flatsome_less', function() {
                                    wrap.css('height', your_height + 'px');
                                    $('body .devvn_readmore_taxonomy_flatsome_show').show();
                                    $('body .devvn_readmore_taxonomy_flatsome_less').hide();
                                });
                            }
                        }
                    });
                });
            })(jQuery);
        </script>
    <?php

}
