<?php


$listingByAuthor = get_posts('post_type=listing&author='.get_current_user_id() );

$canCreateListing = sizeof( $listingByAuthor ) === 0 ? true : false;

if( isset( $_POST ) && !empty( $_POST ) ){
								
	wp_insert_post(
		wp_slash(
			[
				'post_type' => 'listing',
				'author' => get_current_user_id(),
				'post_title' => $_POST['post-name'],
				'post_content' => $_POST['post-content'],
				'post_status' => 'publish',
				'meta_input' => [
					'price_range' => $_POST['listing-price']
				]
			]
		)
	);

}

get_header();

?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
			
			<h1 class="app-page-title">Process Servers Directory</h1>
			
			<!-- Start post Area -->
			<section class="post-area" style="padding-left: 0; padding-right: 0">
				<div class="container" style="padding-left: 0; padding-right: 0">
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">

							<?php if( $canCreateListing ){ ?>

								<h4 style="margin: 30px 0;">Create your own listing!</h4>

								<form class="single-post d-flex flex-row form-area" method="POST" action="#">
									<div class="thumb">
											<img src="<?php echo get_avatar_url( get_current_user_id() ); ?>" alt="">
									</div>
									<div class="details">
										<div class="title d-flex flex-row justify-content-between">
											<div class="titles">
												<input class="common-input form-control" type="text" name="post-name" placeholder="Listing name" id="">				
											</div>
										</div>
										<div>
											<textarea class="common-input form-control" name="post-content" name="listing-content"></textarea>
										</div>
										<p class="address">
											<input class="common-input form-control" type="text" name="listing-price" placeholder="Price or Price range" required>
										</p>
										<input type="submit" value="Submit">
									</div>
								</form>	

                            <?php

								}; 
							
							if( have_posts() ) : while( have_posts() ) : the_post();
							
							?>
                                <div class="single-post d-flex flex-row">
                                    <div class="thumb">
										<?php if( get_the_post_thumbnail() ) { ?>
                                        	<img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , array(200, 200) ); ?>" alt="">
										<?php } else { ?>
                                        	<img src="<?php echo get_avatar_url( get_the_author_meta('ID') ); ?>" alt="">
										<?php } ?>
                                    </div>
                                    <div class="details">
                                        <div class="title d-flex flex-row justify-content-between">
                                            <div class="titles">
                                                <h4><?php the_title(); ?></h4>
                                                <h6><?php the_author(); ?></h6>					
                                            </div>
                                            <ul class="btns">
												<?php if( get_the_author_meta( 'ID' ) == get_current_user_id() ) { ?>
													<li><a href="<?php echo home_url('/add-listing'); ?>" target="_blank">Edit Listing</a></li>
												<?php } ?>
                                                <li><a href="mailto:<?php echo get_the_author_meta('user_email'); ?>" target="_blank">Contact</a></li>
                                            </ul>
                                        </div>
										<div><?php the_content(); ?></div>
                                        <p class="address"><span class="lnr lnr-database"></span><?php the_field('price_range'); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
						</div>
						<div class="col-lg-4 sidebar"></div>
					</div>
				</div>	
			</section>
			<!-- End post Area -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
