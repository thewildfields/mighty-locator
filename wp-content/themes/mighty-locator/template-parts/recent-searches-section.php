<?php 

$member = get_member_data(get_current_user_id());

        
$resentSearchesArgs = array(
    'post_type' => 'search',
    'posts_per_page' => 5,
    'author' => $member['id']
);

$resentSearches = new WP_Query( $resentSearchesArgs );

if( $resentSearches->found_posts ){

?>

<h2>Your recent searches</h2>

<?php 

if( $resentSearches->have_posts() ) : while( $resentSearches->have_posts()) : $resentSearches->the_post(); 
echo get_template_part('template-parts/recent-searches','item');
endwhile; wp_reset_postdata(); endif;

}

?>

<?php if( $resentSearches->found_posts > 5 ){ ?>
    <a href="<?php echo home_url('/search/'); ?>" class="button button_success psfResult__button" id="preview-redirect-link">See whole archive</a>
<?php } ?>