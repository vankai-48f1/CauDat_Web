<?php get_header() ?>
<!-- Page Content -->
<?php get_template_part('template-parts/header'); ?>

<div class="container">

    <div class="row">
        <div class="col-lg-4">
            <?php get_sidebar() ?>
        </div>
        <!-- Blog Entries Column -->
        <div class="col-lg-8">

            <h1 class="my-2 mb-4 page-header">
                Tìm kiếm:
                <small><?php the_search_query(); ?></small>
            </h1>

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content', get_post_format()); ?>

                <?php endwhile; ?>

            <?php else : ?>

                <p>
                    Không có bài viết nào phù hợp với từ khóa: <strong><?php the_search_query(); ?></strong>
                </p>

                <form action="<?php bloginfo('url'); ?>/">
                    <div class="input-group">
                        <input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </form>

            <?php endif; ?>

            <!-- Pagination -->

        </div>


    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>