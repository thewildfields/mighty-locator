<?php get_header(); ?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Skips Archive</h1>
				</div>
			</div>
			    
			    <div class="row g-4">
					<?php 
					
					$skipQueryArgs = array(
						'post_type' => 'skip',
						'post_status' => 'publish',
						'author' => get_current_user_id(),
						'posts_per_page' => -1
					);

					$skipQuery = new WP_Query( $skipQueryArgs );

					if( $skipQuery->have_posts() ) : while( $skipQuery->have_posts() ) : $skipQuery->the_post();

					?>

					<div class="col-6 col-md-4 col-xl-3 col-xxl-2">
					    <div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
							    <span class="icon-holder">
	                                <i class="fas fa-file-alt text-file"></i>
	                            </span>
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
									    <li><span class="text-muted">Type:</span> <?php echo get_post_meta( get_the_ID(), 'skip_type', true ); ?></li>
									    <li><span class="text-muted">Created:</span> <?php the_time('F j, Y'); ?></li>
								    </ul>
							    </div>
							</div>
						</div>
					</div>

					<?php endwhile; wp_reset_postdata(); endif;
					
					?>
				</div>
			</div>
		</div>
		
<?php get_footer(); ?>