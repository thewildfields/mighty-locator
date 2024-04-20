<?php

get_header();

if( have_posts() ) : while( have_posts() ) : the_post();

?>
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
            <h1 class="app-page-title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php endwhile; endif;

get_footer();

?>