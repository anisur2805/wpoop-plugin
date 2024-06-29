<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?> </h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo ( ! isset( $_POST['edit_taxonomy'] ) ? 'active' : '' ); ?>"><a href="#tab-1">Manage Taxonomy</a></li>
		<li class="<?php echo ( isset( $_POST['edit_taxonomy'] ) ? 'active' : '' ); ?>">
			<a href="#tab-2">
			<?php echo ( isset( $_POST['edit_taxonomy'] ) ? 'Edit' : 'Add' ); ?> Taxonomy
			</a>
		</li>
		<li><a href="#tab-3">Export Taxonomies</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane <?php echo ( ! isset( $_POST['edit_taxonomy'] ) ? 'active' : '' ); ?>" id="tab-1">
		<h3>Manage Your Custom Post Type</h3>
		<?php
		$output = get_option( 'wpoop_plugin_tax' );

		?>
		<table class="cpt-manager-table">
			<tr>
				<th>ID</th>
				<th>Singular Name</th>
				<th>Hierarchical</th>
				<th>Action</th>
			</tr>
		<?php
		foreach ( $output as $value ) {
			$hierarchical = ( isset( $value['hierarchical'] ) ? 'TRUE' : 'FALSE' );

			echo "<tr><td>{$value['taxonomy']}</td><td>{$value['singular_name']}</td><td>{$hierarchical}</td><td class='form-actions'>";

			echo "<form method='post' action=''>";
			settings_fields( 'wpoop_plugin_tax_settings' );
			echo '<input type="hidden" name="edit_taxonomy" value="' . $value['taxonomy'] . '">';
			submit_button( 'Edit', 'primary small', 'submit', false );
			echo '</form>';

			echo "<form method='post' action='options.php'>";
			settings_fields( 'wpoop_plugin_tax_settings' );
			echo '<input type="hidden" name="remove" value="' . $value['taxonomy'] . '">';
			submit_button( 'Delete', 'small delete', 'submit', false, array( 'onclick' => 'return confirm("Are you sure you want to delete?")' ) );
			echo '</form></td></tr>';
		}
		?>
		</table>
		</div>
		<div class="tab-pane <?php echo ( isset( $_POST['edit_taxonomy'] ) ? 'active' : '' ); ?>" id="tab-2">
			<form method="post" action="options.php">
				<?php
				settings_fields( 'wpoop_plugin_tax_settings' );
				do_settings_sections( 'wpoop_tax' );
				submit_button();
				?>
			</form>
		</div>
		<div class="tab-pane" id="tab-3">
			<h3>Export Your Taxonomy</h3>
			
			<?php
			$options = get_option( 'wpoop_plugin_tax' ) ?: array();

			foreach ( $options as $option ) {
				echo "<h4>{$option['singular_name']}</h4>";

				echo '<pre class="prettyprint">';
				?>
$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'wpoop-plugin' ),
		'singular_name'         => _x( '<?php echo $option['singular_name']; ?>', 'Post Type Singular Name', 'wpoop-plugin' ),
		'menu_name'             => __( '<?php echo $option['singular_name']; ?>', 'wpoop-plugin' ),
		'plural_name'             => __( '<?php echo $option['singular_name']; ?>', 'wpoop-plugin' ),
		'name_admin_bar'        => __( 'Post Type', 'wpoop-plugin' ),
		'archives'              => __( 'Item Archives', 'wpoop-plugin' ),
		'attributes'            => __( 'Item Attributes', 'wpoop-plugin' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wpoop-plugin' ),
		'all_items'             => __( 'All Items', 'wpoop-plugin' ),
		'add_new_item'          => __( 'Add New Item', 'wpoop-plugin' ),
		'add_new'               => __( 'Add New', 'wpoop-plugin' ),
		'new_item'              => __( 'New Item', 'wpoop-plugin' ),
		'edit_item'             => __( 'Edit Item', 'wpoop-plugin' ),
		'update_item'           => __( 'Update Item', 'wpoop-plugin' ),
		'view_item'             => __( 'View Item', 'wpoop-plugin' ),
		'view_items'            => __( 'View Items', 'wpoop-plugin' ),
		'search_items'          => __( 'Search Item', 'wpoop-plugin' ),
		'not_found'             => __( 'Not found', 'wpoop-plugin' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpoop-plugin' ),
		'featured_image'        => __( 'Featured Image', 'wpoop-plugin' ),
		'set_featured_image'    => __( 'Set featured image', 'wpoop-plugin' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpoop-plugin' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpoop-plugin' ),
		'insert_into_item'      => __( 'Insert into item', 'wpoop-plugin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpoop-plugin' ),
		'items_list'            => __( 'Items list', 'wpoop-plugin' ),
		'items_list_navigation' => __( 'Items list navigation', 'wpoop-plugin' ),
		'filter_items_list'     => __( 'Filter items list', 'wpoop-plugin' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'wpoop-plugin' ),
		'description'           => __( 'Post Type Description', 'wpoop-plugin' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => <?php echo isset( $option['public'] ) ? 'true' : 'false'; ?>,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => <?php echo isset( $option['has_archive'] ) ? 'true' : 'false'; ?>,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_taxonomy( '<?php echo $option['taxonomy']; ?>', $args );
				<?php
				echo '</pre>';
			}

			?>
		</div>
	</div>

</div>
