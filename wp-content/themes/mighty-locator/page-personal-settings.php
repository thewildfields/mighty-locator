<?php

get_header();

$userID = get_current_user_id();

?>

<input type="text" id="current-user-id" name="current-user-id" value="<?php echo $userID; ?>" style="display: none">

	<div class="container">
		<div class="colGr card__grid">
			<div class="colGr__col_6">
				<div class="card">
					<div class="card__header">
						<div class="card__iconContainer">
							<img src="" alt="" class="card__icon">
						</div>
						<h2 class="card__title">Profile</h2>
					</div>
					<div class="card__body">
						<form action="" class="inputForm">
							<div class="inputForm__body">
								<div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Photo</label>
									<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input" value="New York" disabled>
									<button type="button" class="inputGroup__trigger">Change</button>
								</div>
								<!-- <div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Name</label>
									<div class="inputGroup__inputs">
										<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input" value="New" disabled>
										<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input" value="York" disabled>
									</div>
									<button type="button" class="inputGroup__trigger">Change</button>
								</div> -->
								<div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Email</label>
									<input type="email" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input" data-user-info-type="data" data-user-info="user_email" value="<?php echo get_userdata( $userID)->user_email; ?>" disabled>
									<button type="button" class="inputGroup__trigger" data-action="enable">Change</button>
								</div>
								<div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Location</label>
									<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input" value="New York" disabled>
									<button type="button" class="inputGroup__trigger">Change</button>
								</div>
							</div>
							<div class="inputForm__footer">
								<button class="card__button">Update data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="colGr__col_6">
				<div class="card">
					<div class="card__header card__header_noIcon">
						<h2 class="card__title">Preferences</h2>
					</div>
					<div class="card__body">
						<form action="" class="inputForm">
							<div class="inputForm__body">
								<div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Time Zone</label>
									<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input">
									<button type="button" class="inputGroup__trigger">Change</button>
								</div>
								<div class="inputGroup">
									<label for="profile-settings-email" class="inputGroup__label">Email Subscription</label>
									<input type="text" id="profile-settings-email" name="profile-settings-email" class="inputGroup__input">
									<button type="button" class="inputGroup__trigger">Change</button>
								</div>
							</div>
							<div class="inputForm__footer">
								<button>Update data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <div class="app-wrapper">

		<?php echo do_shortcode('[pms-account]'); ?>
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">My Account</h1>
                <div class="row gy-4">
	                <div class="col-12 col-lg-6">
		                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						    <div class="app-card-header p-3 border-bottom-0">
						        <div class="row align-items-center gx-3">
							        <div class="col-auto">
								        <div class="app-icon-holder">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
</svg>
									    </div><!--//icon-holder-->
						                
							        </div><!--//col-->
							        <div class="col-auto">
								        <h4 class="app-card-title">Profile</h4>
							        </div><!--//col-->
						        </div><!--//row-->
						    </div><!--//app-card-header-->
						    <div class="app-card-body px-4 w-100">
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label mb-2"><strong>Photo</strong></div>
										    <div class="item-data"><img class="profile-image" src="assets/images/user.png" alt=""></div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Name</strong></div>
									        <div class="item-data">James Doe</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Email</strong></div>
									        <div class="item-data">james.doe@website.com</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Location</strong></div>
									        <div class="item-data">
										        New York
									        </div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
						    </div><!--//app-card-body-->
						    <div class="app-card-footer p-4 mt-auto">
							   <a class="btn app-btn-secondary" href="#">Manage Profile</a>
						    </div><!--//app-card-footer-->
						   
						</div><!--//app-card-->
	                </div><!--//col-->
	                <div class="col-12 col-lg-6">
		                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						    <div class="app-card-header p-3 border-bottom-0">
						        <div class="row align-items-center gx-3">
							        <div class="col-auto">
								        <div class="app-icon-holder">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
</svg>
									    </div><!--//icon-holder-->
						                
							        </div><!--//col-->
							        <div class="col-auto">
								        <h4 class="app-card-title">Preferences</h4>
							        </div><!--//col-->
						        </div><!--//row-->
						    </div><!--//app-card-header-->
						    <div class="app-card-body px-4 w-100">

							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Time Zone</strong></div>
									        <div class="item-data">Central Standard Time (UTC-6)</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Email Subscription</strong></div>
									        <div class="item-data">Off</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#">Change</a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
						    </div><!--//app-card-body-->
						    <div class="app-card-footer p-4 mt-auto">
							   <a class="btn app-btn-secondary" href="#">Manage Preferences</a>
						    </div><!--//app-card-footer-->
						   
						</div><!--//app-card-->
	                </div><!--//col-->
                </div><!--//row-->
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php get_footer(); ?>