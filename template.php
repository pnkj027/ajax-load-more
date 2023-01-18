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
                        <?php //loop code here ?>
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
<script>
    jQuery(document).ready(function () {

        var total = <?php echo $found_post; ?>;
        offset = 4;
        jQuery('#load-more-posts').click(function () {
            jQuery(this).html('<div class="spinner-border text-primary" role="status"> <span class="visually-hidden">Loading...</span></div>');
            //console.log('loading');

            var data = {
                'action': 'load_more_posts',
                'offset': offset,
                'security': '<?php echo $nonce; ?>',
            };

            jQuery.post(ajaxurl, data, function (response) {
                if (response !== '') {
                    jQuery('#case-studies').append(response);
                    offset += 4;
                    jQuery('#case-studies').css('opacity', '1');
                    jQuery('#load-more-posts').html('<span class="theme-btn">Load More</span>');
                    jQuery('#case-studies > div').each(function (index) {
                        if (total - 1 == index) {
                            jQuery('#load-more-posts').hide();
                        } else {
                            //alert('not');
                        }

                    });
                }
            });
        });
    });
</script>
