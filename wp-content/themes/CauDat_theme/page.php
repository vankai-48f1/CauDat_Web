<?php get_header() ?>
<?php get_template_part('template-parts/header'); ?>

<!-- Page Content -->
<div class="container">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <div class="page-content pd-t-3">
                <?php the_content(); ?>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>