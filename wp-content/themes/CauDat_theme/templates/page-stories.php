<?php
/*
Template Name: Câu chuyện
*/
?>
<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="stories">
    <div class="container">
        <div class="stories__first-ct">
            <?php the_field('first_content') ?>
        </div>
    </div>

    <div class="production-process">
        <div class="stories__image-full stories__image-full-top">
            <div class="container">
                <img src="<?php the_field('production_process_image') ?>" alt="production process image" class="production-process__image">
            </div>
        </div>

        <div class="container-stories">
            <?php if (have_rows('production_process')) : $i = 0; ?>
                <div class="production-process__content">
                    <?php while (have_rows('production_process')) : the_row();
                        ++$i;
                        $image = get_sub_field('image');
                        $content = get_sub_field('content');
                        $step_title = get_sub_field('step_title');
                        $step_desciption = get_sub_field('step_desciption');

                    ?>
                        <div class="production-process__item <?php echo $i % 2 == 0 ? 'production-process__item-even' : 'production-process__item-odd' ?>">
                            <div class="production-process__step">
                                <div class="production-process__step-wrap">
                                    <div class="production-process__step-image">
                                        <img src="<?php echo  $image ?>" alt="production process image">
                                    </div>
                                    <div class="production-process__step-meta">
                                        <div class="production-process__step-logo"></div>
                                        <div class="production-process__step-content">
                                            <div class="production-process__label">Bước <?php echo $i . ':'; ?></div>
                                            <div class="production-process__step-title"><?php echo $step_title ?></div>
                                            <div class="production-process__step-desc"><?php echo $step_desciption ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="production-process__step-bottom"></div>
                            </div>
                            <div class="production-process__item-ct">
                                <?php echo $content ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="stories__image-full stories__image-full-bottom">
            <div class="container">
                <img src="<?php the_field('standard_image') ?>" alt="production process image" class="production-process__image">
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>