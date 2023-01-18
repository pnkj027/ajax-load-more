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
