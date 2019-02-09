<?php

/*
Plugin Name: Facebook Comments
Plugin URI: http://www.wpxtrem.com
Description: Muntasir
Author: Muntasir
Author URI: http://www.wpxtrem.com
Version: 1.0
 */

// define

define('fb_plugin_url', plugin_dir_path(__FILE__));

/*
Plugin Activation Work - Start */
require fb_plugin_url . "functions/admin.php";
function fb_comment_plug_install()
{
    global $wpdb;
    $fbtable = $wpdb->prefix . "fbcomsdata";

    $sql1 = "CREATE TABLE IF NOT EXISTS $fbtable (
		id tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
                fbsetup text,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql1);
}

register_activation_hook(__FILE__, 'fb_comment_plug_install');
/*
Plugin Activation Work - End */

/*
Output Work - Start */

/*
Output Work - End */
