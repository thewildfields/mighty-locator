<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>
		<?php
		if( is_front_page() ){
			bloginfo();
		} else {
			wp_title('');
		}
		?>
	</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <!-- FontAwesome JS-->
    <script defer src="<?php echo get_template_directory_uri(); ?>/assets/plugins/fontawesome/js/all.min.js"></script>


    <?php wp_head(); ?>

</head>

<body class="ml app">

    <header class="app-header fixed-top header">	 

        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div>
		            
		            <div class="app-utilities col-auto">
						<div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
								<div class="header__avatar">
									<?php if( get_avatar_url( get_current_user_id() ) ){ ?>
										<img
											src="<?php echo get_avatar_url( get_current_user_id() ); ?>"
											style="border-radius: 50%"
										>
									<?php } else {
										$userData = get_userdata( get_current_user_id() );
										$firstName = $userData->first_name;
										$lastName = $userData->last_name;
										$initials = $firstName && $lastName ? $firstName[0] . $lastName[0] : 'ML';
										echo $initials;
									} ?>
								</div>
							</a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="<?php echo home_url( '/account' ); ?>">Profile</a></li>
								<li><a class="dropdown-item" href="<?php echo home_url( '/pricing' ); ?>">Pricing</a></li>
								<?php if( current_user_can( 'administrator' ) ) { ?>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo get_admin_url(); ?>">WordPress Dashboard</a></li>
								<?php } ?>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div>
		
		<div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="<?php echo home_url(); ?>"><img class="logo-icon" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]; ?>" alt="<?php bloginfo(); ?>"></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url(); ?>">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
										<path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
									</svg>
								</span>
								<span class="nav-link-text">Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url( '/person-search' ); ?>">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
										<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
									</svg>
								</span>
								<span class="nav-link-text">Person search</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url( '/batch-search' ); ?>">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
										<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
									</svg>
								</span>
								<span class="nav-link-text">Batch search</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url( '/skips-archive' ); ?>">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
										<path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
									</svg>
								</span>
								<span class="nav-link-text">Searches Archive</span>
							</a>
						</li>
					    				    
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->

			<div class="app-sidepanel-footer">
				<nav class="app-nav app-nav-footer">
					<ul class="app-menu footer-menu list-unstyled">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url( '/help' ); ?>">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
										<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
									</svg>
								</span>
								<span class="nav-link-text">Help</span>
							</a>
						</li>
						<?php if( is_user_logged_in() ) { ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo wp_logout_url(); ?>">
									<span class="nav-icon">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
											<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
										</svg>
									</span>
									<span class="nav-link-text">Log Out</span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>
