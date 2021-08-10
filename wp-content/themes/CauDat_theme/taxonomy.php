<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-4">
            <?php get_sidebar() ?>
        </div>

        <!-- Blog Entries Column -->
        <div class="col-lg-8">

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content-page', get_post_format()); ?>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>


    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>