<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$video_urls = [
"google" => "https://player.vimeo.com/video/429285826",
"airbnb" => "https://player.vimeo.com/video/429285404",
"amazon" => "https://player.vimeo.com/video/429285589",
"tripadvisor" => "https://player.vimeo.com/video/429286092",
"booking" => "https://player.vimeo.com/video/429285668",
"yelp" => "https://player.vimeo.com/video/429286037",
"hotels" => "https://player.vimeo.com/video/429285880",
];
?>
<div class="maxwidth">
<h1><?php  echo TrustindexPlugin::___('How to use our plugin?');?></h1>
	<?php if(isset($video_urls["trustpilot"])): ?>

<h3><?php  echo TrustindexPlugin::___('Screencast'); ?></h3>
<iframe src="<?php  echo $video_urls["trustpilot"]; ?>" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<h3><?php  echo TrustindexPlugin::___('Step by step'); ?></h3>
	<?php endif; ?>

<p><?php  echo TrustindexPlugin::___('After downloading the Widgets for Trustpilot Reviews, you can find Trustindex.io in the left menu. Click on that and choose "Trustpilot reviews".'); ?></p>
<p><?php  echo TrustindexPlugin::___('Click on <strong>"Setup - Forever free"</strong> tab and follow these steps'); ?>:</p>
<ol>
<li>
			<?php echo TrustindexPlugin::___('Connect your Trustpilot page to our plugin'); ?>

<br /><span class="text-muted"> &nbsp; - <?php  echo TrustindexPlugin::___('The plugin will automatically download some reviews for Trustindex - Trustpilot reviews widget'); ?></span>
</li>
<li>
			<?php echo TrustindexPlugin::___('Configure your widget'); ?>

<br /><span class="text-muted"> &nbsp; - <?php  echo TrustindexPlugin::___('Select your widget template and style, add your language and date format, and filter your reviews if you want to.'); ?></span>
</li>
<li>
			<?php echo TrustindexPlugin::___('Check your widget'); ?>

<br /><span class="text-muted"> &nbsp; - <?php  echo TrustindexPlugin::___('Here you will see the widget you generated as it would be displayed on your website.'); ?></span>
</li>
<li>
			<?php echo TrustindexPlugin::___('Insert this shortcode into your website to display your widget'); ?>

</li>
<li>
			<?php echo TrustindexPlugin::___('Upgrade to Professional Review Plugin'); ?>

<br /><span class="text-muted"> &nbsp; - <?php  echo TrustindexPlugin::___('If you are a professional user, we suggest you to upgrade to the Professional Review Plugin, as it offers significantly better features for companies and businesses than the free version.'); ?></span>
</li>
<li>
			<?php echo TrustindexPlugin::___('Set auto update ON'); ?>

<br /><span class="text-muted"> &nbsp; - <?php  echo TrustindexPlugin::___('Enable auto-updates:'); ?> <a href="http://wp-dev.trustindex.io/wp-admin/plugins.php"><?php  echo TrustindexPlugin::___('here'); ?></a></span>
</li>
</ol>
<p><strong><?php  echo TrustindexPlugin::___('If you would like to display more reviews and modify the links in your widgets, <a href="%s"> create a Free Trustindex account.</a>', [ admin_url('admin.php?page='.$trustindex_pm_trustpilot->get_plugin_slug().'/settings.php&tab=setup_trustindex') ]); ?></strong></p>
<h2><?php  echo TrustindexPlugin::___("Top questions about the Widgets for Trustpilot Reviews Plugin"); ?></h1>
<p>
<strong><?php  echo TrustindexPlugin::___('How many Trustpilot reviews will be downloaded by the free plugin?'); ?></strong><br />
		<?php echo TrustindexPlugin::___('The plugin will download 10 reviews from Trustpilot.'); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___('How many widgets can be generated with the free plugin?'); ?></strong><br />
		<?php echo TrustindexPlugin::___('You can generate and use 1 widget with the plugin in Forever free mode.'); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___('How many widget layout templates can I choose from in the free version?'); ?></strong><br />
		<?php echo TrustindexPlugin::___('You can choose from 9 layout templates.'); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___('How many predesigned widget styles are included in the free version?'); ?></strong><br />
		<?php echo TrustindexPlugin::___('You can use 13 predesigned widget styles.'); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___('Can I filter the reviews by stars in the free plugin?'); ?></strong><br />
		<?php echo TrustindexPlugin::___('Yes, you have the possibility to display your 5-star reviews only.'); ?>

</p>
</div>