<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<?php wp_head(); ?>

	<?php
		if( is_front_page() ){
			$title = get_bloginfo();
		} else if( is_archive() ){
			$title = get_the_archive_title();
		} else {
			$title = get_the_title();
		}
	?>
	<title><?php echo $title; ?></title>

</head>

<?php 

$member = get_member_data(get_current_user_id());

?>

<body class="ml">
	<header class="header">
		<div class="container colGr header__container">
			<div class="colGr__col_8">
				<?php wp_nav_menu(
					array(
						'menu_location' => 'header_menu',
						'container' => false,
						'menu_class' => 'header__menu'
					)
				)?>
			</div>
			<div class="colGr__col_4">
				<?php if( is_user_logged_in() ) { ?>
					<div class="headerUserarea">
						<p class="headerUserarea__name"><?php echo get_userdata(get_current_user_id())->display_name; ?></p>
						<button class="headerUserarea__userpic">
							<?php echo get_wp_user_avatar($member['id'], 200); ?>
						</button>
						<div class="headerUserarea__dropdown">
							<div class="mlCard mlCard_noprefix">
								<div class="mlCard__content">
									<div class="mlCard__contentBody">
										<div class="headerUserarea__dropdownSection">
											<a href="<?php echo home_url('/account/profile'); ?>" class="headerUserarea__dropdownItem">Profile</a>
											<?php if( current_user_can('administrator') ) { ?>
												<a href="<?php echo get_admin_url(); ?>" class="headerUserarea__dropdownItem">WP dashboard</a>
											<?php } ?>
										</div>
									</div>
									<div class="mlCard__contentFooter">
										<div class="headerUserarea__dropdownSection">
											<a href="<?php echo wp_logout_url(); ?>" class="headerUserarea__dropdownItem">Log Out</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</header>