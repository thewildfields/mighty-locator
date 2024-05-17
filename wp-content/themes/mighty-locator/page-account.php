<?php get_header(); ?>
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<h1 class="app-page-title">Account</h1>

			<div class="row g-4 mb-4">				
				<div class="col-12">
					<div class="app-card app-card-chart shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Account Settings</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="row">
								<?php
									echo do_shortcode('[pms-account]');
									echo do_shortcode('[basic-user-avatars]');
									
									?>

								<div class="accountWallet">
									<?php echo do_shortcode('[woocommerce_my_account]'); ?>
								</div>
							</row>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>