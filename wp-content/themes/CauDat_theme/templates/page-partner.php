<?php
/*
Template Name: Đối tác
*/
?>
<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="partner">
    <div class="container">
        <!-- Partner Tabs -->
        <?php
        if (have_rows('partner_tabs')) : ?>
            <?php
            $current = $_GET['partner'] ? $_GET['partner'] : null;
            // var_dump($current);
            $i = 0;
            ?>

            <div class="current-label"><?php echo $current ? $current : get_field('partner_tabs')[0]['label'] ?></div>
            <ul class="partner__nav partner__nav-row">
                <?php while (have_rows('partner_tabs')) : the_row();
                    $i++; ?>
                    <?php
                    if ($current) {
                        if ($current == 'tab-' . $i) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                    } else {
                        if (get_field('partner_tabs')[0]['label'] == get_sub_field('label')) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                    }
                    ?>

                    <li class="partner__nav-cold mg-bt-1"><a href="?partner=tab-<?php echo $i ?>" class="<?php echo $active; ?>" data-target="tab-<?php echo $i ?>"><?php echo trim(get_sub_field('label')) ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <!-- Partner Tabs Content -->
        <?php
        if (have_rows('partner_tabs')) : $j = 0; ?>
            <?php while (have_rows('partner_tabs')) : the_row();
                $j++; ?>
                <div class="partner__content" data-anchor="tab-<?php echo $j ?>">
                    <div class="partner__infor-take-away mg-bt-3">
                        <?php echo get_sub_field('content') ?>
                    </div>
                    <?php if (get_sub_field('form')) : ?>
                        <div class="partner__consult">
                            <h2 class="partner__consult-title">Tư vấn</h2>
                            <div class="partner__consult-form">
                                <?php echo do_shortcode(get_sub_field('form_shortcode')) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer() ?>