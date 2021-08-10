<?php
/*
Template Name: Menu thức uống
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

        <div class="showroom-menu mg-bt-5">
            <img src="<?php the_field('menu') ?>" alt="" class="showroom-menu__image">
        </div>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>