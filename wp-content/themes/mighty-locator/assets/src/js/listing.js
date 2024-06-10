import $ from 'jquery';

const listingStars = $('.listing__star');
const listingContact = $('.listing__button_contact');

const cookies = document.cookie.split('; ');
const slPrefix = "saved-listings=";
let savedListings = [];
for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i];
    if( cookie.includes(slPrefix) ){
        const cookiesString = cookie.slice( slPrefix.length );
        savedListings = cookiesString.split('-');
        break;
    }
}

savedListings.forEach(listing => {
    $(`.listing[listing-id="${listing}"] .listing__star`).addClass('listing__star_checked');
});


$(listingStars).on( 'click', function(){

    $(this).toggleClass('listing__star_checked');

    const card = $(this).closest('.listing');
    const author = $(card).attr('author-id');
    const listing = $(card).attr('listing-id');

    const data = {
        action: 'save_listing_to_cookie',
        author: author,
        listing: listing
    }

    $.post(
        ajaxObject.admin_ajax_url,
        data,
        function(response){
            const responseJSON = JSON.parse( response.slice( 0 , -1) );
            console.log( responseJSON );
        }
    )

})

$(listingContact).on('click',function(e){

    const link = $(this);

    if( !$(link).attr('href') ){

        e.preventDefault();

        const card = $(link).closest('.listing');
        const author = $(card).attr('author-id');
        const listing = $(card).attr('listing-id');
        const span = $(link).find('span');
    
        const data = {
            action: 'return_author_contacts',
            author: author,
            listing: listing
        }
        $.post(
            ajaxObject.admin_ajax_url,
            data,
            function(response){
                const responseJSON = JSON.parse( response.slice( 0 , -1) );
                $(span).text(responseJSON);
                $(link).attr('href',`mailto:${responseJSON}`)
            }
        )
    }
})

const listingEditInput = (input) => {
    const inputId = input.attr('listing-edit');
    const tempDisplay = $(`[listing-content="${inputId}"]`);
    $(tempDisplay).text($(input).val());
}

const listingEdit = $('.mlForm__submit[listing-edit="submit"]');
const inputs = $('.mlForm__input');

$(listingEdit).on('click', function(e){
    const link = $(this);
    e.preventDefault();
    const listingData = {
        action: 'update_listing',
        listing: $(this).attr('listing-id')
    }
    for (let i = 0; i < inputs.length; i++) {
        const fieldName = $(inputs[i]).attr('listing-edit');
        switch ( fieldName ) {
            case 'tags':
            case 'counties':
                listingData[fieldName] = $(inputs[i]).val().split(',');                
            break;        
            default:
                listingData[fieldName] = $(inputs[i]).val();
            break;
        }
    }
    console.log( listingData );
    $.post(
        ajaxObject.admin_ajax_url,
        listingData,
        function(response){
            window.location.reload();
        }
    )
})


for (let i = 0; i < inputs.length; i++) {
    $(inputs[i]).on('input', function(){
        listingEditInput( $(inputs[i]));
    })        
}