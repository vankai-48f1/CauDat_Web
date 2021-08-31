<?php
/*
Template Name: Các hoạt động trải nghiệm
*/
?>

<?php get_header() ?>

<div class="header-part" id="header-part">
    <div class="container">
        <div class="header-part__content">
            <div class="row">
                <div class="col-md-7">
                    <div class="header-part__title">
                        <?php
                        global $post;
                        ?>
                        <h2>
                            <?php echo get_the_title($post->post_parent) ?>
                        </h2>
                    </div>

                    <div class="header-part__description">

                        <?php
                        if (is_page()) : ?>
                            <?php echo get_field('description_page', $post->post_parent) ?>
                        <?php endif; ?>

                        <?php
                        if (is_category()) : ?>
                            <?php echo category_description() ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="header-part__breadcrumb mg-t-1">
                        <?php m_breadcrumbs() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="container">
    <div class="showrom-info">
        <div class="showrom-child__title align-ct">
            <h2>
                <?php echo get_the_title() ?>
            </h2>
        </div>

        <div class="mg-bt-5">
            <!-- < ?php
            $images = get_field('gallery');
            if ($images) : ?>
                <div class="showroom-gallery" id="showroom-gallery">
                    < ?php foreach ($images as $image) : ?>
                        <a href="< ?php echo esc_url($image['url']); ?>" class="showroom-gallery__image-wrap">
                            <img class="showroom-gallery__image" src="< ?php echo esc_url($image['url']); ?>" alt="< ?php echo $image['alt']; ?>" />
                        </a>
                    < ?php endforeach; ?>
                </div>
            < ?php endif; ?> -->

            <div class="activities">
                <div class="list-posts-activities">

                    <?php
                    $news = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'showposts' => -1,
                        'cat' => 82,
                    );

                    $query_news = new WP_Query($news);
                    // The Loop
                    if ($query_news->have_posts()) :
                        while ($query_news->have_posts()) : $query_news->the_post();
                    ?>
                            <article class="list-posts__item <?php echo $i === 1 ? 'list-posts__item-first' : '' ?>">
                                <div class="list-posts__thumb">
                                    <a href="<?php the_permalink() ?>" class="list-posts__thumb-wrap">
                                        <?php the_post_thumbnail() ?>
                                    </a>
                                </div>
                                <div class="list-posts__content">

                                    <h4>
                                        <a href="<?php the_permalink() ?>" class="list-posts__item-title hover-black">
                                            <?php the_title() ?>
                                        </a>
                                    </h4>
                                    <div class="list-posts__item-excerpt">
                                        <a href="<?php the_permalink() ?>" class="hover-black">
                                            <?php the_excerpt() ?>
                                        </a>
                                    </div>

                                    <div class="mg-t-1">
                                        <a class="list-posts__read-more bg-prm hover-red" href="<?php the_permalink() ?>">Xem thêm</a>
                                    </div>
                                </div>
                            </article>
                    <?php endwhile;
                    endif;

                    // Reset Post Data
                    wp_reset_postdata();

                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>