<?php 

/**
 * 
 * Plugin Name: Show Job Applied For
 * Description: Show job applied for
 * Author: Dane Shingu
 * 
 */

add_action('init', function ($p) {

    if (isset($_POST['job_id']) && isset($_POST['resume_id'])) {
        
        update_post_meta($_POST['resume_id'], 'job_id_applied_to', get_post($_POST['job_id'])->post_title);
    }  

});

add_filter('manage_resume_posts_columns', function ($column_headers) {
  $column_headers['applied_to'] = 'Job Applied to';
  return $column_headers;
});



add_action( 'manage_resume_posts_custom_column', function ( $column, $post_id ) {
    // Image column
    if ( 'applied_to' === $column )  { 
        $job_id = get_post_meta($post_id, 'job_id_applied_to');

        if ($job_id) {
            $job = $job_id[0];

            echo $job;

        }
    }

}, 10, 2);

  

