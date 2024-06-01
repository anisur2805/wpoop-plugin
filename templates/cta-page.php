<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?> </h1>
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
		<?php
		settings_fields( 'wpoop_plugin_cpt_settings' );
		do_settings_sections( 'wpoop_cpt' );
		submit_button();
		?>
	</form>
</div>
