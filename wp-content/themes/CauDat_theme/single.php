<?php get_header() ?>
<!-- Page Content -->
<div class="single">
    <div class="single__header">
        <?php echo get_the_post_thumbnail() ?>
    </div>

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
                        <div class="single__nav">
                            <div class="single__nav-previous">
                                <div class="mg-bt-1">
                                    <?php next_post_link('%link', 'Previous', true); ?>
                                </div>
                                <div class="single__nav-title mg-bt-1">
                                    <a href="<?php echo get_next_post()->guid ?>">
                                        <?php echo get_next_post()->post_title ?>
                                    </a>
                                </div>
                                <div class="list-posts__item-date">
                                    <?php
                                    $date_prev = date_create(get_next_post()->post_date);
                                    echo date_format($date_prev, "F j, Y");
                                    ?>
                                </div>
                            </div>

                            <div class="single__nav-next">
                                <div class="mg-bt-1">
                                    <?php previous_post_link('%link', 'Next', true); ?>
                                </div>
                                <div class="single__nav-title mg-bt-1">
                                    <a href="<?php echo get_previous_post()->guid ?>">
                                        <?php echo get_previous_post()->post_title ?>
                                    </a>
                                </div>
                                <div class="list-posts__item-date">
                                    <?php
                                    $date_next = date_create(get_previous_post()->post_date);
                                    echo date_format($date_next, "F j, Y");
                                    ?>
                                </div>
                            </div>
                        </div>

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