<?php get_header() ?>
<!-- Page Content -->
<div class="header-part" id="header-part">
    <div class="container">
        <div class="header-part__content">
            <!-- < ?php
            global $post;
            $postcat = get_the_category($post->ID);

            if (!empty($postcat)) {
                foreach ($postcat  as $category) {
                }
            }

            ?> -->
            <div class="row">
                <div class="col-md-7">
                    <div class="header-part__title">

                        <h2>
                            <?php echo get_cat_name(19) ?>
                        </h2>
                    </div>

                    <div class="header-part__description">

                        <?php echo category_description(19) ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="header-part__breadcrumb mg-t-1">
                        <!-- < ?php m_breadcrumbs() ?> -->
                        <ul class="m-breadcrumb">
                            <li><a href="<?php echo  get_bloginfo('url') ?>">Trang chủ</a></li>
                            <span class="breadcrumb-delimiter"><i class="far fa-chevron-double-right"></i></span>
                            <li><a href="<?php echo get_category_link(19) ?>"><?php echo get_cat_name(19) ?></a></li>
                            <!--<span class="breadcrumb-delimiter"><i class="far fa-chevron-double-right"></i></span>-->
                            <!--<span>< ?php echo get_the_title() ?></span>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single">

    <div class="single__main mg-t-5 mg-bt-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <?php get_sidebar() ?>
                </div>

                <div class="col-lg-8">
                    <div class="category__right">
                        <?php if (have_posts()) : ?>

                            <?php while (have_posts()) : the_post();
                            ?>

                                <div class="single__content-head">
                                    <div class="list-posts__content">
                                        <?php the_category() ?>

                                        <h4>
                                            <a href="<?php the_permalink() ?>" class="list-posts__item-title hover-black">
                                                <?php the_title() ?>
                                            </a>
                                        </h4>

                                        <div class="list-posts__item-group">
                                            <span class="list-posts__item-date"><?php echo get_the_date('F j, Y');  ?></span>
                                            <span class="list-posts__delimiter">/</span>
                                            <span class="list-posts__item-author">
                                                by <b><?php echo get_the_author() ?></b>
                                            </span>

                                            <span class="list-posts__delimiter">/</span>
                                            <span class="list-posts__item-comment"><?php echo get_comments_number() ?>&ensp;Comments</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single__content-main">
                                    <?php the_content() ?>
                                </div>
                            <?php endwhile; ?>

                        <?php endif; ?>
                        
						<?php
	$categories = get_the_category($post->ID);
	if ($categories) 
	{
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		$args=array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'showposts'=>4, // Số bài viết bạn muốn hiển thị.
		'caller_get_posts'=>1
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) 
		{
			echo '<h3>Bài viết liên quan</h3><div class="list-posts list-1">';
			while ($my_query->have_posts())
			{
				$my_query->the_post();
				?>
				<article class="list-posts__item">
					<div class="list-posts__thumb">
						<a href="<?php the_permalink(); ?>" class="list-posts__thumb-wrap"><?php the_post_thumbnail(array(85, 75)); ?></a>
					</div>
					<div class="list-posts__content">
						<h4><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="list-posts__item-title hover-black"><?php the_title(); ?></a></h4>
					</div>
				</article>
				<?php
			}
			echo '</div>';
		}
	}
?>
						
						
						
                        <?php
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>