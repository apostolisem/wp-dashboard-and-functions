<?php
/*
** Custom Dashboard Template
*/

// die if not called from withing wordpress universe
defined( 'ABSPATH' ) or die( 'error!' );

// load current user variables
$current_user = wp_get_current_user();

// get domain
function wpc_get_domain() {
  return str_replace("www.", "", $_SERVER['HTTP_HOST']);
}

// load global settings from plugin-settings.php
global $wpc;

// gather the post data if form is submitted
$wpc_name = (isset($_POST['wpc_name'])) ? $_POST['wpc_name'] : '';

// gather the email address of the user

$wpc_email = (isset( $_POST['wpc_email'])) ?  $_POST['wpc_email'] : '';
$wpc_error = '';

if (strlen($wpc_email) > 0 && is_email($wpc_email)) {
  $wpc_email = $_POST['wpc_email'];
} elseif (strlen($wpc_email) > 0 && !is_email($wpc_email)) {
  $wpc_error = __("The email address you entered is not correct, please try again!",'wpcare-dashboard-and-functions');
}

// gather the message of support request
$wpc_message = (isset($_POST['wpc_message'])) ? $_POST['wpc_message'] : '' ;
?>

<style>
	div .about-text {
		color: #555d66;
		font-size: 19px;
		font-weight: 400;
		line-height: 1.6;
		margin: 10px 0 20px 0;
		outline: 0;
	}

	h1 {
		color: #32373c;
		display: block;
		font-size: 30px!important;
		font-weight: 600!important;
		line-height: 1.3!important;
		margin: 0!important;
		padding: 10px 0 0 0!important;
	}

	h2 {
		font-size: 1.6em;
		text-transform: uppercase!important;
	}

	.col-container {
		background-color: #ffffff;
		padding: 10px 0;
		border:1px solid #cccccc;
		float:left;
    width:100%;
    margin-bottom: 20px;
	}

	.inside .dashicons {
		font-size: 1.6em;
		margin-bottom: 18px;
	}

	.inside a {
		font-size: 16px;
	}

	.col-1-4 {
		width: 20%;
    min-width: 155px;
		float:left;
    padding: 0 2%;
    margin: 2% 0;
  }

  .col-1-4:not(:first-child) {
    border-left:1px solid #ccc;
  }

  .col-1-1 {
    width:auto;
    max-width: 1000px;
    float:left;
    padding: 0 2%;
    margin: 0;
  }

  .col-1-2 {
    min-width: 284px;
    width: 46%;
		float:left;
    padding: 0 2%;
    margin: 0;
  }

  label {
    line-height: 2em;
    margin-left: 6px;
    margin-bottom: 10px;
  }

  input {
    padding: 3px 8px!important;
    margin-bottom:6px!important;
  }

  .website-info li {
    margin-bottom: 6px;
    padding:10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    background-color:#0099FE;
    color:#fff;
  }

  .website-info li a,
  .website-info li a:hover {
    color:#fff;
  }
</style>

