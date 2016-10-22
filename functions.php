<?php
    function remove_mobile_header() {
        remove_action('et_header_top', 'et_add_mobile_navigation');
    }

    add_action('wp_loaded', 'remove_mobile_header');
?>