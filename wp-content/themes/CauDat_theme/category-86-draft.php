<?php get_header() ?>

<?php get_template_part('template-parts/header'); ?>
<!-- Page Content -->
<div class="container">
    <div class="showroom">
        <?php
        $showroom = array(
            'type'      => 'post',
            'parent'    => 86,
            'orderby'   => 'date',
            'order'     => 'ASC',
            'number'    => 10,
            'child_of'  => 0,
            'taxonomy'  => 'category',
            'hide_empty' => 0
        );
        $cate_showroom = get_categories($showroom);

        foreach ($cate_showroom as $category) : ?>
            <div class="showroom__item">
                <?php
                $cate_image = get_field('category_image', $category);
                if ($cate_image) :
                ?>
                    <a href="<?php echo get_category_link($category->term_id); ?>" class="showroom__image-wrap">
                        <img src="<?php echo $cate_image ?>" alt="">
                    </a>
                <?php endif; ?>

                <div class="showroom__content">
                    <h2 class="showroom__title mg-bt-1">
                        <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo $category->name ?>" class="hover-red"><?php echo $category->name ?></a>
                    </h2>
                    <div class="showroom__excerpt mg-bt-1"><?php echo $category->description ?></div>

                    <div class="showroom__link-box align-r mg-bt-1">
                        <a href="<?php echo get_category_link($category->term_id); ?>" class="showroom__link hover-red">Xem chi tiết</a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>