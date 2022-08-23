<?php if ($args['filter_name']) : ?>
    <div class="filter-gu">
        <?php
        if (have_rows($args['filter_name'], 'option')) : while (have_rows($args['filter_name'], 'option')) : the_row();
        ?>
                <h3><?php echo get_sub_field('title'); ?></h3>

                <?php
                $terms = get_sub_field('attribute');
                if ($terms) : ?>
                    <ul>
                        <?php foreach ($terms as $term) : ?>
                            <?php
                            $tax_name = str_replace('pa_', '', $term->taxonomy);
                            $current_attr = $_GET['filter_' . $tax_name];
                            $current_link = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
                            ?>
                            <li class="<?php echo $current_attr == $term->slug ? 'chosen' : ''; ?>">
                                <a href="<?php echo $current_attr == $term->slug ? $current_link : '?filter_' . $tax_name . '=' . $term->slug; ?>"><?php echo esc_html($term->name); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
        <?php
            endwhile;
        endif;
        ?>
    </div>

<?php endif; ?>