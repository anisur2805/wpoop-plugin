<form id="wpoop-auth-form" action="#" method="post" data-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
	<div class="auth-btn-container">
		<input type="button" name="auth-login-btn" value="Login" />
	</div>

	<div class="wpoop-auth-login">
		<a id="close">&times;</a>
		<div class="auth-group">
			<label for="username">Username</label>
			<input type="text" name="username" value="" id="username" />
		</div>

		<div class="auth-group">
			<label for="password">Password</label>
			<input type="text" name="password" value="" id="password" />
		</div>

		<div class="auth-group">
			<input type="submit" name="login" value="Login" />
			<p class="status" data-message="status"></p>
		</div>

		<div class="auth-group">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">Forget Password</a> | <a href="<?php echo esc_url( wp_registration_url() ); ?>">Register</a>
			<?php wp_nonce_field( 'ajax-auth-nonce', 'security' ); ?>
			<input type="hidden" name="action" value="ajax-auth-login" />
		</div>

	</div>
</form>
