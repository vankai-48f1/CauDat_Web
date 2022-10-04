<!-- Sidebar Widgets Column -->
<div class="filter-sidebar">
    <?php
    if (is_tax('product_cat') || is_shop() || is_product_category() || is_product()) { ?>

        <div class="sidebar-row">
            <h3>Danh mục</h3>

            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'cate_product',
                    'depth'  => 2,
                    'container'  => '',
                    'menu_class'  => 'sidebar-list',
                )
            );
            ?>
        </div>

        <!-- <div class="sidebar-row">
            < ?php dynamic_sidebar('filter-gu') ?>
        </div> -->

        <div class="sidebar-row">
            <?php
            $filter_gu = array('filter_name' => 'loc_theo_gu');
            get_template_part('template-parts/filter/filter', 'by-attribute', $filter_gu);
            ?>
        </div>

        <div class="sidebar-row">
            <?php
            $filter_cach_pha = array('filter_name' => 'loc_theo_cach_pha');
            get_template_part('template-parts/filter/filter', 'by-attribute', $filter_cach_pha);
            ?>
        </div>

        <!--<div class="sidebar-row">-->
        <!--    < ?php-->
        <!--    $filter_muc_dich_kinh_doanh = array('filter_name' => 'loc_theo_muc_dich_kinh_doanh');-->
        <!--    get_template_part('template-parts/filter/filter', 'by-attribute', $filter_muc_dich_kinh_doanh);-->
        <!--    ?>-->
        <!--</div>-->

        <div class="sidebar-row">
            <?php dynamic_sidebar('filter-kg') ?>
        </div>

        <div class="sidebar-row">
            <?php dynamic_sidebar('filter-price') ?>
        </div>

    <?php } else { ?>



        <div class="sidebar-row">
            <ul class="sidebar-search">
                <?php dynamic_sidebar('search'); ?>
            </ul>
        </div>

        <div class="sidebar-row">
            <h3>Danh mục</h3>

            <!-- <ul class="sidebar-list">

                < ?php
                $args_news = array(
                    'type'      => 'post',
                    'parent'    => 19,
                    'orderby'   => 'date',
                    'order'     => 'DESC',
                    'number'    => 10,
                    'child_of'  => 0,
                    'taxonomy'  => 'category',
                    'hide_empty' => 0
                );
                $cate_news = get_categories($args_news);
                foreach ($cate_news as $category) : ?>
                    <li>
                        <a href="< ?php echo $category->slug; ?>">
                            < ?php echo $category->name; ?>
                        </a>
                    </li>
                < ?php endforeach; ?>

            </ul> -->

            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'cate_news',
                    'depth'  => 2,
                    'container'  => '',
                    'menu_class'  => 'sidebar-list',
                )
            );
            ?>
        </div>

        <div class="sidebar-row">
            <h3>Bài đăng gần đây</h3>

            <ul class="sidebar-latest-news">

                <?php
                $latest_news = array(
                    'post_type'      => 'post',
                    'post_status' => 'publish',
                    'cate'    => 19,
                    'orderby'   => 'date',
                    'order'     => 'DESC',
                    'showposts'    => 4,
                );
                $query_latest_news = new WP_Query($latest_news);

                // The Loop
                if ($query_latest_news->have_posts()) :
                    while ($query_latest_news->have_posts()) : $query_latest_news->the_post() ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="sidebar-latest-news__thumb">
                                <?php the_post_thumbnail() ?>
                            </a>
                            <div class="sidebar-latest-news__header">
                                <h3 class="sidebar-latest-news__title">
                                    <a href="<?php the_permalink(); ?>" class="hover-red"><?php the_title() ?></a>
                                </h3>
                                <p class="sidebar-latest-news__date">
                                    <?php echo get_the_date('F j, Y');  ?>
                                </p>
                            </div>
                        </li>
                <?php endwhile;
                endif;

                // Reset Post Data
                wp_reset_postdata();

                ?>
            </ul>
        </div>

        <div class="sidebar-row">
            <h3>Tags</h3>

            <ul class="tags-news">

                <?php
                $args_tags = array(
                    'type'      => 'post',
                    'orderby'   => 'date',
                    'order'     => 'DESC',
                    'number'    => 10,
                    'child_of'  => 0,
                    'taxonomy'  => 'post_tag',
                    'hide_empty' => 0
                );
                $tags_list = get_categories($args_tags);
                foreach ($tags_list as $tags) : ?>
                    <li>
                        <a class="hover-red" href="<?php echo $tags->slug; ?>">
                            <?php echo $tags->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>

    <?php }
    ?>
    <div class="close-float">
        <span class="close-float__icon"></span>
    </div>
</div>