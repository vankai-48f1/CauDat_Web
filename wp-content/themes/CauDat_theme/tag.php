<?php get_header() ?>
<!-- Page Content -->
  <div class="container">
    
      <div class="row">
          <div class="col-lg-4">
              <?php get_sidebar() ?>
          </div>

        <!-- Blog Entries Column -->
        <div class="col-lg-8">
          
          <h1 class="my-2 mb-4 page-header">
            Thẻ:
            <small><?php single_tag_title() ?></small>
          </h1>

          <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                  <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

            <?php endwhile; ?>

          <?php endif; ?>

          <!-- Pagination -->

        </div>


      </div>
      <!-- /.row -->

  </div>
<!-- /.container -->
<?php get_footer() ?>
