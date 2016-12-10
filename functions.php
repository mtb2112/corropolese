<?php
    function remove_cssjs_ver( $src ) {
        if( strpos( $src, '?ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 );
    add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );
    
    function remove_mobile_header() {
        remove_action('et_header_top', 'et_add_mobile_navigation');
    }

    add_action('wp_loaded', 'remove_mobile_header');

    //enqueues our locally supplied font awesome stylesheet
    function enqueue_our_required_stylesheets(){
        wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css'); 
    }
    
    add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

    add_filter( 'wpsl_info_window_template', 'custom_info_window_template' );

    function custom_info_window_template() {
        
        global $wpsl;
       
        $info_window_template = '<div data-store-id="<%= id %>" class="wpsl-info-window">' . "\r\n";
        $info_window_template .= "\t\t" . '<p>' . "\r\n";
        $info_window_template .= "\t\t\t" .  wpsl_store_header_template() . "\r\n";  // Check which header format we use
        $info_window_template .= "\t\t\t" . '<span><%= address %></span>' . "\r\n";
        $info_window_template .= "\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
        $info_window_template .= "\t\t\t" . '<span><%= address2 %></span>' . "\r\n";
        $info_window_template .= "\t\t\t" . '<% } %>' . "\r\n";
        $info_window_template .= "\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n"; // Use the correct address format
        $info_window_template .= "\t\t" . '</p>' . "\r\n";
        $info_window_template .= "\t\t" . '<% if ( phone ) { %>' . "\r\n";
        $info_window_template .= "\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'phone_label', __( 'Phone', 'wpsl' ) ) ) . '</strong>: <%= formatPhoneNumber( phone ) %></span>' . "\r\n";
        $info_window_template .= "\t\t" . '<% } %>' . "\r\n";
        $info_window_template .= "\t\t" . '<% if ( fax ) { %>' . "\r\n";
        $info_window_template .= "\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'fax_label', __( 'Fax', 'wpsl' ) ) ) . '</strong>: <%= fax %></span>' . "\r\n";
        $info_window_template .= "\t\t" . '<% } %>' . "\r\n";
        $info_window_template .= "\t\t" . '<% if ( email ) { %>' . "\r\n";
        $info_window_template .= "\t\t" . '<span><strong>' . esc_html( $wpsl->i18n->get_translation( 'email_label', __( 'Email', 'wpsl' ) ) ) . '</strong>: <%= email %></span>' . "\r\n";
        $info_window_template .= "\t\t" . '<% } %>' . "\r\n";
        
        $info_window_template .= "\t\t" . '<% if ( hours ) { %>' . "\r\n";
        $info_window_template .= "\t\t" . '<div class="wpsl-store-hours"><strong>' . esc_html( $wpsl->i18n->get_translation( 'hours_label', __( 'Hours', 'wpsl' ) ) ) . '</strong>' . "\r\n";
        $info_window_template .= "\t\t" . '<%= hours %>' . "\r\n";
        $info_window_template .= "\t\t" . '</div>' . "\r\n";
        $info_window_template .= "\t\t" . '<% } %>' . "\r\n";    
        
        $info_window_template .= "\t\t" . '<%= createInfoWindowActions( id ) %>' . "\r\n";
        $info_window_template .= "\t" . '</div>';
        
        
        return $info_window_template;
    }

    function pr_scripts_styles() {
        wp_enqueue_script('jquery');

        wp_register_script('custom_js',get_stylesheet_directory_uri().'/js/app.js');
        wp_register_script('scrollbar_js',get_stylesheet_directory_uri().'/js/jquery.mCustomScrollbar.js');

        wp_register_style('scrollbar_css',get_stylesheet_directory_uri().'/css/jquery.mCustomScrollbar.css');

        wp_enqueue_script('custom_js');
        wp_enqueue_script('scrollbar_js');

        wp_enqueue_style('scrollbar_css');
    }

    add_action( 'wp_enqueue_scripts', 'pr_scripts_styles' );

    //Page Slug Body Class
    function add_slug_body_class( $classes ) {
        global $post;
        if ( isset( $post ) ) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        return $classes;
    }
    add_filter( 'body_class', 'add_slug_body_class' );
?>