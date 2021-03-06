<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        <?php if (is_front_page()) : ?>
            <?php bloginfo('name') ?>
        <?php elseif (is_single()) : ?>
            <?php echo wp_title('', true, ''); ?>
        <?php else : ?>
            <?php echo wp_title('', true, ''); ?>
        <?php endif ?>
    </title>


    <link href="<?php echo get_template_directory_uri() ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="<?php echo get_template_directory_uri() ?>/css/reset-css.css" rel="stylesheet"> <!-- Reset CSS -->
    <link href="<?php echo get_template_directory_uri() ?>/css/styles.css" rel="stylesheet"> <!-- Style CSS -->
    <link href="<?php echo get_template_directory_uri() ?>/css/my-custom.css" rel="stylesheet"> <!-- My custom CSS -->

    <!-- Pages -->
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/about-us.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/showroom.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/singles.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/contact.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/stories.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/pages/partner.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/woocommerce.css" rel="stylesheet">

    <link href="<?php echo get_template_directory_uri() ?>/css/responsive.css" rel="stylesheet"> <!-- Responsive CSS -->


    <link href="<?php echo get_template_directory_uri() ?>/vendor/Font-Awesome/css/font-awesome.min.css" rel="stylesheet"> <!-- font-awesome 4.7 CSS -->
    <link href="<?php echo get_template_directory_uri() ?>/vendor/fontawesome-5.15.3/css/all.min.css" rel="stylesheet"> <!-- font-awesome 5.15.3 CSS -->

    <!-- slick -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/slick/slick.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/slick/slick-theme.css">

    <!-- lightbox -->
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lightGallery-master/dist/css/lightgallery.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lightGallery-master/dist/css/lg-zoom.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lightGallery-master/dist/css/lg-thumbnail.css" />

    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/lightGallery-master/dist/css/lightgallery-bundle.css" />
    <?php wp_head() ?>
</head>

<body>

    <!-- Navigation -->
    <header class="header-main">
        <div class="header" id="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <div class="hotline align-ct">
                                <a href="tel:<?php the_field('hotline', 'option') ?>"><b>HOTLINE: <span><?php the_field('hotline', 'option') ?></span></b></a>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="language-flag">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'language',
                                    'container'  => false,
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav">
                <div class="container">
                    <div class="header-nav__container">
                        <div class="header-nav__row">

                            <div class="header-nav__col">
                                <div class="header__logo">
                                    <?php $logo_home = get_theme_mod('Logo'); ?>
                                    <a href="<?php echo home_url() ?>">
                                        <?php if (!empty($logo_home)) { ?>
                                            <img class="logo" src="<?php echo $logo_home; ?>" alt="logo" width="100%" />
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>

                            <div class="header-nav__col">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location'  => 'main-menu',
                                        'depth'  => 3,
                                        'container'  => 'nav',
                                        'menu_class'  => 'header-nav__menu',
                                    )
                                );
                                ?>

                            </div>

                            <div class="header-nav__col">
                                <div class="header-nav__mega">

                                    <div class="search-block">
                                        <button class="search-block__open">
                                            <span class="search-block__open-icon"></span>&ensp;<span>T??m ki???m</span>
                                        </button>
                                        <ul class="search-block__form search-block__product">
                                            <?php dynamic_sidebar('search-product'); ?>
                                        </ul>
                                    </div>

                                    <ul class="usser-login">
                                        <!-- < ?php dynamic_sidebar('login'); ?> -->

                                    

                                        <?php
                                        if (is_user_logged_in()) { ?>
                                            <li><a href="<?php echo  wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) ?>">????ng xu???t</a></li>
                                        <?php } elseif (!is_user_logged_in()) { ?>
                                            <li><a href="<?php echo get_permalink(wc_get_page_id('myaccount')) ?>">????ng nh???p</a></li>
                                        <?php }
                                        ?>
                                    </ul>

                                    <div class="mini-cart">
                                        <div class="mini-cart__wrap">
                                            <div class="mini-cart__icon">
                                                <img src="<?php echo get_template_directory_uri() ?>/images/shopping-cart.png" alt="icon-shopping">
                                            </div>
                                            <div class="mini-cart__amount cart-number">
                                                <?php
                                                global $woocommerce;
                                                echo $woocommerce->cart->cart_contents_count; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-mb bg-prm">
                <div class="header-mb__row">
                    <div id="btn-bar">
                        <i class="fas fa-bars fa-lg"></i>
                    </div>

                    <div class="align-ct">
                        <div class="header__logo">
                            <?php $logo_home = get_theme_mod('Logo'); ?>
                            <a href="<?php echo home_url() ?>">
                                <?php if (!empty($logo_home)) { ?>
                                    <img class="logo" src="<?php echo $logo_home; ?>" alt="logo" width="100%" />
                                <?php } ?>
                            </a>
                        </div>
                    </div>

                    <div class="mini-cart">
                        <div class="mini-cart__wrap">
                            <div class="mini-cart__icon">
                                <img src="<?php echo get_template_directory_uri() ?>/images/shopping-cart.png" alt="icon-shopping">
                            </div>
                            <div class="mini-cart__amount cart-number">
                                <?php
                                global $woocommerce;
                                echo $woocommerce->cart->cart_contents_count; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>