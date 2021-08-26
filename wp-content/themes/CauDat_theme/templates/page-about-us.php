<?php
/*
Template Name: Về chúng tôi
*/
?>

<?php get_header() ?>

<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="about-us pd-t-2">
    <?php $intro = get_field('intro_about_us') ?>
    <section class="about-us__intro">
        <div class="container">
            <div class="about-us__intro-ctn">
                <div class="about-us__intro-content about-us__order-1">
                    <div class="about-us__intro-title-block mg-bt-1">
                        <h2 class="about-us__title"><?php echo $intro['title']; ?></h2>
                    </div>

                    <div class="about-us__intro-branch">
                        <div class="about-us__branch-name about-us__branch-name--style">
                            <h4><?php echo $intro['branch_name_1'] ?></h4>
                        </div>
                        <div class="about-us__branch-description">
                            <?php echo $intro['description_1'] ?>
                        </div>
                    </div>

                    <div class="about-us__intro-branch">
                        <div class="about-us__branch-name about-us__branch-name--style">
                            <h4><?php echo $intro['branch_name_2'] ?></h4>
                        </div>
                        <div class="about-us__branch-description">
                            <?php echo $intro['description_2'] ?>
                        </div>
                    </div>
                </div>

                <div class="about-us__intro-image-block about-us__order-2">
                    <div class="about-us__intro-image-wrap">
                        <img class="about-us__intro-image" src="<?php echo $intro['image'] ?>" alt="">
                    </div>
                    <div class="about-us__intro-address">
                        <p><?php echo $intro['address'] ?></p>
                    </div>
                </div>

                <?php $brand_from_caudat = get_field('brand_from_caudat') ?>
                <div class="about-us__intro-image-block about-us__order-3">
                    <div class="about-us__intro-image-wrap">
                        <img class="about-us__intro-image" src="<?php echo $brand_from_caudat['image'] ?>" alt="">
                    </div>
                    <div class="about-us__intro-address">
                        <p><?php echo $brand_from_caudat['address'] ?></p>
                    </div>
                </div>

                <div class="about-us__intro-content about-us__order-4">

                    <div class="about-us__intro-branch">
                        <div class="about-us__branch-name about-us__branch-name--style">
                            <h4><?php echo $brand_from_caudat['title']; ?></h4>
                        </div>
                        <div class="about-us__branch-description">
                            <?php echo $brand_from_caudat['description'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us__detail">
        <div class="container">
            <div class="about-us__detail-image-wrap">
                <img class="about-us__detail-image" src="<?php the_field('details_about_us_image') ?>" alt="">
            </div>

            <?php if (have_rows('details_list')) : ?>
                <div class="about-us__detail-list">
                    <?php while (have_rows('details_list')) : the_row();
                        $name = get_sub_field('name');
                        $content = get_sub_field('content');
                    ?>
                        <div class="about-us__detail-item">
                            <div class="about-us__detail-head">
                                <div>A</div>
                            </div>
                            <div class="about-us__detail-content">
                                <div class="about-us__detail-name">
                                    <h3><?php echo $name ?></h3>
                                </div>
                                <div class="about-us__detail-content-desc">
                                    <div><?php echo $content; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>


    <section class="about-us__vision">
        <?php $vision = get_field('vision') ?>
        <div class="about-us__vision-bg" style="background-image: url(<?php echo $vision['image'] ?>);">
            <div class="container">
                <div class="about-us__vision-content">
                    <div class="about-us__title">
                        <h2><?php echo $vision['title'] ?></h2>
                    </div>
                    <div class="about-us__vision-desc">
                        <?php echo $vision['description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us__mission">
        <?php $mission = get_field('mission') ?>
        <div class="about-us__mission-bg" style="background-image: url(<?php echo $mission['image'] ?>);">
            <div class="container">
                <div class="about-us__mission-content">
                    <div class="about-us__mission-title">
                        <h2 class="about-us__title"><?php echo $mission['title'] ?></h2>

                        <div class="about-us__mission-desc">
                            <?php echo $mission['description'] ?>
                        </div>
                    </div>

                    <?php
                    if (have_rows('mission')) : while (have_rows('mission')) : the_row();
                            if (have_rows('mission_content')) : ?>
                                <div class="about-us__mission-row">
                                    <?php while (have_rows('mission_content')) : the_row();
                                        $name = get_sub_field('name');
                                        $content = get_sub_field('content');
                                    ?>
                                        <div class="about-us__mission-col">
                                            <h3 class="about-us__mission-name"><?php echo $name ?></h3>
                                            <div class="about-us__mission-ct-item"><?php echo $content ?></div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                    <?php endif;
                        endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="brand-culture">
        <div class="brand-culture__image">
            <img src="<?php the_field('imge_brand_culture') ?>" alt="">
        </div>

        <div class="brand-culture__main">
            <h3 class="about-us__title mg-bt-2"><?php the_field('title_brand_culture') ?></h3>

            <?php if (have_rows('content__brand_culture')) : ?>
                <div class="brand-culture__content">
                    <?php while (have_rows('content__brand_culture')) : the_row();
                        $name = get_sub_field('name');
                        $content = get_sub_field('content');
                    ?>
                        <div class="brand-culture__row">
                            <h3 class="brand-culture__row-name"><?php echo $name ?></h3>
                            <div class="brand-culture__row-ct"><?php echo $content ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <div class="brand-culture__epilogue">
                <?php the_field('epilogue') ?>
            </div>
        </div>
    </section>
    <!-- /.container -->
</div>
<?php get_footer() ?>