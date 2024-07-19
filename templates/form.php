<form method="post" id="testimonial-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
	<div class="field-container">
		<label for="name">Your Name</label>
		<input type="text" name="name" value="" class="form-input" id="name" placeholder="Your name"  />
		<small class="field-message error" data-error="invalidName">Name is required</small>
	</div>

	<div class="field-container">
		<label for="email">Your Email</label>
		<input type="text" name="email" value="" id="email" class="form-input" placeholder="Your email" />
		<small class="field-message error" data-error="invalidEmail">Email is required</small>
	</div>

	<div class="field-container">
		<label for="message">Your Message</label>
		<textarea name="message" value="" id="message" placeholder="Your message" class="form-input"></textarea>
		<small class="field-message error" data-error="invalidMessage">Message is required</small>
	</div>

	<div class="field-container">
		<button type="submit" class="btn btn-primary">Submit</button>
		<small class="field-message js-form-submission">Form submission is in progress, please wait...</small>
		<small class="field-message success js-form-success">Form submitted successfully</small>
		<small class="field-message error js-form-error">There is something wrong</small>
	</div>
</form>