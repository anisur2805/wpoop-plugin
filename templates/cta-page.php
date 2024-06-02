<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?> </h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage CPT</a></li>
		<li><a href="#tab-2">Add new CPT</a></li>
		<li><a href="#tab-3">Export CPT</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="tab-1">
		<h3>Manage Your Custom Post Type</h3>
		<?php
		$output = get_option( 'wpoop_plugin_cpt' );

		?>
		<table>
			<tr>
				<th>ID</th>
				<th>Singular Name</th>
				<th>Plural Name</th>
				<th>Public</th>
				<th>Has Archive</th>
				<th>Action</th>
			</tr>
		<?php
		foreach ( $output as $value ) {
			echo "<tr><td>{$value['post_type']}</td><td>{$value['singular_name']}</td><td>{$value['plural_name']}</td><td>{$value['public']}</td><td>{$value['has_archive']}</td><td><a href='#'>Edit</a> | <a href='#'>Delete</a></td></tr>";
		}
		?>
		</table>
		</div>
		<div class="tab-pane" id="tab-2">
			<form method="post" action="options.php">
				<?php
				settings_fields( 'wpoop_plugin_cpt_settings' );
				do_settings_sections( 'wpoop_cpt' );
				submit_button();
				?>
			</form>
		</div>
		<div class="tab-pane" id="tab-3">
			<h3>Export Your Custom Post Type</h3>
		</div>
	</div>

</div>
