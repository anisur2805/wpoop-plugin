<?php

namespace WPOOP\Base;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\TestimonialCallback;

class TestimonialController extends BaseController {
	public $callback;
	public $subpages = array();
	public $settings;

	public function register() {
		if ( ! $this->activate_key( 'testimonial_manager' ) ) {
			return;
		}

		$this->settings = new SettingsAPI();

		$this->callback = new TestimonialCallback();

		add_action( 'init', array( $this, 'register_testimonial_cpt' ) );

		add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );

		add_action( 'save_post', array( $this, 'save_meta_box' ) );

		add_action( 'manage_testimonial_posts_columns', array( $this, 'set_testimonial_columns' ) );

		add_action( 'manage_testimonial_posts_custom_column', array( $this, 'set_custom_columns_data' ), 10, 2 );

		add_filter( 'manage_edit-testimonial_sortable_columns', array( $this, 'set_custom_columns_sortable' ) );

		$this->shortcode_page();

		add_shortcode( 'wpoop-testimonial-form', array( $this, 'render_testimonial_shortcode' ) );

		add_shortcode( 'wpoop-testimonial-slideshow', array( $this, 'render_testimonial_slideshow_shortcode' ) );

		add_action( 'wp_ajax_submit_testimonial', array( $this, 'submit_testimonial' ) );
		add_action( 'wp_ajax_nopriv_submit_testimonial', array( $this, 'submit_testimonial' ) );
	}

	public function submit_testimonial() {

		if ( ! DOING_AJAX || ! check_ajax_referer( 'testimonial-form-nonce', 'nonce' ) ) {
			return $this->return_json( 'error' );
		}

		$name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
		$email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
		$message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

		$data = array(
			'name'     => $name,
			'email'    => $email,
			'approved' => 0,
			'featured' => 0,
		);

		$args = array(
			'post_title'   => 'Testimonial from ' . $name,
			'post_content' => $message,
			'post_author'  => 1,
			'post_status'  => 'draft',
			'post_type'    => 'testimonial',
			'meta_input'   => array(
				'_wpoop_testimonial_key' => $data,
			),
		);

		$post_id = wp_insert_post( $args );

		if ( $post_id ) {
			return $this->return_json( 'success' );
		}

		return $this->return_json( 'error' );
	}

	public function return_json( $status ) {
		$return = array(
			'status' => $status,
		);

		wp_send_json( $return );

		wp_die();
	}

	public function render_testimonial_shortcode() {
		ob_start();
		echo "<link rel=\"stylesheet\" href=\"{$this->plugin_url}assets/css/form.css\" type=\"text/css\" />";
		require_once "$this->plugin_path/templates/form.php";
		echo "<script src=\"{$this->plugin_url}assets/js/form.js\"></script>";
		return ob_get_clean();
	}

	public function render_testimonial_slideshow_shortcode() {
		ob_start();
		echo "<link rel=\"stylesheet\" href=\"{$this->plugin_url}assets/css/slider.css\" type=\"text/css\" />";
		require_once "$this->plugin_path/templates/slider.php";
		echo "<script src=\"{$this->plugin_url}assets/js/slider.js\"></script>";
		return ob_get_clean();
	}

	public function register_testimonial_cpt() {
		$labels = array(
			'name'          => 'Testimonials',
			'singular_name' => 'Testimonial',
		);
		$args   = array(
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => false,
			'publicly_queryable'  => false,
			'menu_icon'           => 'dashicons-testimonial',
			'exclude_from_search' => true,
			'supports'            => array( 'title', 'editor' ),
			'show_in_rest'        => true,
		);
		register_post_type( 'testimonial', $args );
	}

	public function register_meta_boxes() {
		add_meta_box( 'testimonial_feature_box', __( 'Testimonial Feature', 'wpoop-plugin' ), array( $this, 'render_author_mb' ), 'testimonial', 'side', 'default' );
	}

	public function render_author_mb( $post ) {
		wp_nonce_field( 'wpoop_testimonial_feature', 'wpoop_testimonial_nonce' );

		$data     = get_post_meta( $post->ID, '_wpoop_testimonial_key', true );
		$name     = isset( $data['name'] ) ? $data['name'] : '';
		$email    = isset( $data['email'] ) ? $data['email'] : '';
		$approved = isset( $data['approved'] ) ? $data['approved'] : '';
		$featured = isset( $data['featured'] ) ? $data['featured'] : '';

		?>
		<p>
			<label for="wpoop_testimonial_author"><?php echo __( 'Author Name', 'wpoop-plugin' ); ?></label>
			<input type="text" class="widefat" name="wpoop_testimonial_author" value="<?php echo esc_attr( $name ); ?>" id="wpoop_testimonial_author" />
		</p>
		<p>
			<label for="wpoop_testimonial_email"><?php echo __( 'Author Email', 'wpoop-plugin' ); ?></label>
			<input type="email" class="widefat" name="wpoop_testimonial_email" value="<?php echo esc_attr( $email ); ?>" id="wpoop_testimonial_email" />
		</p>
		<div class="meta-container meta-featured-box">
			<label for="wpoop_testimonial_approved" class="meta-label w-50 text-left"><?php echo __( 'Approved', 'wpoop-plugin' ); ?></label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle">
					<input type="checkbox" name="wpoop_testimonial_approved" id="wpoop_testimonial_approved" class="" value="1" <?php echo $approved ? 'checked' : ''; ?>>
					<label for="wpoop_testimonial_approved"><div></div></label>
				</div>
			</div>
		</div>
		<div class="meta-container meta-featured-box">
			<label for="wpoop_testimonial_featured" class="meta-label w-50 text-left"><?php echo __( 'Featured', 'wpoop-plugin' ); ?></label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle">
					<input type="checkbox" name="wpoop_testimonial_featured" id="wpoop_testimonial_featured" class="" value="1" <?php echo $featured ? 'checked' : ''; ?>>
					<label for="wpoop_testimonial_featured"><div></div></label>
				</div>
			</div>
		</div>
		<?php
	}

	public function save_meta_box( $post_id ) {

		if ( ! isset( $_POST['wpoop_testimonial_nonce'] ) ) {
			return $post_id;
		}

		if ( ! wp_verify_nonce( $_POST['wpoop_testimonial_nonce'], 'wpoop_testimonial_feature' ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$data = array(
			'name'     => sanitize_text_field( $_POST['wpoop_testimonial_author'] ),
			'email'    => sanitize_email( $_POST['wpoop_testimonial_email'] ),
			'approved' => isset( $_POST['wpoop_testimonial_approved'] ) ? $_POST['wpoop_testimonial_approved'] : false,
			'featured' => isset( $_POST['wpoop_testimonial_featured'] ) ? $_POST['wpoop_testimonial_featured'] : false,
		);
		update_post_meta( $post_id, '_wpoop_testimonial_key', $data );
	}

	public function set_testimonial_columns( $columns ) {
		$title = $columns['title'];
		$date  = $columns['date'];

		unset( $columns['title'], $columns['date'] );

		$columns['name']     = 'Author Name';
		$columns['title']    = $title;
		$columns['approved'] = 'Approved';
		$columns['featured'] = 'Featured';
		$columns['date']     = $date;

		return $columns;
	}

	public function set_custom_columns_data( $column, $post_id ) {
		$data     = get_post_meta( $post_id, '_wpoop_testimonial_key', true );
		$name     = isset( $data['name'] ) ? $data['name'] : '';
		$email    = isset( $data['email'] ) ? $data['email'] : '';
		$approved = isset( $data['approved'] ) && 1 == $data['approved'] ? '<strong>Yes</strong>' : 'No';
		$featured = isset( $data['featured'] ) && 1 == $data['featured'] ? '<strong>Yes</strong>' : 'No';

		switch ( $column ) {
			case 'name':
				echo '<strong>' . $name . '</strong><br/><a href="mailto:' . $email . '">' . $email . '</a>';
				break;

			case 'approved':
				echo $approved;
				break;

			case 'featured':
				echo $featured;
				break;

			default:
				# code...
				break;
		}
	}

	public function set_custom_columns_sortable( $columns ) {
		$columns['name']     = 'name';
		$columns['approved'] = 'approved';
		$columns['featured'] = 'featured';

		return $columns;
	}

	public function shortcode_page() {
		$subpages = array(
			array(
				'parent_slug' => 'edit.php?post_type=testimonial',
				'page_title'  => 'Testimonial Shortcode',
				'menu_title'  => 'Testimonial Shortcode',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop_testimonial_shortcode',
				'callback'    => array( $this->callback, 'shortcode_page_callback' ),
			),
		);

		$this->settings->add_sub_pages( $subpages )->register();
	}
}
