<?php
/*
Plugin Name: Widgets for Trustpilot Reviews
Plugin Title: Widgets for Trustpilot Reviews Plugin
Plugin URI: https://wordpress.org/plugins/review-widgets-for-trustpilot/
Description: Embed Trustpilot reviews fast and easily into your WordPress site. Increase SEO, trust and sales using Trustpilot reviews.
Tags: trustpilot, trustpilot reviews, trustpilot recommendations, trustpilot widgets, reviews, trustpilot.com
Author: Trustindex.io <support@trustindex.io>
Author URI: https://www.trustindex.io/
Contributors: trustindex
License: GPLv2 or later
Version: 6.3.1
Text Domain: review-widgets-for-trustpilot
Domain Path: /languages/
Donate link: https://www.trustindex.io/prices/
*/
/*
Copyright 2019 Trustindex Kft (email: support@trustindex.io)
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require(ABSPATH . 'wp-includes/version.php');

/*****************************************************************************/
/* LOAD COMMON CODE */

if (!class_exists('TrustindexPlugin' ) )
{
	$plugin_dirs = scandir(WP_PLUGIN_DIR);
	$ti_plugins = [];

	foreach($plugin_dirs as $dir)
	{
		$class_file = WP_PLUGIN_DIR . '/' . $dir . '/trustindex-plugin.class.php';
		if($dir == '.' || $dir == '..' || !is_dir(WP_PLUGIN_DIR . '/' . $dir) || !file_exists($class_file))
		{
			continue;
		}

		$second_line = array_slice(file($class_file), 1, 1)[0];
		$ti_plugins[$class_file] = (substr($second_line , 0, 14) == '/* GENERATED: ' ? (int)preg_replace('/[^\d]/m', '', $second_line) : 0);
	}

	$plugin_file = array_search(max($ti_plugins), $ti_plugins);
	if(empty($plugin_file))
	{
		$plugin_file = $plugin_dir . "trustindex-plugin.class.php";
	}
	require_once($plugin_file);
}

$trustindex_pm_trustpilot = new TrustindexPlugin("trustpilot", __FILE__, "6.3.1", "Widgets for Trustpilot Reviews");

/*****************************************************************************/
/* INIT HOOKS */
//activation hook
register_activation_hook(__FILE__, array($trustindex_pm_trustpilot, 'activate'));

//deactivation hook
register_deactivation_hook(__FILE__, array($trustindex_pm_trustpilot, 'deactivate'));

//load i18n
add_action('plugins_loaded', array($trustindex_pm_trustpilot, 'loadI18N'));

/******************************************************************************
/* ADMIN MENU */
// menu
add_action('admin_menu', array($trustindex_pm_trustpilot, 'add_setting_menu'), 10);

//plugin list menu
add_filter('plugin_action_links', array($trustindex_pm_trustpilot, 'add_plugin_action_links'), 10, 2);

//plugin page meta links.
add_filter( 'plugin_row_meta', array($trustindex_pm_trustpilot, 'add_plugin_meta_links'), 10, 2 );

/*****************************************************************************/
/* WIDGET */
// widget init
add_action('widgets_init', array($trustindex_pm_trustpilot, 'init_widget'));

//widget register
add_action('widgets_init', array($trustindex_pm_trustpilot, 'register_widget'));

/*****************************************************************************/
/* SHORTCODE */
//init
add_action( 'init', array($trustindex_pm_trustpilot, 'init_shortcode'));

/*****************************************************************************/
/* TINYMCE BUTTON */
//register plugin to tinyMCE
add_action( 'init', array($trustindex_pm_trustpilot, 'register_tinymce_features') );

/*****************************************************************************/
/* APP OUTPUT BUFFER */
add_action( 'init', array($trustindex_pm_trustpilot, 'output_buffer') );

/*****************************************************************************/
/* AJAX FUNCTIONS */
add_action( 'wp_ajax_list_trustindex_widgets', array($trustindex_pm_trustpilot, 'list_trustindex_widgets_ajax') );
add_action( 'admin_enqueue_scripts', array($trustindex_pm_trustpilot, 'trustindex_add_scripts') );

/*************************************************************************/
/* Widget Blocks */
add_action( 'init', array($trustindex_pm_trustpilot, 'register_block_editor') );
add_action( 'rest_api_init', array($trustindex_pm_trustpilot, 'init_restapi') );

//Notice to rate us
function trustindex_rate_us_trustpilot() {
	//Check DB
	$rate_us = get_option('trustindex-trustpilot-rate-us', time() - 1);
	if($rate_us == 'hide' || (int)$rate_us > time())
	{
		return;
	}

	//Check usage
	$dir = WP_PLUGIN_DIR . '/review-widgets-for-trustpilot';
	$usage_time = time() + 10;
	if(is_dir($dir))
	{
		$usage_time = filemtime($dir) + (1 * 86400);
	}

	if($usage_time > time())
	{
		return;
	}
?>
	<div class="notice notice-warning is-dismissible trustindex-popup" style="position: fixed; top: 50px; right: 20px; padding-right: 30px; z-index: 1">
		<p>
			<?php echo TrustindexPlugin::___("Hello, I am happy to see that you've been using our <strong>%s</strong> plugin for a while now!", ["Widgets for Trustpilot Reviews"]); ?><br>
			<?php echo TrustindexPlugin::___("Could you please help us and give it a 5-star rating on WordPress?"); ?><br><br>
			<?php echo TrustindexPlugin::___("-- Thanks, Gabor M."); ?>
		</p>
		<p>
			<a href="<?php echo admin_url("admin.php?page=review-widgets-for-trustpilot/settings.php&rate_us=open"); ?>" class="trustindex-rateus" style="text-decoration: none" target="_blank">
				<button class="button button-primary"><?php echo TrustindexPlugin::___("Sure, you deserve it"); ?></button>
			</a>
			<a href="<?php echo admin_url("admin.php?page=review-widgets-for-trustpilot/settings.php&rate_us=later"); ?>" class="trustindex-rateus" style="text-decoration: none">
				<button class="button button-secondary"><?php echo TrustindexPlugin::___("Maybe later"); ?></button>
			</a>
			<a href="<?php echo admin_url("admin.php?page=review-widgets-for-trustpilot/settings.php&rate_us=hide"); ?>" class="trustindex-rateus" style="text-decoration: none">
				<button class="button button-secondary" style="float: right"><?php echo TrustindexPlugin::___("Do not remind me again"); ?></button>
			</a>
		</p>
	</div>
<?php
}

add_action('admin_notices', 'trustindex_rate_us_trustpilot');

add_action('plugins_loaded', array($trustindex_pm_trustpilot, 'plugin_loaded'));
?>