<?php

/**
 * Template Category Display In Columns
 */
?>

<div class="container">
    <?php

    $category = get_queried_object();

    $post_showroom = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'showposts' => 99,
        'cat' => $category->term_id,
        'order'          => 'DESC',
        'orderby'        => 'date',
    );


    $query_post_showroom = new WP_Query($post_showroom);

    if ($query_post_showroom->have_posts()) : ?>
        <div class="showroom">
            <?php while ($query_post_showroom->have_posts()) : $query_post_showroom->the_post(); ?>
                <div class="showroom__item">
                    <?php
                    if (has_post_thumbnail()) :
                    ?>
                    <a href="<?php the_permalink(); ?>" class="showroom__image-wrap">
                        <?php the_post_thumbnail() ?>
                    </a>
                    <?php endif; ?>
                    
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
	<div class="term-description pt-3">
		 <?php
		if (is_category()) : ?>
			<?php echo category_description() ?>
		<?php endif; ?>
	</div>
	
</div>