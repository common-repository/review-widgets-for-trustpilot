<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<div class="ti-box rate-us en">
<div class="ti-box-head">
<div class="ti-row">
<div class="ti-col">
<h1><?php  echo TrustindexPlugin::___('Please help us by reviewing our Plugin.'); ?></h1>
<p><?php  echo TrustindexPlugin::___('Thank you in advance!'); ?></p>
</div>
<div class="ti-col-auto rate-us-wrapper">
<a class="btn-text btn-lg" href="https://wordpress.org/support/plugin/<?php  echo $trustindex_pm_trustpilot->get_plugin_slug(); ?>/reviews/?rate=5#new-post" target="_blank"><?php  echo TrustindexPlugin::___('Click here to rate us!'); ?></a>
</div>
</div>
</div>
<hr>
<div class="ti-row">
<div class="ti-col-12">
<script defer async src='https://cdn.trustindex.io/loader.js?c1c627610fde227dfc5bbac1ec'></script>
</div>
</div>
</div>