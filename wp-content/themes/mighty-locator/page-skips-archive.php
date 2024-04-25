<?php get_header(); ?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Orders</h1>
				</div>
				<div class="col-auto">
						<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="table-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
									</div>
									<div class="col-auto">
										<button type="submit" class="btn app-btn-secondary">Search</button>
									</div>
								</form>
								
							</div><!--//col-->
							<div class="col-auto">
								
								<select class="form-select w-auto" >
										<option selected value="option-1">All</option>
										<option value="option-2">This week</option>
										<option value="option-3">This month</option>
										<option value="option-4">Last 3 months</option>
										
								</select>
							</div>
							<div class="col-auto">						    
								<a class="btn app-btn-secondary" href="#">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
										<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
									</svg>
									Download CSV
								</a>
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
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
										<td class="cell"><span class="truncate"><?php the_title(); ?></span></td>
										<td class="cell"><span><?php the_time('M j'); ?></span><span class="note"><?php the_time(); ?></span></td>
										<td class="cell"><span class="badge bg-info">Success</span></td>
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