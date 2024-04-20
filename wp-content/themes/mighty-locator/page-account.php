<?php get_header(); ?>
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<h1 class="app-page-title">Account</h1>
			<?php echo do_shortcode('[pms-account]'); ?>

			<div class="accountWallet">
				<?php echo do_shortcode('[woocommerce_my_account]'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>