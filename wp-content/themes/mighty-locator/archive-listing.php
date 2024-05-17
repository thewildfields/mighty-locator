<?php get_header(); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
			
			<h1 class="app-page-title">Process Servers Directory</h1>
			
			<!-- Start post Area -->
			<section class="post-area" style="padding-left: 0; padding-right: 0">
				<div class="container" style="padding-left: 0; padding-right: 0">
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">
                            <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                                <div class="single-post d-flex flex-row">
                                    <div class="thumb">
										<?php if( get_the_post_thumbnail() ) { ?>
                                        	<img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , array(200, 200) ); ?>" alt="">
										<?php } else { ?>
                                        	<img src="<?php echo get_avatar_url( get_the_author_meta('ID') ); ?>" alt="">
										<?php } ?>
                                        <ul class="tags">
											<?php
												$tags = get_the_terms( get_the_id(), 'post_tag' );
												foreach ( $tags as $tag ) {
													echo '<li><a>' . $tag->name . '</a></li>';
												}
											?>
                                        </ul>
                                    </div>
                                    <div class="details">
                                        <div class="title d-flex flex-row justify-content-between">
                                            <div class="titles">
                                                <a href="single.html"><h4><?php the_title(); ?></h4></a>
                                                <h6><?php the_author(); ?></h6>					
                                            </div>
                                            <ul class="btns">
                                                <li><a><span class="lnr lnr-heart"></span></a></li>
                                                <li><a>Contact</a></li>
                                            </ul>
                                        </div>
										<div><?php the_content(); ?></div>
                                        <p class="address"><span class="lnr lnr-database"></span><?php the_field('price_range'); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
						</div>
						<div class="col-lg-4 sidebar">
							<div class="single-slidebar">
								<h4>Listings by Location</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="category.html"><p>New York</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Park Montana</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Atlanta</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Arizona</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Florida</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Rocky Beach</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Chicago</p></a></li>
								</ul>
							</div>		

						</div>
					</div>
				</div>	
			</section>
			<!-- End post Area -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
