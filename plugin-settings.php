<?php
/*
** change the settings below, customize the plugin
** and share it to your clients.
*/

// work only if called from withing wordpress universe
defined( 'ABSPATH' ) or die( 'error!' );

// add a global plugin settings variable
global $wpc;

// edit your company info
$wpc['company_name'] = "WordPress Care";
$wpc['company_website'] = "https://wpcare.gr";
$wpc['company_email'] = "info@wpcare.gr";

// api url to get the website information
$wpc['api_url'] = "https://wpcare.gr/tools/domains/json.php";

// login alerts to "company_email" of users with "edit_pages" capability
$wpc['enable_login_alerts'] = 1; // default 1 = yes

// disable the mail alerts of automatic core updates (updates are not affected)
$wpc['disable_auto_update_core_alerts'] = 1; // default 1 = yes

// add a custom "Thank you for trusting Company Name for your WordPress needs" text on footer
$wpc['add_custom_footer_text'] = 1; // default 1 = yes

// limit the wp heartbeat to the minimum
$wpc['limit_heartbeat_interval'] = 1; // default 1 = yes

// enable woocommerce functions
$wpc['enable_woo_functions'] = 1; // default 1 = yes


################################################################################
### WARNING! DO NOT EDIT BELOW THIS LINE
################################################################################

// if woo is not active then deactivate the woo functions by default
if (!class_exists( 'woocommerce' )) {
  $wpc['enable_woo_functions'] = 0; //
}
