import $ from 'jquery';

const skipSubmit = $('.single-skip');

const createCardSection = ( label , title , elements ) => {
    const cardSectionElement = document.createElement('div');
    cardSectionElement.classList.add( 'cardSection' );
    const cardSectionTitle = document.createElement('div');
    cardSectionTitle.classList.add( 'cardSection__title' );
    cardSectionTitle.textContent = label;
    cardSectionElement.append( cardSectionTitle );
    const cardSectionContent = document.createElement('div');
    if( elements && elements.length > 0 ){        
        elements.forEach(element => {
            cardSectionContent.append( element );
        });
    } else {
        cardSectionContent.textContent = `No ${title} were found for this user`;
    }
    cardSectionElement.append( cardSectionContent );
    return cardSectionElement;
}

$(skipSubmit).on( 'click' , function( e ){

    $('.loader').show();
    $('#peopleCards').html('');
    $('#fast-skip-error').animate({
        maxHeight: 0,
        opacity: 0
    }, 300)
    $('#fast-skip-result').animate({
        maxHeight: 0,
        opacity: 0
    }, 300)
    
    e.preventDefault();
    e.stopPropagation();



    const form = $(this).closest('.skipForm');

    let relatives = null

    if( $(form).find('#skip-relatives').val().length > 0 ){

        relatives = $(form).find('#skip-relatives').val().split(',');
    
        for (let i = 0; i < relatives.length; i++) {
            relatives[i] = relatives[i].trim();        
        }
    }

    const formData = {
        authorID: $(form).find('#skip-author-id').val(),
        authorFreeSearches: $(form).find('#author-free-searches').val(),
        authorPlan: $(form).find('#skip-author-plan').val(),
        firstName: $(form).find('#skip-first-name').val(),
        lastName: $(form).find('#skip-last-name').val(),
        streetAddress: $(form).find('#skip-street-address').val(),
        city: $(form).find('#skip-city').val(),
        state: $(form).find('#skip-state').val(),
        zip: $(form).find('#skip-zip').val(),
        phone: $(form).find('#skip-phone').val(),
        email: $(form).find('#skip-email').val(),
        relatives: relatives,
        price: $(form).find('#skip-price').val(),
        balance: $(form).find('#skip-balance').val(),
    }

    const data = {
        action: 'single_skip',
        skipData: formData,
        nonce: 'nonce'
    }

    $.post(
        //@ts-ignore
        ajaxObject.admin_ajax_url,
        data,
        function( response ){
            
            const responseTrimmed = JSON.parse( response.slice( 0 , -1 ) );

            console.log( responseTrimmed );

            const responseStatus = responseTrimmed.status;

            $('.loader').hide();

            if( 'error' == responseStatus ){
                console.log( responseStatus );
                $('#error-text').text( responseTrimmed.errorMessage );
                $('[fast-search-data="name"]').text( `${responseTrimmed.firstName} ${responseTrimmed.lastName}` );

                $('#fast-skip-error').animate({
                    maxHeight: 50000,
                    opacity: 1
                }, 300)
                $('#fast-skip-result').animate({
                    maxHeight: 50000,
                    opacity: 1
                }, 300)
            } else if( 'success' == responseStatus ){

                const balance = Math.round( responseTrimmed.balance * 100 ) / 100;

                $('#current-balance').text( balance );
                $('#free-searches-balance').text( responseTrimmed.freeSearchesBalance );
                $('#front-page-free-searches-balance').text( responseTrimmed.freeSearchesBalance );
                $('#front-page-free-searches-balance-2').text( responseTrimmed.freeSearchesBalance );

                if( responseTrimmed.people.length <= 0 ){
                    $('#fast-skip-status').text('Error');
                    $('#fast-skip-status').removeClass('bg-info');
                    $('#fast-skip-status').addClass('bg-danger');
                    $('#fast-skip-name').text( 'No Results found' );
                    $('#fast-skip-content').text('');
                } else {

                    $('#fast-skip-status').addClass('bg-info');
                    $('#fast-skip-status').removeClass('bg-danger');
                    $('#fast-skip-status').text('Successfull');

                    responseTrimmed.people.forEach(contact => {

                        const personCard = document.createElement('div');
                        personCard.classList.add('card');

                        const personCardHeader = `<div class="card__header"><div class="container card__container"><h2 class="card__title card__title_big" fast-search-data="name">${contact.firstName} ${contact.lastName}</h2></div></div>`;

                        const personCardBody = document.createElement('div');
                        personCardBody.classList.add('card__body');

                        let contactPhones = [ ];
                        const phoneElement = document.createElement('p');
                        phoneElement.classList.add('cardSection__contentItem','cardSection__contentItem_phone');
                        const phoneElementHTML = `<a href="tel:${contact.phone}">${contact.phone}</a>`;
                        phoneElement.innerHTML = phoneElementHTML;
                        contactPhones.push( phoneElement );
                        const phoneSection = createCardSection( 'Phones' , 'phones' , contactPhones );

                        let emails = [];
                        const emailElement = document.createElement('p');
                        emailElement.classList.add('cardSection__contentItem','cardSection__contentItem_email');
                        const emailElementHTML = `<a href="mailto:${contact.email}">${contact.email}</a>`;
                        emailElement.innerHTML = emailElementHTML;
                        emails.push( emailElement );
                        const emailsSection = createCardSection( 'Emails' , 'emails' , emails );

                        let addresses = [];
                        const addressElement = document.createElement('p');
                        addressElement.classList.add('cardSection__contentItem','cardSection__contentItem_address');
                        const addressElementHTML = `${contact.address}, ${contact.city}, ${contact.state} ${contact.zip}`;
                        addressElement.innerHTML = addressElementHTML;
                        addresses.push( addressElement );
                        const addressesSection = createCardSection( 'Addresses' , 'addresses' , addresses );


                        personCardBody.append( phoneSection );
                        personCardBody.append( emailsSection );
                        personCardBody.append( addressesSection );
                        
                        personCard.innerHTML += personCardHeader;
                        personCard.append( personCardBody );

                        $('#peopleCards').append( personCard );
                    });

                }

                $('#fast-skip-result').animate({
                    maxHeight: 50000,
                    opacity: 1
                }, 300)

            }


        }
    );

})