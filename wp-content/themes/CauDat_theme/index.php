<?php
/*
Template Name: Home
*/
?>
<?php get_header() ?>

<div class="main">
    <?php if (have_rows('slider_prm')) : ?>
        <section class="section-slider">
            <?php while (have_rows('slider_prm')) : the_row();
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $image = get_sub_field('image_product');
                $background = get_sub_field('background');

            ?>
                <div class="section-slider__item">
                    <div class="section-slider__content">
                        <div class="container">
                            <div class="section-slider__content-wrap">
                                <h3 class="title-type-prm"><?php echo $title ?></h3>
                                <div class="section-slider__description"><?php echo $description; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="section-slider__image" style="background-image: url(<?php echo $background ?>);">
                        <img src="<?php echo $image ?>" alt="image slider">
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <section>
        <div class="container">
            <div class="ss-product">
                <div class="ss-title align-ct">
                    <h3 class="ss-product__title title-type-prm">Sản Phẩm</h3>
                </div>
                <div class="ss-product__slider pd-t-3 pd-bt-3">
                    <?php
                    $products = array(
                        'post_type' => 'product',
                        'showposts'  => 6,
                        'orderby'     => 'date',
                        'order'     => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => 27,
                            )
                        )
                    );

                    $query_product = new WP_Query($products);

                    // The Loop
                    if ($query_product->have_posts()) :
                        while ($query_product->have_posts()) : $query_product->the_post(); 
                        global $product;
                        ?>
                            <div class="ss-product__item">
                                <div class="ss-product__thumb-wrap">
                                    <a href="<?php echo get_the_permalink() ?>" class="ss-product__thumb hover-black">
                                        <?php echo woocommerce_get_product_thumbnail() ?>
                                        <?php get_template_part('template-parts/attribute', 'product'); ?>
                                    </a>
                                </div>
                                <div class="ss-product__content align-ct">
                                    <a href="<?php echo get_the_permalink() ?>" class="hover-red">
                                        <h3 class="ss-product__name mg-bt-1"><?php echo  get_the_title() ?></h3>
                                        <p class="mg-bt-1"><?php echo $product->get_attribute('pa_loai-pha') ?></p>
                                    </a>
                                    <div class="ss-product__ratings mg-bt-1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="ss-product__price mg-bt-1">
                                        <?php

                                        global $product;
                                        ?>

                                        <?php if ($price_html = $product->get_price_html()) : ?>
                                            <a href="<?php echo get_the_permalink() ?>" class="hover-red">
                                                <span class="price"><b><?php echo $price_html; ?></b></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ss-product__buy-now">
                                        <a href="<?php echo get_the_permalink() ?>" class="hover-red radius-5 bg-prm">
                                            Mua ngay&ensp;<i class="fas fa-cart-plus"></i>&ensp;<i class="fas fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white-dark">
        <div class="container">
            <div class="ss-collections pd-t-2">
                <div class="ss-title align-ct mg-bt-3">
                    <p class="ss-title__subtitle">Khám phá</p>
                    <h3 class="title-type-prm">Bộ sưu tập</h3>
                </div>

                <?php
                $collection = array(
                    'post_type' => 'product',
                    'showposts'  => 3,
                    'orderby'     => 'date',
                    'order'     => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => 28,
                        )
                    )
                );

                $query_collection = new WP_Query($collection);

                // The Loop
                if ($query_collection->have_posts()) : ?>
                    <div class="ss-collections__list">
                        <?php while ($query_collection->have_posts()) : $query_collection->the_post(); ?>
                            <div class="ss-collections__wrap">
                                <div class="ss-collections__item bg-prm">
                                    <div class="ss-collections__thumb">
                                        <div class="ss-collections__thumb-wrap">
                                            <?php echo woocommerce_get_product_thumbnail('woo_large') ?>
                                        </div>
                                    </div>
                                    <div class="ss-collections__content">
                                        <div class="ss-collections__content-wrap mg-bt-2">
                                            <h3><?php echo  get_the_title() ?></h3>
                                            <div class="ss-collections__subtitle">
                                                <?php echo get_field('subtitle') ?>
                                            </div>
                                        </div>

                                        <div class="ss-collections__description mg-bt-2">
                                            <?php the_excerpt() ?>
                                        </div>

                                        <div class="mg-bt-1 cl-white">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>

                                        <div class="ss-product__price mg-bt-1">
                                            <?php

                                            global $product;
                                            ?>

                                            <?php if ($price_html = $product->get_price_html()) : ?>
                                                <a href="<?php echo get_the_permalink() ?>" class="hover-red">
                                                    <span class="price"><b><?php echo $price_html; ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="ss-product__buy-now">
                                            <a href="<?php echo get_the_permalink() ?>" class="hover-red radius-5 bg-black cl-prm">
                                                Mua ngay&ensp;<i class="fas fa-cart-plus"></i>&ensp;<i class="fas fa-angle-double-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <section>
        <div class="ss-news" style="background-image: url(<?php the_field('background_news_home') ?>);">
            <div class="container">
                <div class="ss-title align-ct pd-t-2 mg-bt-3">
                    <h3 class="title-type-prm">Tin tức</h3>
                </div>

                <div class="ss-news__list">
                    <?php
                    $news = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'showposts' => 4,
                        'cat' => 19,
                    );

                    $query_news = new WP_Query($news);
                    // The Loop
                    if ($query_news->have_posts()) :
                        while ($query_news->have_posts()) : $query_news->the_post(); 
                        ?>
                            <article class="ss-news__item mg-bt-1">
                                <div class="ss-news__item-thumb">
                                    <a href="<?php the_permalink() ?>" class="ss-news__item-thumb-wrap">
                                        <?php the_post_thumbnail() ?>
                                    </a>
                                </div>

                                <div class="ss-news__item-content">
                                    <a href="<?php the_permalink() ?>" class="hover-black">
                                        <h3 class="ss-news__item-title"><?php the_title() ?></h3>
                                        <div class="ss-news__item-excerpt">
                                            <?php the_excerpt() ?>
                                        </div>
                                    </a>
                                </div>
                            </article>
                    <?php endwhile;
                    endif;

                    // Reset Post Data
                    wp_reset_postdata();

                    ?>
                </div>

                <?php $view_all_news = get_field('view_all_news'); ?>
                <div class="ss-news__view-all align-ct">
                    <a class="bg-prm hover-red" href="<?php echo get_category_link($view_all_news->term_id); ?>">Xem tất cả</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>