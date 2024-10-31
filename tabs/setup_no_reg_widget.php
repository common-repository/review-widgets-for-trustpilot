<li class="<?php  if(!$trustindex_pm_trustpilot->is_noreg_linked()): ?>disabled<?php  endif; ?>">
<h3><?php  echo TrustindexPlugin::___('Configure your Widget'); ?></h3>
<div class="ti-left-block">
		<?php if($trustindex_pm_trustpilot->is_noreg_linked()): ?>

<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Select your template'); ?></h4>
<form method="post" action="">
<input type="hidden" name="command" value="save-style" />
				<?php wp_nonce_field( 'save-style_'.$trustindex_pm_trustpilot->get_plugin_slug(), '_wpnonce_style' ); ?>

<select class="form-control" id="ti-style-id" name="style_id">
				<?php foreach(['horizontal', 'vertical', 'badge', 'popup'] as $type): ?>

<optgroup label="<?php  echo TrustindexPlugin::___(ucfirst($type)); ?>">
					<?php foreach(TrustindexPlugin::$widget_templates as $id => $template): ?>

						<?php if($template['type'] == $type): ?>

<option value="<?php  echo $id; ?>" <?php  echo $style_id == $id ? 'selected' : ''; ?>><?php  echo TrustindexPlugin::___($template['name']); ?></option>
						<?php endif; ?>

					<?php endforeach; ?>

</optgroup>
				<?php endforeach; ?>

</select>
</form>
		<?php else: ?>

<p><?php  echo TrustindexPlugin::___("Do not skip the previous steps!"); ?></p>
		<?php endif; ?>

</div>
	<?php if($trustindex_pm_trustpilot->is_noreg_linked() && $style_id): ?>

<div class="ti-right-block">
<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Select your style'); ?></h4>
<form method="post" action="">
<input type="hidden" name="command" value="save-set" />
				<?php wp_nonce_field( 'save-set_'.$trustindex_pm_trustpilot->get_plugin_slug(), '_wpnonce_set' ); ?>

<select class="form-control" id="ti-set-id" name="set_id">
				<?php foreach(TrustindexPlugin::$widget_styles as $id => $name): ?>

<option value="<?php  echo $id; ?>" <?php  echo $scss_set == $id ? 'selected' : ''; ?>><?php  echo TrustindexPlugin::___($name); ?></option>
				<?php endforeach; ?>

</select>
</form>
</div>
<div class="clear"></div>
<div id="ti-filter" class="ti-left-block">
<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Filter your ratings'); ?></h4>
<div class="ti-select" id="show-star" data-platform="trustpilot">
<font></font>
<ul>
<li data-value="1,2,3,4,5" <?php  echo count($filter['stars']) > 2 ? 'class="selected"' : ''; ?>><?php  echo TrustindexPlugin::___('Show all'); ?></li>
<li data-value="4,5" <?php  echo count($filter['stars']) == 2 ? 'class="selected"' : ''; ?>>
						<?php echo TrustindexPlugin::get_rating_stars(4); ?> - <?php echo TrustindexPlugin::get_rating_stars(5); ?>

</li>
<li data-value="5" <?php  echo count($filter['stars']) == 1 ? 'class="selected"' : ''; ?>>
						<?php echo TrustindexPlugin::___('only'); ?> <?php echo TrustindexPlugin::get_rating_stars(5); ?>

</li>
</ul>
</div>
</div>
<div class="ti-right-block">
<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Select language'); ?></h4>
<form method="post" action="">
<input type="hidden" name="command" value="save-language" />
				<?php wp_nonce_field( 'save-language_'.$trustindex_pm_trustpilot->get_plugin_slug(), '_wpnonce_language' ); ?>

<select class="form-control" name="lang" id="ti-lang-id">
					<?php foreach(TrustindexPlugin::$widget_languages as $id => $name): ?>

<option value="<?php  echo $id; ?>" <?php  echo $lang == $id ? 'selected' : ''; ?>><?php  echo $name; ?></option>
					<?php endforeach; ?>

