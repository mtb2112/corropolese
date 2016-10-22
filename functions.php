<?php
    function remove_mobile_header() {
        remove_action('et_header_top', 'et_add_mobile_navigation');
    }

    add_action('wp_loaded', 'remove_mobile_header');

    //enqueues our locally supplied font awesome stylesheet
    function enqueue_our_required_stylesheets(){
        wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css'); 
    }
    
    add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');
?>