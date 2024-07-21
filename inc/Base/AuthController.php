<?php

namespace WPOOP\Base;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\TestimonialCallback;

class AuthController extends BaseController {

	public $templates;

	public function register() {
		if ( ! $this->activate_key( 'login_manager' ) ) {
			return;
		}

		add_action( 'wp_head', array( $this, 'load_auth_file' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

		add_action( 'wp_ajax_ajax-auth-login', array( $this, 'ajax_auth_login' ) );
		add_action( 'wp_ajax_nopriv_ajax-auth-login', array( $this, 'ajax_auth_login' ) );
	}

	public function ajax_auth_login() {
		if ( ! wp_verify_nonce( $_POST['security'], 'ajax-auth-nonce' ) ) {
			wp_send_json(
				array(
					'status'  => false,
					'message' => __( 'Nonce verification failed', 'wpoop-plugin' ),
				)
			);
		}

		$info = array();

		$info['user_login']    = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
		$info['user_password'] = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
		$info['remember']      = true;

		$wp_singon = wp_signon( $info, false );

		if ( is_wp_error( $wp_singon ) ) {
			echo json_encode(
				array(
					'status'  => false,
					'message' => __( 'Username or Password is incorrect', 'wpoop-plugin' ),
				)
			);
			wp_die();
		}

		echo json_encode(
			array(
				'status'  => true,
				'message' => __( 'Login Success, redirecting...', 'wpoop-plugin' ),
			)
		);
		wp_die();
	}


	public function load_scripts() {
		if ( is_user_logged_in() ) {
			return;
		}

		wp_enqueue_style( 'auth-css', $this->plugin_url . '/assets/css/auth.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'auth-js', $this->plugin_url . '/assets/js/auth.js', array(), '1.0', 'all' );
	}

	public function load_auth_file() {
		if ( is_user_logged_in() ) {
			return;
		}

		$file = $this->plugin_path . '/templates/auth.php';

		if ( file_exists( $file ) ) {
			load_template( $file, true );
		}
	}
}
