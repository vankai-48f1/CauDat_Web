<?php get_header() ?>

<!-- Content Category News -->
<?php get_template_part('template-parts/header'); ?>

<div class="category mg-t-5 mg-bt-5">
    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <?php get_sidebar() ?>
            </div>
            <div class="col-lg-8">
                <div class="category__right">
                    <div class="list-posts">
                        <?php if (have_posts()) : $i = 0; ?>

                            <?php while (have_posts()) : the_post();
                                ++$i; ?>

                                <article class="list-posts__item <?php echo $i === 1 ? 'list-posts__item-first' : '' ?>">
                                    <div class="list-posts__thumb">
                                        <a href="<?php the_permalink() ?>" class="list-posts__thumb-wrap">
                                            <?php the_post_thumbnail() ?>
                                        </a>
                                    </div>
                                    <div class="list-posts__content">
                                        <?php the_category() ?>

                                        <h4>
                                            <a href="<?php the_permalink() ?>" class="list-posts__item-title hover-black">
                                                <?php the_title() ?>
                                            </a>
                                        </h4>
                                        <div class="list-posts__item-excerpt">
                                            <a href="<?php the_permalink() ?>" class="hover-black">
                                                <?php the_excerpt() ?>
                                            </a>
                                        </div>

                                        <div class="list-posts__item-group">
                                            <span class="list-posts__item-date"><?php echo get_the_date('F j, Y');  ?></span>
                                            <span class="list-posts__delimiter">/</span>
                                            <span class="list-posts__item-author">
                                                by <b><?php echo get_the_author() ?></b>
                                            </span>

                                            <?php if ($i === 1) : ?>
                                                <span class="list-posts__delimiter">/</span>
                                                <span class="list-posts__item-comment"><?php echo get_comments_number() ?>&ensp;Comments</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>

                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mg-t-1">
                        <?php m_paginate() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>