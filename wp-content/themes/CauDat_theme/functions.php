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

add_filter('nav_menu_link_attributes', 'caudat_main_menu', 10, 3);
function caudat_main_menu($atts, $item, $args)
{

    $main_menu = wp_get_nav_menu_items('main-menu');
    $page_ids = array();

    foreach ($main_menu as $menu_item) {

        // echo '<pre>', var_dump($menu_item), '</pre>';

        if ($item->ID == $menu_item->ID) {
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



    return $atts;
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