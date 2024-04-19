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

			<h1 class="app-page-title"><?php the_title(); ?> (<?php the_time('F j, Y h:i a'); ?>)</h1>
			
			<div class="row g-4 mb-4">
				
				<div class="col-12">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Try Skip Tracing</h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<?php
							$content = json_decode( get_the_content() );
							echo '<pre>';
							print_r( $content->contacts );
							echo '</pre>';
							?>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>
	</div>

<?php

endwhile; endif;

get_footer(); ?>