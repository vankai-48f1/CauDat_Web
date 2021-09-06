<?php
/*
* Template Name: Hoạt động trải nghiệm
* Template Post Type: post
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
                            <?php echo get_the_title(220) ?>
                        </h2>
                    </div>

                    <div class="header-part__description">

                        <?php echo get_field('description_page', 220) ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="header-part__breadcrumb mg-t-1">
                        <!-- < ?php m_breadcrumbs() ?> -->
                        <ul class="m-breadcrumb">
                            <li><a href="<?php echo  get_bloginfo('url')?>">Trang chủ</a></li>
                            <span class="breadcrumb-delimiter"><i class="far fa-chevron-double-right"></i></span>
                            <li><a href="<?php echo get_the_permalink(230) ?>"><?php echo get_the_title(230) ?></a></li>
                            <span class="breadcrumb-delimiter"><i class="far fa-chevron-double-right"></i></span>
                            <span><?php echo get_the_title() ?></span>
                        </ul>
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
            <?php
            $images = get_field('gallery');
            if ($images) : ?>
                <div class="showroom-gallery" id="showroom-gallery">
                    <?php foreach ($images as $image) : ?>
                        <a href="<?php echo esc_url($image['url']); ?>" class="showroom-gallery__image-wrap">
                            <img class="showroom-gallery__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo $image['alt']; ?>" />
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>