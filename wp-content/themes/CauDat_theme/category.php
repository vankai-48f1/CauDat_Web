<?php get_header() ?>

<!-- Content Category News -->
<?php get_template_part('template-parts/header'); ?>

<!-- Content -->
<?php
$category = get_queried_object();
$template_cat = get_field('template_category', $category);

if($template_cat) {
    get_template_part('template-parts/category', 'columns');
} else {
    get_template_part('template-parts/category', 'side');
}

?>

<!-- /.container -->
<?php get_footer() ?>