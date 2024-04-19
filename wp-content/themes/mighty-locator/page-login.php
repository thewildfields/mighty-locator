<?php get_header('login'); ?>	
<div class="row g-0 app-auth-wrapper">
	<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		<div class="d-flex flex-column align-content-end">
			<div class="app-auth-body mx-auto">	
				<div class="app-auth-branding mb-4">
					<img class="logo-icon me-2" src="<?php echo site_icon_url(); ?>" width="150" alt="logo">
				</div>
				<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
				<div class="auth-form-container text-start">
					<form class="auth-form login-form" name="loginform"  action="<?php echo wp_login_url( home_url() ); ?>" method="POST">         
						<div class="email mb-3">
							<label class="sr-only" for="signin-email">Username or Email</label>
							<input id="signin-email" name="log" type="text" class="form-control signin-email" placeholder="Email address" required="required">
						</div>
						<div class="password mb-3">
							<label class="sr-only" for="signin-password">Password</label>
							<input id="signin-password" name="pwd" type="password" class="form-control signin-password" placeholder="Password" required="required">
							<div class="extra mt-3 row justify-content-between">
								<div class="col-12">
									<div class="forgot-password text-end">
										<a href="<?php echo home_url( '/reset-password' ); ?>">Forgot password?</a>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto button_info">Log In</button>
						</div>
					</form>
					
					<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="<?php echo home_url('/signup'); ?>" >here</a>.</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		<div class="auth-background-holder"></div>
		<div class="auth-background-mask"></div>
	</div>
</div>		
<?php get_footer(); ?>