</select>
</form>
</div>
<div class="clear"></div>
<div class="ti-left-block">
<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Select date format'); ?></h4>
<form method="post" action="">
<input type="hidden" name="command" value="save-dateformat" />
				<?php wp_nonce_field( 'save-dateformat_'.$trustindex_pm_trustpilot->get_plugin_slug(), '_wpnonce_dateformat' ); ?>

<select class="form-control" name="dateformat" id="ti-dateformat-id">
					<?php foreach(TrustindexPlugin::$widget_dateformats as $format): ?>

<option value="<?php  echo $format; ?>" <?php  echo $dateformat == $format ? 'selected' : ''; ?>><?php  echo date($format); ?></option>
					<?php endforeach; ?>

</select>
</form>
</div>
<div class="ti-right-block">
<h4 style="font-size: 120%;margin-bottom: 0.5em"><?php  echo TrustindexPlugin::___('Other settings'); ?></h4>
<form method="post" action="" id="ti-widget-options">
<input type="hidden" name="command" value="save-options" />
				<?php wp_nonce_field( 'save-options_'.$trustindex_pm_trustpilot->get_plugin_slug(), '_wpnonce_options' ); ?>

				<?php if(TrustindexPlugin::$widget_templates[ $style_id ]['type'] != 'badge'): ?>

<span class="ti-checkbox row">
<input type="checkbox" id="ti-filter-only-ratings" class="no-form-update" name="only-ratings" value="1" <?php  if($filter['only-ratings']): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Hide reviews without comments"); ?></label>
</span>
				<?php endif; ?>

				<?php if(!in_array($style_id, [17, 18, 21, 24, 25, 26, 27, 28, 29, 30, 35])): ?>

<span class="ti-checkbox row">
<input type="checkbox" name="no-rating-text" value="1" <?php  if($no_rating_text): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Hide rating text"); ?></label>
</span>
				<?php endif; ?>

				<?php if(TrustindexPlugin::$widget_templates[ $style_id ]['type'] != 'badge'): ?>

<span class="ti-checkbox row">
<input type="checkbox" name="verified-icon" value="1" <?php  if($verified_icon): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Show verified review icon"); ?></label>
</span>
				<?php endif; ?>

				<?php if(TrustindexPlugin::$widget_templates[ $style_id ]['type'] != 'badge' && !in_array($style_id, [8, 9, 10, 18, 16, 17, 21, 23, 30, 31, 32, 33])): ?>

<span class="ti-checkbox row">
<input type="checkbox" name="show-arrows" value="1" <?php  if($show_arrows): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Show navigation arrows"); ?></label>
</span>
				<?php endif; ?>

				<?php if(TrustindexPlugin::$widget_templates[ $style_id ]['type'] != 'badge'): ?>

<span class="ti-checkbox row">
<input type="checkbox" name="show-reviewers-photo" value="1" <?php  if($show_reviewers_photo): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Show reviewers' photo"); ?></label>
</span>
				<?php endif; ?>

<span class="ti-checkbox row">
<input type="checkbox" name="enable-animation" value="1" <?php  if($enable_animation): ?>checked<?php  endif;?>>
<label><?php  echo TrustindexPlugin::___("Enable animation"); ?></label>
</span>
</form>
</div>
<div class="clear"></div>
<br />
<br />
<h3 class="box-title"><?php  echo TrustindexPlugin::___("Preview"); ?></h3>
		<?php if(in_array($style_id, [17, 21])): ?>

<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
				<?php echo TrustindexPlugin::___("The widget will be pinned to bottom of the page."); ?><br />

</p>
</div>
		<?php endif; ?>

<div class="ti-preview-box" style="margin: 0">
<div id="ti-review-list"><?php  echo $trustindex_pm_trustpilot->get_noreg_list_reviews(null, true); ?></div>
<div style="display: none; text-align: center">
				<?php echo TrustindexPlugin::___("You do not have reviews with the current filters. <br />Change your filters if you would like to display reviews on your page!"); ?>

</div>
</div>
	<?php endif; ?>

<div class="clear"></div>
</li>