<?php

/*
Menu Work Start
 */

// addming menu page
function fb_comment_menu_page()
{

    add_menu_page('Facebook Comments Settings', 'Facebook Comments', 'manage_options', 'fb_comment_setup', 'fb_comment_setup_callback');

    add_submenu_page('idb-image-slider', 'All Image', 'All Image', 'manage_options', 'fb_comment_setup', 'fb_comment_setup_callback');
}

add_action('admin_menu', 'fb_comment_menu_page');

function fb_comment_setup()
{
    echo 'fb_comment_setup';
}

// Actual form on the settings page
function fb_comment_setup_callback()
{
    global $wpdb;
    $fbtable = $wpdb->prefix . "fbcomsdata";
    $ids = 1;
    echo '<h1>Facebook Comments Settings</h1>';
    require fb_plugin_url . "form.php";
}
