<?php
$search = array(
    'post_status' => 'publish',
    'post_type' => 'post',
);

$query_search = new WP_Query($search);
// The Loop
if ($query_search->have_posts()) : ?>
    <div class="list-posts">
        <?php while ($query_search->have_posts()) : $query_search->the_post(); ?>
            <article class="list-posts__item">
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

                    <div class="list-posts__item-group">
                        <span class="list-posts__item-date"><?php echo get_the_date('F j, Y');  ?></span>
                        <span class="list-posts__delimiter">/</span>
                        <span class="list-posts__item-author">
                            by <b><?php echo get_the_author() ?></b>
                        </span>
                    </div>

                    <div class="mg-t-1">
                        <?php the_category() ?>
                    </div>
                </div>
            </article>

        <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div class="mg-t-1">
        <?php m_paginate() ?>
    </div>
<?php endif;

// Reset Post Data
wp_reset_postdata();

?>