<?php

get_header();

$membershipRoles = [
    'ml_starter',
    'ml_pro',
    'ml_enterprise'
];

$userCurrentRole = wp_get_current_user()->roles[0];

$userCurrentRoleDisplayName = $wp_roles->roles[$userCurrentRole]['name'];

if( have_posts() ) : while( have_posts( ) ) : the_post();

?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<?php
			the_content();
			echo '<pre>';
			print_r( get_post_meta( get_the_ID() ) );
			echo '</pre>';
			?>
			
						
			<div class="row g-4 mb-4">
				
				<div class="col-12">
					<?php echo get_template_part( 'templates/person-search' , 'result' ); ?>
				</div>
				
			</div>
		
		</div>
	</div>

<?php

endwhile; endif;

get_footer(); ?>