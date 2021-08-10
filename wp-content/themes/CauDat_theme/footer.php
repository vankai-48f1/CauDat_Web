<!-- Footer -->
<footer>
    <div class="footer">
        <?php if (is_front_page() || is_shop() || is_product_category() || is_product()) : ?>
            <div class="footer-top align-ct bg-white">
                <div class="container">
                    <div class="footer-top__contact mg-bt-2">
                        <p>HOTLINE: <a class="hover-red" href="tel:<?php the_field('hotline', 'option') ?>"><span><?php the_field('hotline', 'option') ?></span></a></p>
                        <p>SHOWROOM: <?php the_field('showroom', 'option') ?></p>
                    </div>

                    <div class="footer-top__ecommerce">

                        <?php if (have_rows('ecommerce_link', 'option')) : ?>
                            <p>MUA NGAY TRÊN KÊNH BẠN THÍCH</p>
                            <ul class="ecommerce-list">
                                <?php while (have_rows('ecommerce_link', 'option')) : the_row();
                                    $ecommerce_logo = get_sub_field('logo');
                                    $ecommerce_link = get_sub_field('link');

                                ?>
                                    <li class="ecommerce-list__item">
                                        <a href="<?php echo $ecommerce_link; ?>">
                                            <img src="<?php echo $ecommerce_logo['url'] ?>" alt="logo">
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="footer-mid">
            <div class="container">
                <div class="footer-mid__content">
                    <div class="footer-mid__logo">
                        <?php $logo_home = get_theme_mod('Logo'); ?>
                        <a href="<?php echo home_url() ?>">
                            <?php if (!empty($logo_home)) { ?>
                                <img class="logo" src="<?php echo $logo_home; ?>" alt="logo" width="100%" />
                            <?php } ?>
                        </a>
                    </div>

                    <?php if (have_rows('social', 'option')) : ?>
                        <ul class="footer-mid__social mg-t-2">
                            <?php while (have_rows('social', 'option')) : the_row();
                                $social_icon = get_sub_field('icon');
                                $social_link = get_sub_field('link');

                            ?>
                                <li class="footer-mid__social-item">
                                    <a href="<?php echo $social_link; ?>">
                                        <?php echo $social_icon ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'footer-menu',
                            'depth'  => 2,
                            'container'  => 'nav',
                            'menu_class'  => 'footer-mid__menu',
                        )
                    );
                    ?>

                    <div class="footer-mid__about">
                        <div class="footer-mid__about-content">
                            <?php the_field('about_us_footer', 'option') ?>
                        </div>

                        <?php if (have_rows('copyright', 'option')) : ?>
                            <div class="footer-mid__copyright mg-t-2">
                                <?php while (have_rows('copyright', 'option')) : the_row();
                                    $copyright_icon = get_sub_field('announce');
                                    $copyright_ct = get_sub_field('content_copyright');

                                ?>
                                    <img src="<?php echo $copyright_icon; ?>" alt="">
                                    <p><?php echo $copyright_ct; ?></p>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom bg-black">
            <div class="container footer-bottom__container">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="footer-bottom__content">
                            <h3>Hotline: <?php the_field('hotline', 'option') ?></h3>
                            <p><?php the_field('email', 'option') ?></p>
                            <div class="footer-bottom__border">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="footer-bottom__border-line"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <?php if (have_rows('branch_1', 'option')) : ?>
                            <div class="footer-bottom__content">
                                <?php while (have_rows('branch_1', 'option')) : the_row();
                                    $name = get_sub_field('name');
                                    $address = get_sub_field('address');

                                ?>
                                    <h3><?php echo $name ?></h3>
                                    <p><?php echo $address; ?></p>
                                <?php endwhile; ?>

                                <div class="footer-bottom__border">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="footer-bottom__border-line"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-12">
                        <?php if (have_rows('branch_2', 'option')) : ?>
                            <div class="footer-bottom__content">
                                <?php while (have_rows('branch_2', 'option')) : the_row();
                                    $name = get_sub_field('name');
                                    $address = get_sub_field('address');

                                ?>
                                    <h3><?php echo $name ?></h3>
                                    <p><?php echo $address; ?></p>
                                <?php endwhile; ?>

                                <div class="footer-bottom__border">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="footer-bottom__border-line"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-12">
                        <?php if (have_rows('branch_3', 'option')) : ?>
                            <div class="footer-bottom__content">
                                <?php while (have_rows('branch_3', 'option')) : the_row();
                                    $name = get_sub_field('name');
                                    $address = get_sub_field('address');

                                ?>
                                    <h3><?php echo $name ?></h3>
                                    <p><?php echo $address; ?></p>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="float-logo">
                    <div class="float-logo__wrap">
                        <div class="float-logo__image"></div>
                        <!-- <div class="float-logo__registered">
                            <i class="fal fa-registered"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</footer>

<div class="menubar">
    <div class="menubar__container">
        <div class="header__logo align-ct mg-bt-2">
            <?php $logo_home = get_theme_mod('Logo'); ?>
            <a href="<?php echo home_url() ?>">
                <?php if (!empty($logo_home)) { ?>
                    <img class="logo" src="<?php echo $logo_home; ?>" alt="logo" width="100%" />
                <?php } ?>
            </a>
        </div>
        <ul class="search-block__form">
            <?php dynamic_sidebar('search'); ?>
        </ul>

        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'main-menu',
                'depth'  => 2,
                'container'  => 'nav',
                'menu_class'  => 'menubar__nav',
            )
        );
        ?>
        <ul class="usser-login">
            <?php dynamic_sidebar('login'); ?>
        </ul>
        <div class="close-float">
            <span class="close-float__icon"></span>
        </div>
    </div>
</div>

<div class="sidebar-cart">
    <div class="sidebar-cart__container">
        <div class="sidebar-cart__wrap">
            <?php dynamic_sidebar('mini-cart') ?>
            <div class="close-float">
                <span class="close-float__icon"></span>
            </div>
        </div>
    </div>
</div>
<div class="shadow-screen"></div>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo get_template_directory_uri() ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/slick/slick.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/main.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/slider.js"></script>

<?php
if (!is_front_page()) : ?>
    <script>
        // padding header

        let header = document.getElementById('header');
        let header_part = document.getElementById('header-part');

        let offset_header = header.offsetHeight + 'px';
        if(header_part) {
            header_part.style.marginTop = offset_header;
        }
    </script>
<?php endif; ?>
<?php wp_footer() ?>
</body>

</html>