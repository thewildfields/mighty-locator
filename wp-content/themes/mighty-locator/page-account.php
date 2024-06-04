<?php

get_header(); ?>
<div class="container colGr">
	<div class="colGr__col colGr__col_8">
		<div class="mlCard">
			<div class="mlCard__content">
				<?php 
				echo do_shortcode('[pms-account]');
				echo do_shortcode('[avatar_upload]');
				?>
			</div>
		</div>
	</div>
	<div class="colGr__col colGr__col_4">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>