<?php get_header(); ?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Searches Archive</h1>
				</div>
			</div>
			<div class="app-card app-card-orders-table shadow-sm mb-5">
				<div class="app-card-body">
					<div class="table-responsive">
						<table class="table app-table-hover mb-0 text-left">
							<thead>
								<tr>
									<th class="cell">Search ID</th>
									<th class="cell">Person name</th>
									<th class="cell">Date</th>
									<th class="cell">Status</th>
									<th class="cell">Price</th>
									<th class="cell"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
									$skipsArchiveForUserArgs = array(
										'post_type' => 'skip',
										'author' => get_current_user_id(),
										'posts_per_page' => -1
									);
									$skipsArchiveForUser = new WP_Query( $skipsArchiveForUserArgs );
									if( $skipsArchiveForUser->have_posts() ) : while( $skipsArchiveForUser->have_posts() ) : $skipsArchiveForUser->the_post();

								?>

									<tr>
										<td class="cell"><?php echo get_current_user_id() . '-' . get_the_ID(); ?></td>
										<td class="cell"><span><?php the_title(); ?></span></td>
										<td class="cell"><span><?php the_time('M j'); ?></span><span class="note"><?php the_time(); ?></span></td>
										<?php if ( get_post_meta( get_the_ID() , 'is_successful' , true ) ){ ?>
										<td class="cell"><span class="badge bg-info">Success</span></td>
										<?php } else { ?>
										<td class="cell"><span class="badge bg-danger">Error</span></td>
										<?php } ?>
										<td class="cell">$1.99</td>
										<td class="cell"><a class="btn-sm app-btn-secondary" href="<?php the_permalink(); ?>">View</a></td>
									</tr>

								<?php endwhile; endif; ?>								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>