<?php

$mode = $args['mode'];

$tags = $mode!='create' ? unserialize( get_post_meta( get_the_ID() , 'tags' , true ) ) : array() ;
$counties = $mode!='create' ? unserialize( get_post_meta( get_the_ID() , 'counties' , true ) ) : array() ;
$pricing = $mode!='create' ? get_post_meta( get_the_ID() , 'pricing', true ) : '';
$title = $mode!='create' ? get_the_title() : 'New Listing';
$content = $mode!='create' ? get_the_content() : '';
$listing = $mode == 'create' ? 'new' : $post->ID;
 
?>

<div class="mlCard mlCard_noprefix listing_editForm">
    <div class="mlCard__content">
        <div class="mlForm">
            <div class="mlForm__group">
                <label class="mlForm__label">Title</label>
                <input type="text" class="mlForm__input" value="<?php echo $title; ?>" listing-edit="title">
            </div>
            <div class="mlForm__group">
                <label class="mlForm__label">Tags (list multiple using commas)</label>
                <input type="text" class="mlForm__input" value="<?php echo implode(',',$tags); ?>" listing-edit="tags">
            </div>
            <div class="mlForm__group">
                <label class="mlForm__label">Counties (list multiple using commas)</label>
                <input type="text" class="mlForm__input" value="<?php echo implode(',',$counties); ?>" listing-edit="counties">
            </div>
            <div class="mlForm__group">
                <label class="mlForm__label">Pricing</label>
                <input type="text" class="mlForm__input" value="<?php echo $pricing; ?>" listing-edit="pricing">
            </div>
            <div class="mlForm__group">
                <label class="mlForm__label">Listing content</label>
                <textarea type="text" class="mlForm__input mlForm__input_textarea" value="<?php echo implode(',',$counties); ?>" listing-edit="content" rows="15"><?php echo strip_tags( $content ) ; ?></textarea>
            </div>
            <button
                class="mlForm__submit button button_success"
                listing-edit="submit"
                listing-id="<?php echo $listing; ?>"
            >Submit</button>
        </div>
    </div>
</div>