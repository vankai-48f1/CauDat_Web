<?php get_header() ?>

<?php get_template_part('template-parts/header'); ?>
<!-- Page Content -->
<div class="container">
    <?php
    $categories = get_the_category();
    $category_id = $categories[0]->cat_ID;
    $post_showroom = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'showposts' => 3,
        'cat' => $category_id,
        'order'          => 'DESC',
        'orderby'        => 'date',
    );


    $query_post_showroom = new WP_Query($post_showroom);

    if ($query_post_showroom->have_posts()) : ?>
        <div class="showroom">
            <?php while ($query_post_showroom->have_posts()) : $query_post_showroom->the_post(); ?>
                <div class="showroom__item">

                    <a href="<?php the_permalink(); ?>" class="showroom__image-wrap">
                        <?php the_post_thumbnail() ?>
                    </a>

                    <div class="showroom__content">
                        <h2 class="showroom__title mg-bt-1">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="hover-red"><?php the_title(); ?></a>
                        </h2>
                        <div class="showroom__excerpt mg-bt-1"><?php the_excerpt() ?></div>

                        <div class="showroom__link-box align-r mg-bt-1">
                            <a href="<?php the_permalink(); ?>" class="showroom__link hover-red">Xem chi tiết</a>
                        </div>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata(); ?>

</div>
<!-- /.container -->
<?php get_footer() ?>