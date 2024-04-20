<?php get_header('login'); ?>

<div class="row g-0 app-auth-wrapper">
	<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		<div class="d-flex flex-column align-content-end">
			<div class="app-auth-body mx-auto">	
				<div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
				<h1 class="auth-heading text-center mb-4">Password Reset</h1>
				<div class="auth-form-container text-left">
					<?php echo do_shortcode('[pms-recover-password]'); ?>
					<div class="auth-option text-center pt-5">
						Already have an account? <a class="text-link" href="<?php echo home_url('/login'); ?>" >Log in</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		<div class="auth-background-holder"></div>
		<div class="auth-background-mask"></div>
		<div class="auth-background-overlay p-3 p-lg-5">
			<div class="d-flex flex-column align-content-end h-100"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>