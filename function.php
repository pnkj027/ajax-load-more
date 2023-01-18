function load_more_posts() {
    $nonce_check = check_ajax_referer('extra-special', 'security');
    if (!$nonce_check) {
        return;
    }

    $offset = $_POST['offset'];

    $args = [
        'post_type' => 'post_case_studies',
        'post_status' => 'publish',
        'posts_per_page' => '4',
        'orderby' => 'date',
        'order' => 'DESC',
        'offset' => $offset,
    ];

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('inc/Case-Studies/case', 'loop');
        }
        wp_reset_postdata();
    }
    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
