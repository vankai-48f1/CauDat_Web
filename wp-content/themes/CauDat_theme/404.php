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
                Không tìm thấy trang:
                <small>Error 404</small>
            </h1>

            <p>
                Xin lỗi vì sự cố này! trang bạn đang tìm kiếm không tồn tại. Vui lòng tìm kiếm lại ở khung bên dưới.
            </p>

            <form action="<?php bloginfo('url'); ?>/">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </form>

        </div>


    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>