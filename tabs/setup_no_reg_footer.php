<li class="<?php  if(!$trustindex_pm_trustpilot->is_noreg_linked() || !$style_id): ?>disabled<?php  endif; ?>">
<h3><?php  echo TrustindexPlugin::___('Insert this shortcode into your website'); ?></h3>
	<?php if($trustindex_pm_trustpilot->is_noreg_linked() && $style_id): ?>

<code class="code-shortcode">[<?php  echo $trustindex_pm_trustpilot->get_shortcode_name(); ?> no-registration=trustpilot]</code>
<a href=".code-shortcode" class="btn-text btn-copy2clipboard"><?php  echo TrustindexPlugin::___("Copy to clipboard") ;?></a>
	<?php else: ?>

<p><?php  echo TrustindexPlugin::___("Do not skip the previous steps!"); ?></p>
	<?php endif; ?>

</li>
<li class="<?php  if(!$trustindex_pm_trustpilot->is_noreg_linked() || !$style_id): ?>disabled<?php  endif; ?>">
<h3><?php  echo TrustindexPlugin::___("Want to get more customers?"); ?></h3>
<a class="btn-text" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-trustpilot-1" target="_blank"><?php  echo TrustindexPlugin::___('Create a Free Account for More Features'); ?></a>
<p>
<strong><?php  echo TrustindexPlugin::___("1. Reviews from ALL these platforms"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Add more reviews to your widget from %s, etc. to enjoy more trust, and to keep customers on your site.", [ 'Google, Facebook, Yelp, Amazon, Tripadvisor, Booking.com, Airbnb, Hotels.com, Bookatable, Capterra, Foursquare, Opentable' ]); ?><br />

<img src="<?php  echo $trustindex_pm_trustpilot->get_plugin_file_url('static/img/platforms.png'); ?>" alt="" />
</p>
<p>
<strong><?php  echo TrustindexPlugin::___("2. Unlock new, exclusive styles"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Pick from 13 widget layouts and 9 predesigned styles to match the branding of your website."); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___("3. Hide Negative Reviews - THIS IS GREAT!"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Turn on email alert to ALL new reviews, so that you can manage them quickly."); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___("4. New Review Notification"); ?></strong><br />
		<?php echo TrustindexPlugin::___("You can mix your reviews from different platforms and display them in 1 review widget."); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___("5. Get More Reviews!"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Use our Review Invitation System to collect hundreds of new reviews. Become impossible to resist!"); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___("6. Automatically update with NEW reviews"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Wordpress cannot update reviews, but Trustindex can! As soon as you get a new review, Trustindex Business can automatically add it to your website. Customers love fresh reviews!"); ?>

</p>
<p>
<strong><?php  echo TrustindexPlugin::___("7. Display UNLIMITED number of reviews"); ?></strong><br />
		<?php echo TrustindexPlugin::___("You can test Trustindex with 10 reviews in the free version. Upgrade to Business to display ALL the reviews received. Be the undisputed customer choice in your industry!"); ?>

</p>
<br />
<a class="btn-text" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-trustpilot-2" target="_blank"><?php  echo TrustindexPlugin::___('Create a Free Account for More Features'); ?></a>
<br />
<br />
<p>
<strong><?php  echo TrustindexPlugin::___("DAILY DEAL"); ?></strong><br />
		<?php echo TrustindexPlugin::___("Fast onboarding discount: save 30%% on your annual fee. See details after <a href='%s' target='_blank'>registration</a>", [ 'https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-trustpilot' ]); ?>

</p>
</li>