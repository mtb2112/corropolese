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
?>