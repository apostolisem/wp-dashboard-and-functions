<?php
/*
** change the settings below, customize the plugin
** and share it to your clients.
*/

// work only if called from withing wordpress universe
defined( 'ABSPATH' ) or die( 'error!' );

/*
** add wordpress administration bootstrap
*/
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );

/*
** add a global plugin settings variable
*/
global $wpc;

/*
** edit your company info
*/
$wpc['company_name'] = "WordPress Care";
$wpc['company_website'] = "https://wpcare.gr";
$wpc['company_email'] = "info@wpcare.gr";

/*
** login alerts to "company_email" of users
** with "edit_pages" capability
*/
$wpc['enable_login_alerts'] = 1; // default 1 = yes

/*
** disable the mail alerts of automatic core updates
** (updates are not affected)
*/
$wpc['disable_auto_update_core_alerts'] = 1; // default 1 = yes

/*
** add a custom "Thank you for trusting
** Company Name for your WordPress needs" text on footer
*/
$wpc['add_custom_footer_text'] = 1; // default 1 = yes

/*
** limit the wp heartbeat to minimum
*/
$wpc['limit_heartbeat_interval'] = 1; // default 1 = yes
