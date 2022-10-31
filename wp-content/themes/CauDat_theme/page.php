<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="page-main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <?php if (is_shop() || is_cart() || is_checkout()) : ?>
                <div class="container">
                    <div class="pd-t-3 pd-bt-3">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php else : ?>
                <?php
                global $post;
                $data_video = get_field('video_section', $post->ID);
                ?>
                <?php if (isset($data_video)) : ?>
                    <div class="about-video-container">
                        <div class="row pt-5">
                            <div class="col-md-6">
                                <div class="about-video-container__video">
                                    <?php echo $data_video['video'] ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-video-description">
                                    <div class="about-video-description__wrap">
                                        <div class="about-video-description__main text-center"><?php echo $data_video['description'] ?></div>
                                        <a href="<?php echo $data_video['link_contact'] ? $data_video['link_contact']['link'] : '#' ?>" class="about-video-description__link">
                                            <?php echo $data_video['link_contact'] ? $data_video['link_contact']['title'] : 'Liên hệ' ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="page-content pd-t-3">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>