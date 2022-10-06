<?php
/*
Template Name: Showroom
*/
?>

<?php get_header() ?>

<?php get_template_part('template-parts/header'); ?>
<!-- Page Content -->
<div class="container">

    <div class="showroom">
        <?php
        global $post;
        ?>
        <!-- < ?php 
        $cate_showroom = get_field('list_category_showrom', $post->ID);
        $select = get_field('select', $post->ID);

        if ($cate_showroom) :
            foreach ($cate_showroom as $category) : ?>
                <div class="showroom__item">
                    < ?php
                    $cate_image = get_field('category_image', $category);
                    if ($cate_image) :
                    ?>
                        <a href="< ?php echo esc_url(get_term_link($category)); ?>" class="showroom__image-wrap">
                            <img src="< ?php echo $cate_image ?>" alt="">
                        </a>
                    < ?php endif; ?>

                    <div class="showroom__content">
                        <h2 class="showroom__title mg-bt-1">
                            <a href="< ?php echo esc_url(get_term_link($category)); ?>" title="< ?php echo $category->name ?>" class="hover-red">< ?php echo $category->name ?></a>
                        </h2>
                        <div class="showroom__excerpt mg-bt-1">< ?php echo wp_trim_words($category->description, 20) ?></div>

                        <div class="showroom__link-box align-r mg-bt-1">
                            <a href="< ?php echo esc_url(get_term_link($category)); ?>" class="showroom__link hover-red">Xem chi tiết</a>
                        </div>
                    </div>

                </div>
        < ?php endforeach;
        endif; ?> -->
        <?php if (have_rows('select', $post->ID)) : ?>
            <?php while (have_rows('select', $post->ID)) : the_row();
                $type = get_sub_field('type');
            ?>
                <?php if ($type == 'taxonomy') : ?>
                    <div class="showroom__item">
                        <?php
                        $category = get_sub_field('select_tax');
                        $cate_image = get_field('category_image', $category);
                        if ($cate_image) :
                        ?>
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="showroom__image-wrap">
                                <img src="<?php echo $cate_image ?>" alt="">
                            </a>
                        <?php endif; ?>

                        <div class="showroom__content">
                            <h2 class="showroom__title mg-bt-1">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo $category->name ?>" class="hover-red"><?php echo $category->name ?></a>
                            </h2>
                            <div class="showroom__excerpt mg-bt-1"><?php echo wp_trim_words($category->description, 20) ?></div>

                            <div class="showroom__link-box align-r mg-bt-1">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="showroom__link hover-red">Xem chi tiết</a>
                            </div>
                        </div>

                    </div>
                <?php elseif ($type == 'page') : ?>
                    <div class="showroom__item">
                        <?php
                        $page_select = get_sub_field('select_page');
                        $page_description = get_field('description_page', $page_select->ID);
                        if (has_post_thumbnail($page_select->ID)) :
                        ?>
                            <a href="<?php echo esc_url(get_the_permalink($page_select->ID)); ?>" class="showroom__image-wrap">
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_select->ID), 'single-post-thumbnail'); ?>

                                <?php echo '<img src="' . $image[0] . '" alt="" />'; ?>
                            </a>
                        <?php endif; ?>

                        <div class="showroom__content">
                            <h2 class="showroom__title mg-bt-1">
                                <a href="<?php echo esc_url(get_the_permalink($page_select->ID)); ?>" title="<?php echo $page_select->post_title ?>" class="hover-red"><?php echo $page_select->post_title ?></a>
                            </h2>
                            <div class="showroom__excerpt mg-bt-1"><?php echo wp_trim_words($page_description, 20) ?></div>

                            <div class="showroom__link-box align-r mg-bt-1">
                                <a href="<?php echo esc_url(get_the_permalink($page_select)); ?>" class="showroom__link hover-red">Xem chi tiết</a>
                            </div>
                        </div>

                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>