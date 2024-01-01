<?php
function limit_total_posts($data, $postarr) {
    // Check if it's the custom post type you want to limit
    if ($data['post_type'] == 'cpr' && !(wp_is_post_revision($postarr["ID"]) || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || wp_is_post_autosave($postarr["ID"]))) {
        // Set the maximum allowed posts
        $max_posts = 6;

        // Count the total number of published posts for the custom post type
        $total_post_count = (isset(wp_count_posts('cpr')->publish) &&  ( 'trash' != $data['post_status'] ))?wp_count_posts('cpr')->publish:0;

        // Check if the total number of posts has reached the limit
        if ($total_post_count >= $max_posts) {
            // If the limit is reached, prevent the post from being inserted
            $data['post_status'] = 'draft';
            wp_die('Sorry, the maximum number of posts for this custom post type has been reached.');
        }
    }
}

add_filter('wp_insert_post_data', 'limit_total_posts', 10, 2);