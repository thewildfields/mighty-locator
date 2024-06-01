<?php 

/**
 * Title: Person Search $_POST print
 * Slug: mighty-locator/person-search-post
 * Categories: featured
 */

if( isset( $_POST ) && !empty( $_POST ) ){
    echo '<pre>';
    print_r( $_POST );
    echo '</pre>';
}

?>

hello hello