<?php get_header() ?>
<!-- Content Category News -->
<?php get_template_part('template-parts/header'); ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8 pd-t-3">

            <h1 class="my-2 mb-4 page-header">
                Không tìm thấy trang:
                <small>Error 404</small>
            </h1>

            <div class="mg-bt-2">
                Xin lỗi vì sự cố này! trang bạn đang tìm kiếm không tồn tại. Vui lòng tìm kiếm lại ở khung bên dưới.
            </div>

            <form action="<?php bloginfo('url'); ?>/" class="pd-bt-5">
                <div class="row">
                    <div>
                        <input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" placeholder="Search for...">
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Go!</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php get_footer() ?>