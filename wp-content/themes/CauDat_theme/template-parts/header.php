<div class="header-part" id="header-part">
    <div class="container">
        <div class="header-part__content">
            <div class="row">
                <?php if(is_product()): ?>
                <div class="col-lg-12 col-12">
                    <div class="header-part__breadcrumb single-product-breadcrum mg-bt-1">
                        <?php m_breadcrumbs() ?>
                    </div>
                </div>
                <?php endif; ?>
                    
                <div class="col-lg-7">
                    <div class="header-part__title">

                        <?php

// var_dump(get_query_var('post_type'));
                        if (is_page()) : ?>
                            <h1><?php echo get_the_title() ?></h1>
                        <?php endif; ?>

                        <?php
                        if (is_category()) : ?>
                            <h1><?php single_cat_title() ?></h1>
                        <?php endif; ?>

                        <?php
                        if (is_tax('product_cat')) : ?>
                            <h1><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>

                        <?php
                        if (is_404()) : ?>
                            <h1>Lỗi 404</h1>
                        <?php endif; ?>

                        <?php
                        if (is_product() || get_query_var('post_type') == 'product') :
                            $post_type = get_post_type_object(get_post_type());
                        ?>
                            <h1><?php echo $post_type->labels->singular_name ?></h1>
                        <?php endif; ?>
                    </div>

                    <div class="header-part__description">

                        <?php
                        if (is_page()) : ?>
                            <?php echo get_field('description_page') ?>
                        <?php endif; ?>

                        <?php
                        if (is_category()) : ?>
                            <?php echo category_description() ?>
                        <?php endif; ?>

                        <?php
                        woocommerce_taxonomy_archive_description();
                        woocommerce_product_archive_description();
                        ?>

                        <?php
                        if (is_product() || get_query_var('post_type') == 'product') :
                            
                            $shop_page = get_option( 'woocommerce_shop_page_id' );
                            echo get_field('description_page', $shop_page) ;
                            // var_dump($shop_page);
                        endif; ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <?php if(!is_product()): ?>
                    <div class="header-part__breadcrumb mg-t-1">
                        <?php m_breadcrumbs() ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>