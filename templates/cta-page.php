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
			
			<?php
			$options = get_option( 'wpoop_plugin_cpt' ) ?: array();

			foreach ( $options as $option ) {
				echo "<h4>{$option['singular_name']}</h4>";

				echo '<pre class="prettyprint">'; ?>
$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( '<?php echo $option['singular_name']; ?>', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( '<?php echo $option['plural_name']; ?>', 'text_domain' ),
		'plural_name'             => __( '<?php echo $option['plural_name']; ?>', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => <?php echo isset($option['public']) ? "true" : "false"; ?>,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => <?php echo isset($option['has_archive']) ? "true" : "false"; ?>,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( '<?php echo $option['post_type']; ?>', $args );
				<?php echo '</pre>';
			}

			?>
		</div>
	</div>

</div>
