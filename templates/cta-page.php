<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?> </h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo ( ! isset( $_POST['edit_post'] ) ? 'active' : '' ); ?>"><a href="#tab-1">Manage CPT</a></li>
		<li class="<?php echo ( isset( $_POST['edit_post'] ) ? 'active' : '' ); ?>">
			<a href="#tab-2">
			<?php echo ( isset( $_POST['edit_post'] ) ? 'Edit' : 'Add' ); ?> Post Type
			</a>
		</li>
		<li><a href="#tab-3">Export CPT</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane <?php echo ( ! isset( $_POST['edit_post'] ) ? 'active' : '' ); ?>" id="tab-1">
		<h3>Manage Your Custom Post Type</h3>
		<?php
		$output = get_option( 'wpoop_plugin_cpt' );

		?>
		<table class="cpt-manager-table">
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
			$public      = ( isset( $value['public'] ) ? 'TRUE' : 'FALSE' );
			$has_archive = ( isset( $value['has_archive'] ) ? 'TRUE' : 'FALSE' );

			echo "<tr><td>{$value['post_type']}</td><td>{$value['singular_name']}</td><td>{$value['plural_name']}</td><td>{$public}</td><td>{$has_archive}</td><td class='form-actions'>";

			echo "<form method='post' action=''>";
			settings_fields( 'wpoop_plugin_cpt_settings' );
			echo '<input type="hidden" name="edit_post" value="' . $value['post_type'] . '">';
			submit_button( 'Edit', 'primary small', 'submit', false );
			echo '</form>';

			echo "<form method='post' action='options.php'>";
			settings_fields( 'wpoop_plugin_cpt_settings' );
			echo '<input type="hidden" name="remove" value="' . $value['post_type'] . '">';
			submit_button( 'Delete', 'small delete', 'submit', false, array( 'onclick' => 'return confirm("Are you sure you want to delete?")' ) );
			echo '</form></td></tr>';
		}
		?>
		</table>
		</div>
		<div class="tab-pane <?php echo ( isset( $_POST['edit_post'] ) ? 'active' : '' ); ?>" id="tab-2">
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
