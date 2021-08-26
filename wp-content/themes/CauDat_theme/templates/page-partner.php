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

        <ul class="partner__nav row">
            <li class="col-md-4"><a href="#partner__section-1" class="active" data-id-section="partner__section-1"><?php the_field('label_xe_take_away') ?></a></li>
            <li class="col-md-4"><a href="#partner__section-2" data-id-section="partner__section-2"><?php the_field('label_dong_hanh_thuong_hieu') ?></a></li>
            <li class="col-md-4"><a href="#partner__section-3" data-id-section="partner__section-3"><?php the_field('label_cau_chuyen_doi_tac') ?></a></li>
        </ul>

        <?php
        $info_take_away_car = get_field('info_take_away_car');
        $cau_chuyen_thanh_cong = get_field('cau_chuyen_thanh_cong');

        ?>
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

        <div class="partner__content" id="partner__section-2">
            <div class="partner__companion">
                <?php the_field('dong_hanh_thuong_hieu_va_dieu_khoan_hop_tac') ?>
            </div>

            <div class="partner__consult">
                <h2 class="partner__consult-title">Tư vấn</h2>
                <div class="partner__consult-form">
                    <?php echo do_shortcode('[contact-form-7 id="671" title="Tư vấn"]') ?>
                </div>
            </div>
        </div>

        <div class="partner__content" id="partner__section-3">
            <div class="partner__story">
                <?php the_field('cau_chuyen_doi_tac') ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

