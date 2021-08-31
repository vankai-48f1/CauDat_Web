<?php
/*
Template Name: Thông tin Showroom
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

        <div class="showrom-info__container mg-bt-5">
            <?php if (have_rows('content_showroom_info')) : ?>
                <div class="showrom-info__list">
                    <?php while (have_rows('content_showroom_info')) : the_row();
                        $image = get_sub_field('image');
                        $name_showroom = get_sub_field('name_showroom');
                        $address = get_sub_field('address');
                        $phone = get_sub_field('phone');
                        $location_map = get_sub_field('location_map');
                        $description = get_sub_field('description');
                    ?>
                        <div class="showrom-info__item">
                            <div class="showroom-info__image-block">
                                <?php
                                $gallery = get_sub_field('gallery');
                                if ($gallery) : ?>
                                    <div class="showroom-info__gallery">
                                        <?php foreach ($gallery as $image) : ?>
                                            <div class="showroom-info__gallery-item">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="showroom-info__content">
                                <div class="showrom-info__head">
                                    <h3 class="showrom-info__item-title"><?php echo $name_showroom ?></h3>
                                    <p><?php echo $address ?></p>
                                    <p><?php echo $phone ?></p>
                                </div>

                                <div class="showroom-info__map">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/map-icon.png" alt="" class="showroom-info__map-icon">
                                    <a target="_blank" href="<?php echo $location_map ?>" class="showroom-info__map-link hover-red">Xem trên google map</a>
                                </div>
                                <div class="showrom-info__desc">
                                    <?php echo $description ?>
                                </div>
                            </div>

                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>