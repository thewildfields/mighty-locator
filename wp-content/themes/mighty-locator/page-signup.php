<?php

/**
 * Template Name: Sign Up page
 */


get_header('login'); ?>
<div class="row g-0 app-auth-wrapper">
	<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		<div class="d-flex flex-column align-content-end">
			<div class="app-auth-body mx-auto">	
				<div class="app-auth-branding mb-4">
					<img class="logo-icon me-2" src="<?php echo site_icon_url(); ?>" width="150" alt="logo">
				</div>
				<h2 class="auth-heading text-center mb-4">Sign up to Portal</h2>
				<div class="auth-form-container text-start mx-auto">

					<?php echo do_shortcode( '[pms-register subscription_plans="none"]' ); ?>   	
					<form class="auth-form auth-signup-form" action="<?php esc_url( wp_registration_url() ) ?>" method="post">
						<div class="email mb-3">
							<label class="sr-only" for="signup-username">Username</label>
							<input id="signup-username" name="user_login" type="text" class="form-control signup-username" placeholder="Username" required="required">
						</div>
						<div class="email mb-3">
							<label class="sr-only" for="signup-email">Your Email</label>
							<input id="signup-email" name="user_email" type="email" class="form-control signup-email" placeholder="Email" required="required">
						</div>
						<div class="password mb-3">
							<label class="sr-only" for="signup-password">Password</label>
							<input id="signup-password" name="signup-password" type="password" class="form-control signup-password" placeholder="Create a password" required="required">
						</div>					
						<div class="text-center">
							<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto button_info">Sign Up</button>
						</div>
					</form>
					<div class="auth-option text-center pt-5">
						Already have an account? <a class="text-link" href="<?php echo home_url('/login'); ?>" >Log in</a>
					</div>
				</div>
			</div>				
			<footer class="app-auth-footer"></footer>			
		</div>
	</div>		
	<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		<div class="auth-background-holder">			    
		</div>
		<div class="auth-background-mask"></div>
		<div class="auth-background-overlay p-3 p-lg-5">
		</div>
	</div>
</div>
<?php get_footer(); ?>