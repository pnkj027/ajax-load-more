<div class="page-case-studies common-padding">
        <div class="container">
            <div class="row" id="case-studies">
                <?php
                $args = [
                    'post_type' => 'post_case_studies',
                    'post_status' => 'publish',
                    'posts_per_page' => '4',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ];
                $loop = new WP_Query($args);
                $found_post = $loop->found_posts;
                $i = 1;
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) {
                        $loop->the_post();
                        ?>
                        <?php get_template_part('inc/Case-Studies/case', 'loop'); ?>
                        <?php
                    }
                    wp_reset_postdata();
                    $i++;
                }
                ?>
            </div>

            <?php if ($loop->max_num_pages > 1): ?>
                <div id="load-more-posts">
                    <span class="theme-btn">Load More</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $nonce = wp_create_nonce('extra-special'); ?>