<div class="wrap" style="max-width: 1000px;">

	<h1><?php _e( 'Dashboard', 'wpcare-dashboard-and-functions' ); ?></h1>
  <?php
  // check if we have all the data to send the support request
  if (!$wpc_error && $wpc_name && $wpc_email && $wpc_message) {

    //php mailer variables
      $to = $wpc['company_email'];
      $subject =  "Support Request from " . wpc_get_domain();
      $headers =  'From: no-reply@' . wpc_get_domain() . "\r\n" .
                  'Reply-To: ' . $wpc_email . "\r\n";

      if(wp_mail($to, $subject, strip_tags($wpc_message), $headers)) { // message sent
        $success_msg = __('Success! Support Request Sent, we\'ll contact you soon!','wpcare-dashboard-and-functions');
        echo '<div class="notice notice-success inline"><p>'.$success_msg.'</p></div>';
        $wpc_message = '';
      }
      else  { // message not sent
        $uknown_error = __('Unknown Error!','wpcare-dashboard-and-functions');
        echo '<div class="notice notice-error inline"><p>'.$uknown_error.'</p></div>';
      }

  } elseif (strlen($wpc_error) > 0) {
    $error_ = __("Error!",'wpcare-dashboard-and-functions');
    echo '<div class="notice notice-error inline"><p>'.$error_.' '.$wpc_error.'</p></div>';
  }
  ?>

	<div class="about-text">
		<?php echo sprintf(__('Welcome %s! We\'ve added a few links on this page to help you manage your website. For further assistance, please use the embedded form below to request support.','wpcare-dashboard-and-functions' ), ucfirst($current_user->display_name)); ?>
	</div><!-- .about-text -->

	<div class="col-container">

				<div class="col-1-4">
						<div class="inside">
							<h2>
								<span class="dashicons dashicons-admin-appearance"></span><br />
								<?php _e('Pages & Posts','wpcare-dashboard-and-functions'); ?>
							</h2>
							<ul>
								<li><a href="<?php echo get_admin_url(null, '/post-new.php'); ?>"><?php _e('Add New Blog Post','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/edit.php'); ?>"><?php _e('Edit Existing Post','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="<?php echo get_admin_url(null, '/post-new.php?post_type=page'); ?>"><?php _e('Add New Page','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/edit.php?post_type=page'); ?>"><?php _e('Edit Existing Page','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/edit-tags.php?taxonomy=category'); ?>"><?php _e('Blog Categories','wpcare-dashboard-and-functions'); ?></a></li>
							</ul>
					</div><!-- .inside -->
				</div><!-- .col-4 -->

        <?php if ($wpc['enable_woo_functions']) { /* show woo menu only if woo is active */ ?>

				<div class="col-1-4">
						<div class="inside">
							<h2>
								<span class="dashicons dashicons-store"></span><br />
								<?php _e('Ecommerce','wpcare-dashboard-and-functions'); ?>
							</h2>
							<ul>
								<li><a href="<?php echo get_admin_url(null, '/edit.php?post_type=shop_order'); ?>"><?php _e('Recent Orders','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/edit.php?post_type=shop_coupon'); ?>"><?php _e('Coupon Codes','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/admin.php?page=wc-reports'); ?>"><?php _e('Reports & Analytics','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/post-new.php?post_type=product'); ?>"><?php _e('Add New Products','wpcare-dashboard-and-functions'); ?></a></li>
								<li><a href="<?php echo get_admin_url(null, '/edit.php?post_type=product'); ?>"><?php _e('Edit Products','wpcare-dashboard-and-functions'); ?></a></li>
							</ul>
					</div><!-- .inside -->
				</div><!-- .col-4 -->

      <?php } /* end of woo check */ ?>

        <div class="col-1-4">
            <div class="inside">
              <h2>
                <span class="dashicons dashicons-admin-media"></span><br />
                <?php _e('Site Options','wpcare-dashboard-and-functions'); ?>
              </h2>
              <ul>
                <li><a href="<?php echo get_admin_url(null, '/profile.php'); ?>"><?php _e('Edit My Profile','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="<?php echo get_admin_url(null, '/media-new.php'); ?>"><?php _e('Add Media','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="<?php echo get_admin_url(null, '/upload.php'); ?>"><?php _e('View Media Library','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="<?php echo get_admin_url(null, '/users.php'); ?>"><?php _e('View Users','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="<?php echo get_admin_url(null, '/nav-menus.php'); ?>"><?php _e('Navigation Menus','wpcare-dashboard-and-functions'); ?></a></li>
              </ul>
          </div><!-- .inside -->
        </div><!-- .col-4 -->

        <div class="col-1-4">
            <div class="inside">
              <h2>
                <span class="dashicons dashicons-list-view"></span><br />
                <?php _e('Useful Links','wpcare-dashboard-and-functions'); ?>
              </h2>
              <ul>
                <li><a href="https://wpcare.gr/my-account/" target="_blank"><?php _e('My Account','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="https://wpcare.gr/tools/crm/knowledge-base" target="_blank"><?php _e('Owners Manual','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="https://wpcare.gr/tools/crm/knowledge-base" target="_blank"><?php _e('Help & Tutorials','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="https://wpcare.gr/blog/" target="_blank"><?php _e('WPCARE blog','wpcare-dashboard-and-functions'); ?></a></li>
                <li><a href="https://wpcare.gr/pricing/" target="_blank"><?php _e('Maintenance Plans','wpcare-dashboard-and-functions'); ?></a></li>
              </ul>
          </div><!-- .inside -->
        </div><!-- .col-4 -->

		</div><!-- #col-container -->

    <div class="col-container">

      <div class="col-1-2 website-info">
        <h3 style="border-bottom: 1px solid #ccc; padding-bottom: 20px;"><?php _e( 'Request Support' ,'wpcare-dashboard-and-functions'); ?></h3>
        <p style="font-size:12px;"><?php echo sprintf(__('Fill the form below and "Send a Request" to our Support team. Wee\'ll inform you in advance if any charges apply. Alternatively, you can drop us an <a href="mailto:%s">e-mail</a>.','wpcare-dashboard-and-functions'), $wpc['company_email']); ?></p>

        <form method="post">
          <label><?php _e('Name','wpcare-dashboard-and-functions'); ?>:<br />
            <input type="text" name="wpc_name" value="<?php echo $current_user->display_name; ?>" class="regular-text" /></label><br />
            <label><?php _e('E-mail','wpcare-dashboard-and-functions'); ?>:<br />
              <input type="text" name="wpc_email" value="<?php echo $current_user->user_email; ?>" class="regular-text" /></label><br />
            <label><?php _e('Your message','wpcare-dashboard-and-functions'); ?>:<br />
            <textarea name="wpc_message" style="width: 100%; padding:10px;" rows="6"><?php echo strip_tags($wpc_message); ?></textarea></label>
            <?php submit_button( $text = __('Send Request'), $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null ); ?>
        </form>
      </div> <!-- .col-1-2 -->

    <?php
    // request subscription information about the current domain
    // tip: easy to implement with some knowledge in json api requests
    $json_data1 = @file_get_contents($wpc['api_url']."/domains/json.php?ver=1&action=messages&domain=".wpc_get_domain());
    $json_data1 = json_decode($json_data1, true);
    ?>

        <div class="col-1-2 website-info">

          <h3 style="border-bottom: 1px solid #ccc; padding-bottom: 20px;"><?php _e('Messages from','wpcare-dashboard-and-functions'); ?> <?php echo $wpc['company_name'];?></h3>

          <?php
            // output the messages connected with the current domain
          if (is_array($json_data1)) {
            foreach ($json_data1 as $message) {

              $message = explode(":::", $message);

              echo "<ul>";
              echo "<li>[".$message[0]."]<br />".$message[1]."</li>";
              echo "</ul>";
            }
          } else {
            echo "<ul><li>no messages</li></ul>";
          }
          ?>

          <?php
            // request subscription information about the current domain
            // easy to implement with some knowledge in json api requests
            $json_data = @file_get_contents($wpc['api_url']."/domains/json.php?ver=1&action=data&domain=".wpc_get_domain());
            $json_data = json_decode($json_data, true);
          ?>

          <br />
          <h3 style="border-bottom: 1px solid #ccc; padding-bottom: 20px;"><?php _e('Website Information','wpcare-dashboard-and-functions'); ?></h3>
          <p><strong><?php _e('Domain:','wpcare-dashboard-and-functions'); ?></strong> <?php echo $json_data['domain']; ?></p>
          <p><strong><?php _e('Domain Expiration:','wpcare-dashboard-and-functions'); ?></strong> <?php echo $json_data['dom_exp']; ?> (<a href="<?php echo $json_data['dom_renew']; ?>" target="_blank">renew</a>)</p>
          <p><strong><?php _e('Plan:','wpcare-dashboard-and-functions'); ?></strong> <?php echo $json_data['hosting']; ?></p>
          <p><strong><?php _e('Plan Expiration:','wpcare-dashboard-and-functions'); ?></strong> <?php echo $json_data['hosting_exp']; ?> (<a href="<?php echo $json_data['hosting_renew']; ?>" target="_blank">renew</a>)</p>
          <p><a href="https://wpcare.gr/pricing/" target="_blank"><?php _e('Do you need help with your site\'s management? Subscribe for a Maintenance Plan with 35% discount (use WPC2020 coupon code on checkout).'); ?></a></p>
          <p><?php _e('<strong>Tip:</strong> To ensure the smooth running of your website, please renew the above services before they expire.','wpcare-dashboard-and-functions'); ?></p>
        </div> <!-- .col-1-2 -->

    </div><!-- #col-container -->


</div><!-- .wrap -->
