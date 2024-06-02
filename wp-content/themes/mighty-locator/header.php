<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<?php wp_head(); ?>

</head>

<body class="ml">
	<header class="header">
		<div class="container colGr">
			<div class="colGr__col_8">
				<?php wp_nav_menu(
					array(
						'menu_location' => 'header_menu',
						'container' => false,
						'menu_class' => 'header__menu'
					)
				)?>
			</div>
			<div class="colGr__col_4"></div>
		</div>
	</header>