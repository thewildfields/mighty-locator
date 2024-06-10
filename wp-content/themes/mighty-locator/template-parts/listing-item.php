<?php 

$mode = $args['mode'];
$tags = unserialize( get_post_meta( get_the_ID() , 'tags' , true ) );
$counties = unserialize( get_post_meta( get_the_ID() , 'counties' , true ) );
$pricing = get_post_meta( get_the_ID() , 'pricing', true );
$member = get_member_data( get_current_user_id() );
$listing = $mode == 'create' ? 'new' : $post->ID;
$content = $mode!='create' ? get_the_content() : '';

?>

<div


    class="mlCard listing listing_<?php echo $mode; ?>"
    author-id="<?php echo $post->post_author; ?>"
    listing-id="<?php echo $listing; ?>"
>
    <div class="mlCard__content">
        <div class="mlCard__contentHeader">
            <h2 class="mlCard__title listing__title" listing-content="title"><?php the_title(); ?></h2>
            <div class="listing__headerMeta">
                <p class="listing__pricing" listing-content="pricing"><?php echo $pricing; ?></p>
                <button class="listing__star">
                    <svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                        <g>
                            <g data-name="96x96">
                            <path d="M40.47,7.07l5.21,13.24h17.4c4.35,0,6.55,5.25,3.5,8.36l-11.19,11.38,6.08,21.64c1.24,4.42-3.6,8.01-7.36,5.46l-15.42-10.46c-1.64-1.11-3.79-1.11-5.42,0l-15.42,10.46c-3.76,2.55-8.6-1.05-7.36-5.46l6.08-21.64-11.13-11.32c-3.08-3.13-.86-8.43,3.53-8.43h17.31l5.21-13.24c1.61-4.09,7.39-4.09,9,0Z"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <div class="mlCard__contentBody">
            <div class="listingContent">
                <div class="listingContent__thumbnailArea">
                    <?php echo get_wp_user_avatar($post->post_author, 200); ?>
                    <div class="listingContent__tags">
                        <?php if( $tags ) { foreach ( $tags as $tag ) { ?>
                        <span class="listingContent__tagsItem"><?php echo $tag; ?></span>
                        <?php } } ?>
                    </div>
                </div>
                <div class="listingContent__content">
                    <div class="listingContent__meta">
                        <div class="listingContent__data">
                            <p class="listingContent__name"><?php the_author(); ?></p>
                            <p class="listingContent__date"><?php the_time('F j, Y'); ?></p>
                        </div>
                        <p class="listingContent__locations">
                            <?php if( $counties ) { foreach ($counties as $county) { ?>
                                <span class="listingContent__locationsItem"><?php echo $county; ?> Co</span>
                            <?php } } ?>
                        </p>
                    </div>
                    <div class="listingContent__description">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mlCard__contentFooter">
            <?php if( is_user_logged_in() && get_current_user_id() == $post->post_author && $mode == 'display' ){  ?>
                <a
                    href="<?php echo home_url('/add-listing'); ?>"
                    class="listing__button listing__button_edit"
                ><span>Edit</span></a>
            <?php } ?>
            <div class="listing__buttons">
                <a class="listing__button listing__button_contact" >
                    <span>Contact</span>                            
                </a>
            </div>
        </div>
    </div>
</div>