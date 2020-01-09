<?php
/**
 * Custom Dashboard Template
 */

 // work only if called from withing wordpress universe
 defined( 'ABSPATH' ) or die( 'error!' );

// load current user variable
$current_user = wp_get_current_user();

// load global settings from plugin-settings.php
global $settings;
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

	#col-container {
		background-color: #ffffff;
		padding: 0;
		border:1px solid #cccccc;
		float:left;
	}

	.inside .dashicons {
		font-size: 1.6em;
		margin-bottom: 18px;
	}

	.inside a {
		font-size: 16px;
	}

	.col-4 {
		min-width: 180px;
		float:left;
		padding: 40px 30px;
	}
</style>

<div class="wrap" style="max-width: 1080px;">

	<h1><?php _e( 'Dashboard' ); ?></h1>

	<div class="about-text">
		<?php _e('Welcome '.ucfirst($current_user->display_name).'! We\'ve added a few links on this page to help you manage your website. For further assistance, please use the embedded form below to request support.' ); ?>
	</div>

	<div id="col-container">

				<div class="col-4">
						<div class="inside">
							<h2>
								<span class="dashicons dashicons-admin-appearance"></span><br />
								<?php _e('Pages & Posts'); ?>
							</h2>
							<ul>
								<li><a href="#"><?php _e('Add New Page'); ?></a></li>
								<li><a href="#"><?php _e('Edit Existing Page'); ?></a></li>
								<li><a href="#"><?php _e('Add New Blog Post'); ?></a></li>
								<li><a href="#"><?php _e('Edit Existing Post'); ?></a></li>
								<li><a href="#"><?php _e('Blog Categories'); ?></a></li>
							</ul>
					</div>
					<!-- .inside -->
				</div>
				<!-- .col-4 -->

				<div class="col-4">
						<div class="inside">
							<h2>
								<span class="dashicons dashicons-admin-home"></span><br />
								<?php _e('Ecommerce'); ?>
							</h2>
							<ul>
								<li><a href="#"><?php _e('Recent Orders'); ?></a></li>
								<li><a href="#"><?php _e('Coupon Codes'); ?></a></li>
								<li><a href="#"><?php _e('Reports & Analytics'); ?></a></li>
								<li><a href="#"><?php _e('Add New Products'); ?></a></li>
								<li><a href="#"><?php _e('Edit Products'); ?></a></li>
							</ul>
					</div>
					<!-- .inside -->
				</div>
				<!-- .col-4 -->

		</div>
		<!-- #col-container -->


</div>
