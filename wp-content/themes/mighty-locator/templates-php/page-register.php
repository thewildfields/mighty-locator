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
					<?php
					if( is_user_logged_in() ){ echo do_shortcode( '[pms-register]' ); }
					else {
						echo do_shortcode( '[pms-register subscription_plans="none"]' ); 
						?>						
						<div class="auth-option text-center pt-5">
							Already have an account? <a class="text-link" href="<?php echo home_url('/login'); ?>" >Log in</a>
						</div>
					<?php } ?>
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