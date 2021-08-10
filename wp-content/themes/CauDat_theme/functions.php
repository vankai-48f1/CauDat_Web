<?php
function my_custom_wc_theme_support()
{

    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-lightbox');

    add_theme_support('wc-product-gallery-slider');
    // add_theme_support('wc-product-gallery-zoom');
}
add_action('after_setup_theme', 'my_custom_wc_theme_support');

// Thêm ảnh đại diện
add_theme_support('post-thumbnails');

// Ảnh này sẽ hiện ở ngoài blog
add_image_size('blog-thumbnail', 700, 350, true);

// Ảnh này sẽ hiện ở trong post
add_image_size('post-large', 900, 600, true);

add_image_size('post-small', 250, 200, true);


// Khai báo menu
function register_my_menu()
{
    register_nav_menu('main-menu', __('Main Menu')); // đặt tên là Header Menu
    register_nav_menu('footer-menu', __('Footer Menu'));
    register_nav_menu('language', __('Language'));
    register_nav_menu('cate_product', __('Danh mục sản phẩm'));
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

    register_sidebar(array(
        'name'            => __('Lọc theo Gu'),
        'id'             => 'filter-gu',
        'description'     => __('Lọc theo Gu'),
        'before_title'   => '<h3>',
        'after_title'   => '</h3>',
        'before_widget'   => '<div class="filter-gu">',
        'after_widget'   => '</div>',
    ));

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
