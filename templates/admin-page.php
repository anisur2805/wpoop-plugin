<div class="wrap">
	<h1>Hello world</h1>
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
		<?php
		settings_fields( 'wpoop_plugin_options_group' );
		do_settings_sections( 'wpoop-plugin' );
		submit_button();
		?>
	</form>
</div>
