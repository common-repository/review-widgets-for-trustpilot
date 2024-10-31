<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$ti_success = null;
$ti_error = null;
$ti_command = isset($_POST['command']) ? sanitize_text_field($_POST['command']) : null;
if (!in_array($ti_command, array("register"))) { $ti_command = null; }
if ($ti_command == "register")
{
check_admin_referer( 'register-reg_'.$trustindex_pm_trustpilot->get_plugin_slug());
$sanitized_email = sanitize_email($_POST['email']);
$sanitized_password = sanitize_text_field($_POST['password']);
$sanitized_url = esc_url_raw($_POST['url']);
if (
$sanitized_email
&& $sanitized_password
&& $sanitized_url
)
{
$server_output = $trustindex_pm_trustpilot->connect_trustindex_api(
array(
"pre_profile" => array(
"agent_id" => "sys",
"campaign_id" => "wp-trustpilot",
"language" => substr(get_locale(), 0, 2),
"email" => $sanitized_email,
"password" => $sanitized_password,
"website" => $sanitized_url
)
),
"new"
);
if ($server_output['success'])
{
wp_redirect( admin_url('admin.php?page='.$trustindex_pm_trustpilot->get_plugin_slug().'/settings.php&tab=setup_trustindex_join') );
exit;
}
else
{
$ti_error = json_encode($server_output);
}
}
else
{
$ti_error = TrustindexPlugin::___('You must provide a password and a valid e-mail, url!');
}
}
$trustindex_subscription_id = $trustindex_pm_trustpilot->is_trustindex_connected();
$widget_number = $trustindex_pm_trustpilot->get_trustindex_widget_number();
?>
<?php if ($ti_error): ?>

	<?php echo TrustindexPlugin::get_noticebox("error", $ti_error); ?>

<?php endif; ?>

<?php if ($trustindex_subscription_id): ?>

<h1><?php  echo TrustindexPlugin::___('Trustindex account'); ?></h1>
<p>
		<?php echo TrustindexPlugin::___("Your %s is connected.", [ TrustindexPlugin::___('Trustindex account') ]); ?><br />

- <?php  echo TrustindexPlugin::___('Your subscription ID:'); ?> <strong><?php  echo $trustindex_subscription_id; ?></strong><br />
</p>
<form method="post" action="<?php  echo admin_url('admin.php?page='.$trustindex_pm_trustpilot->get_plugin_slug().'/settings.php&tab=setup_trustindex_join'); ?>">
<input type="hidden" name="command" value="disconnect" />
		<?php wp_nonce_field( 'disconnect-reg_'.$trustindex_pm_trustpilot->get_plugin_slug() ); ?>

<button class="btn btn-delete" type="submit"><?php  echo TrustindexPlugin::___("Disconnect"); ?></button>
</form>
<?php else: ?>

<div id="tab-setup_trustindex">
<div class="ti-box">
<div class="ti-row">
<div class="ti-col-6">
<h1><?php  echo TrustindexPlugin::___('Skyrocket Your Sales with Customer Reviews'); ?></h1>
<h2>
						<?php echo TrustindexPlugin::___('20,000+ WordPress websites use Trustindex to embed reviews fast and easily.'); ?><br />

						<?php echo TrustindexPlugin::___('Increase SEO, trust and sales using customer reviews.'); ?>

</h2>
<h3><?php  echo TrustindexPlugin::___('Top Features'); ?></h3>
<ul class="ti-check">
<li><?php  echo TrustindexPlugin::___("%d Review Platforms", [ $trustindex_pm_trustpilot->get_platform_count() ]); ?></li>
<li><?php  echo TrustindexPlugin::___('Create Unlimited Number of Widgets'); ?></li>
<li><?php  echo TrustindexPlugin::___('Mix Reviews from Different Platforms'); ?></li>
<li><?php  echo TrustindexPlugin::___('Get More Reviews!'); ?></li>
<li><?php  echo TrustindexPlugin::___('Manage All Reviews in 1 Place'); ?></li>
<li><?php  echo TrustindexPlugin::___('Automatically update with NEW reviews'); ?></li>
<li><?php  echo TrustindexPlugin::___('Display UNLIMITED number of reviews'); ?></li>
</ul>
<a class="btn-text btn-lg arrow-btn" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-trustpilot-3" target="_blank"><?php  echo TrustindexPlugin::___('Create a Free Trustindex Account for More Features'); ?></a>
</div>
<div class="ti-col-6">
<script defer async src='https://cdn.trustindex.io/loader.js?76afafc10ad42261d7587d98bf'></script>
</div>
</div>
</div>
</div>
<?php endif; ?>

<?php /*

<ul class="numbered narrow">
<li>
<form id="form-reg" class="box-content" method="post" action="">
<input type="hidden" name="command" value="register" />
			<?php wp_nonce_field( 'register-reg_'.$trustindex_pm_trustpilot->get_plugin_slug() ); ?>

<div class="form-group">
<label for="ti-reg-email"><?php  echo TrustindexPlugin::___('E-mail'); ?></label>
<input type="email"
placeholder="<?php  echo TrustindexPlugin::___('E-mail'); ?>"
name="email"
class="form-control"
required="required"
id="ti-reg-email"
value="<?php  echo $current_user->user_email; ?>"
/> <br />
<small class="form-text text-danger" id="txt-email-used" style="display: none;">
<a href="<?php  echo admin_url('admin.php?page='.$trustindex_pm_trustpilot->get_plugin_slug().'/settings.php&tab=setup_trustindex_join'); ?>"><?php  echo TrustindexPlugin::___('Email ($email) is already used!'); ?> <?php  echo TrustindexPlugin::___('Connect!'); ?></a>
</small>
</div>
<div class="form-group">
<label for="ti-reg-password"><?php  echo TrustindexPlugin::___('Password'); ?></label>
<input type="password"
placeholder="<?php  echo TrustindexPlugin::___('Password'); ?>"
name="password"
class="form-control"
required="required"
id="ti-reg-password"
/>
</div>
<div class="form-group">
<label for="ti-reg-url"><?php  echo TrustindexPlugin::___('Website URL'); ?></label>
				<?php $my_website = get_site_url(); ?>

<input type="text"
placeholder="<?php  echo TrustindexPlugin::___('Website URL'); ?>"
name="url"
class="form-control"
required="required"
id="ti-reg-url"
value="<?php  echo $my_website; ?>"
/>
</div>
<button type="submit" class="btn btn-primary" data-loading-text="<?php  echo TrustindexPlugin::___("Loading") ;?>"><?php  echo TrustindexPlugin::___('CREATE A FREE ACCOUNT');?></button>
<br />
<p class="text-center text-small"><?php  echo TrustindexPlugin::___('By clicking the button I agree to <a href="https://www.trustindex.io/terms-and-conditions-and-privacy-policy/" target="_blank">Terms & Conditions and Privacy Policy</a>.'); ?></p>
</form>
<a href="<?php  echo admin_url('admin.php?page='.$trustindex_pm_trustpilot->get_plugin_slug().'/settings.php&tab=setup_trustindex_join'); ?>"><?php  echo TrustindexPlugin::___('Already have an account?'); ?></a>
</li>
</ul>
*/ ?>