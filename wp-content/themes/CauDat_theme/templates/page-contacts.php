<?php
/*
Template Name: Liên hệ
*/
?>
<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="contact">
    <div class="map-view">
        <iframe src="https://maps.google.com/maps?q=<?php echo get_field('coordinates') ?>&output=embed" width="600" height="450" frameborder="0" style="border:0"></iframe>
    </div>

    <div class="container">
        <div class="contact__infor-ctn">

            <?php $hotline = get_field('hotline') ?>
            <div class="contact__infor">
                <a href="tel:<?php echo $hotline['content'] ?>" class="contact__infor-icon">
                    <img src="<?php echo $hotline['icon'] ?>" alt="">
                </a>

                <a href="tel:<?php echo $hotline['content'] ?>" class="contact__infor-ct hover-black">
                    <h4><?php echo $hotline['name'] ?></h4>
                    <p><?php echo $hotline['content'] ?></p>
                </a>
            </div>

            <?php $address = get_field('address') ?>
            <div class="contact__infor">
                <div class="contact__infor-icon">
                    <img src="<?php echo $address['icon'] ?>" alt="">
                </div>

                <div class="contact__infor-ct">
                    <h4><?php echo $address['name'] ?></h4>
                    <p><?php echo $address['content'] ?></p>
                </div>
            </div>

            <?php $email = get_field('email') ?>
            <div class="contact__infor">
                <a href="tel:<?php echo $email['content'] ?>" class="contact__infor-icon">
                    <img src="<?php echo $email['icon'] ?>" alt="">
                </a>

                <a href="tel:<?php echo $email['content'] ?>" class="contact__infor-ct hover-black">
                    <h4><?php echo $email['name'] ?></h4>
                    <p><?php echo $email['content'] ?></p>
                </a>
            </div>
        </div>


        <div class="contact__content mg-bt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact__form mg-bt-2">
                        <?php the_content() ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact__note mg-bt-2">
                        <?php the_field('note') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container -->
<?php get_footer() ?>