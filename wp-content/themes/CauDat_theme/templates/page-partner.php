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
        <div class="current-label">Xe Take Away</div>
        <ul class="partner__nav partner__nav-row">

            <?php
            for ($i = 1; $i < 9; ++$i) {
                $label_target = get_field('label_partner_' . $i);
                if ($label_target) { ?>
                    <li class="partner__nav-cold mg-bt-1"><a href="#partner__section-<?php echo $i ?>" class="<?php echo $i === 1 ? 'active' : null  ?>" data-id-section="partner__section-<?php echo $i ?>"><?php echo $label_target ?></a></li>
            <?php } else {
                    break;
                }
            } ?>
        </ul>

        <?php
        $info_take_away_car = get_field('info_take_away_car');
        $cau_chuyen_thanh_cong = get_field('cau_chuyen_thanh_cong');

        ?>

        <?php
        for ($i = 1; $i < 9; ++$i) {
            $content = get_field('content_' . $i);
            if ($i === 1) { ?>
                <div class="partner__content" id="partner__section-1">
                    <div class="partner__infor-take-away mg-bt-3">
                        <h2 class="partner__infor-title align-ct mg-bt-2"><?php echo $info_take_away_car['title'] ?></h2>
                        <?php echo $info_take_away_car['content'] ?>
                    </div>
                    <div class="partner__success-story">
                        <h2 class="partner__success-story-title align-ct mg-bt-2"><?php echo $cau_chuyen_thanh_cong['title'] ?></h2>
                        <?php echo $cau_chuyen_thanh_cong['content'] ?>
                    </div>

                    <div class="partner__consult">
                        <h2 class="partner__consult-title">Tư vấn</h2>
                        <div class="partner__consult-form">
                            <?php echo do_shortcode('[contact-form-7 id="671" title="Tư vấn"]') ?>
                        </div>
                    </div>
                </div>
                <?php } else {

                if ($content) { ?>

                    <div class="partner__content" id="partner__section-<?php echo $i ?>">
                        <div class="partner__companion">
                            <?php echo $content; ?>
                        </div>

                        <?php if ($i != 3) { ?>
                            <div class="partner__consult">
                                <h2 class="partner__consult-title">Tư vấn</h2>
                                <div class="partner__consult-form">
                                    <?php echo do_shortcode('[contact-form-7 id="671" title="Tư vấn"]') ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
        <?php } else {
                    break;
                }
            }
        }

        ?>
    </div>
</div>
<?php get_footer() ?>