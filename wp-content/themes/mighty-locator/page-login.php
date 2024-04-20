<?php get_header('login'); ?>	
<div class="row g-0 app-auth-wrapper">
	<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		<div class="d-flex flex-column align-content-end">
			<div class="app-auth-body mx-auto">	
				<div class="app-auth-branding mb-4">
					<img class="logo-icon me-2" src="<?php echo site_icon_url(); ?>" width="150" alt="logo">
				</div>
				<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
				<?php echo do_shortcode( '[pms-login subscription_plans="none"]' ); ?>  
			</div>
		</div>
	</div>
	<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		<div class="auth-background-holder"></div>
		<div class="auth-background-mask"></div>
	</div>
</div>		
<?php get_footer(); ?>