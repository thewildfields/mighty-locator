<?php

if( isset( $_POST['group-create'] ) ){

	$group = wp_insert_post(
		wp_slash(
			array(
				'post_type' => 'user-group',
				'post_title' => $_POST['group-name'],
				'author' => get_current_user_id(),
				'post_status' => 'publish'
			)
		)
	);

	add_row(
		'users',
		array(
			'user' => get_current_user_id(),
			'status' => 'organizer'
		),
		$group
	);

	update_field(
		'user_group',
		$group,
		'user_' . get_current_user_id()
	);


}

get_header();

$membershipRoles = [
    'ml_starter',
    'ml_pro',
    'ml_enterprise'
];

$userCurrentRole = wp_get_current_user()->roles[0];

$userCurrentRoleDisplayName = $wp_roles->roles[$userCurrentRole]['name'];

?>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">			    
			    <h1 class="app-page-title">Settings</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Membership</h3>
		                <div class="section-intro">Discover all available features and membership levels <a href="<?php echo home_url('/membership'); ?>" target="_blank">here</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
								<?php

								$userRole = wp_get_current_user()->roles[0];
								$userRoleDisplay = '';

								foreach ($wp_roles->roles as $key => $role_data) {
									if( $key == $userRole ){
										$userRoleDisplay = $role_data['name'];
									}
								}

								?>
							    <div class="mb-2"><strong>Current Plan:</strong> <?php echo $userRoleDisplay; ?></div>
							    <div class="mb-2"><strong>Status:</strong> <span class="badge bg-success">Active</span></div>
							    <div class="mb-2"><strong>Expires:</strong> 03-31</div>
							    <div class="mb-4"><strong>Invoices:</strong> <a href="<?php echo home_url( '/billing' ); ?>">view</a></div>
							    <div class="row justify-content-between">
									<?php if( current_user_can( 'ml_pro' ) || current_user_can( 'ml_starter' ) ) { ?>
										<div class="col-auto">
											<a class="btn app-btn-primary" href="#">Upgrade Membership</a>
										</div>
									<?php } if( current_user_can( 'ml_pro' ) || current_user_can( 'ml_enterprise' ) ) { ?>
										<div class="col-auto">
											<a class="btn app-btn-secondary" href="#">Downgrade Plan</a>
										</div>
									<?php } ?>
							    </div>
								    
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">User Groups</h3>
		                <div class="section-intro">Create or join a group to connect with your partners.</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
								<?php if( get_field( 'user_group' , 'user_' . get_current_user_id() ) ){ ?>
									<div class="mb-2"><strong>Group:</strong> <?php echo get_the_title( get_field('user_group' , 'user_' . get_current_user_id() ) ); ?></div>
								<?php } else {
									echo 'not in a group'; ?>

									<form method="POST">
										<input type="text" name="group-name" placeholder="Name of a group">
										<input type="submit" name="group-create" value="Create group">
									</form>

									
								<?php }

								?>
								    
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Data &amp; Privacy</h3>
		                <div class="section-intro">Settings section intro goes here. Morbi vehicula, est eget fermentum ornare. </div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">						    
						    <div class="app-card-body">
							    <form class="settings-form">
								    <div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" id="settings-checkbox-1" checked>
										<label class="form-check-label" for="settings-checkbox-1">
										    Keep user app activity history
										</label>
									</div><!--//form-check-->
									<div class="form-check mb-3">
									    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-2" checked>
										<label class="form-check-label" for="settings-checkbox-2">
										    Keep user app preferences
										</label>
									</div>
									<div class="form-check mb-3">
									    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-3">
										<label class="form-check-label" for="settings-checkbox-3">
										    Keep user app search history
										</label>
									</div>
									<div class="form-check mb-3">
									    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-4">
										<label class="form-check-label" for="settings-checkbox-4">
										    Lorem ipsum dolor sit amet
										</label>
									</div>
									<div class="form-check mb-3">
									    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-5">
										<label class="form-check-label" for="settings-checkbox-5">
										    Aenean quis pharetra metus
										</label>
									</div>
									<div class="mt-3">
									    <button type="submit" class="btn app-btn-primary" >Save Changes</button>
									</div>
							    </form>
						    </div><!--//app-card-body-->						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Notifications</h3>
		                <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non hendrerit eget.</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">						    
						    <div class="app-card-body">
							    <form class="settings-form">
								    <div class="form-check form-switch mb-3">
										<input class="form-check-input" type="checkbox" id="settings-switch-1" checked>
										<label class="form-check-label" for="settings-switch-1">Project notifications</label>
									</div>
									<div class="form-check form-switch mb-3">
										<input class="form-check-input" type="checkbox" id="settings-switch-2">
										<label class="form-check-label" for="settings-switch-2">Web browser push notifications</label>
									</div>
									<div class="form-check form-switch mb-3">
										<input class="form-check-input" type="checkbox" id="settings-switch-3" checked>
										<label class="form-check-label" for="settings-switch-3">Mobile push notifications</label>
									</div>
									<div class="form-check form-switch mb-3">
										<input class="form-check-input" type="checkbox" id="settings-switch-4">
										<label class="form-check-label" for="settings-switch-4">Lorem ipsum notifications</label>
									</div>
									<div class="form-check form-switch mb-3">
										<input class="form-check-input" type="checkbox" id="settings-switch-5">
										<label class="form-check-label" for="settings-switch-5">Lorem ipsum notifications</label>
									</div>
									<div class="mt-3">
									    <button type="submit" class="btn app-btn-primary" >Save Changes</button>
									</div>
							    </form>
						    </div><!--//app-card-body-->						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->
			    <hr class="my-4">
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php get_footer(); ?>