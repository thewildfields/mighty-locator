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

    e.preventDefault();
    e.stopPropagation();

    const form = $(this).closest('.skipForm');

    let relatives = $(form).find('#skip-relatives').val().split(',');

    for (let i = 0; i < relatives.length; i++) {
        relatives[i] = relatives[i].trim();        
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
            const responseStatus = responseTrimmed.status;

            if( 'error' == responseStatus ){
                $('#error-text').text( responseTrimmed.errorMessage );
                $('[fast-search-data="name"]').text( `${responseTrimmed.skipData.firstName} ${responseTrimmed.skipData.lastName}` );

                $('#fast-skip-error').animate({
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

                    const totalResultsFonund = responseTrimmed.people.length;

                    responseTrimmed.people.forEach(contact => {

                        const personCard = document.createElement('div');
                        personCard.classList.add('card');

                        const personCardHeader = `<div class="card__header"><div class="container card__container"><h2 class="card__title card__title_big" fast-search-data="name">${contact.names[0].firstname} ${contact.names[0].lastname}</h2></div></div>`;

                        const personCardBody = document.createElement('div');
                        personCardBody.classList.add('card__body');

                        let contactPhones = [];
                        contact.phones.forEach( phone => {
                            const phoneElement = document.createElement('p');
                            phoneElement.classList.add('cardSection__contentItem','cardSection__contentItem_phone');
                            const phoneElementHTML = `<a href="tel:${phone.number}">${phone.number}</a>`;
                            phoneElement.innerHTML = phoneElementHTML;
                            contactPhones.push( phoneElement );
                        });
                        const phoneSection = createCardSection( 'Phones' , 'phones' , contactPhones );

                        let emails = [];
                        contact.emails.forEach( email => {
                            const emailElement = document.createElement('p');
                            emailElement.classList.add('cardSection__contentItem','cardSection__contentItem_email');
                            const emailElementHTML = `<a href="mailto:${email}">${email}</a>`;
                            emailElement.innerHTML = emailElementHTML;
                            emails.push( emailElement );
                        });
                        const emailsSection = createCardSection( 'Emails' , 'emails' , emails );

                        let addresses = [];
                        contact.addresses.forEach( address => {
                            const addressElement = document.createElement('p');
                            addressElement.classList.add('cardSection__contentItem','cardSection__contentItem_address');
                            const addressElementHTML = `${address.street}, ${address.city}, ${address.state} ${address.zip}`;
                            addressElement.innerHTML = addressElementHTML;
                            addresses.push( addressElement );
                        });
                        const addressesSection = createCardSection( 'Addresses' , 'addresses' , addresses );

                        let relatives = [];
                        contact.relatives.forEach( relative => {
                            const relativeElement = document.createElement('p');
                            relativeElement.classList.add('cardSection__contentItem','cardSection__contentItem_relative');
                            let relativeElementHTML = `${relative.name} (${relative.age})`;
                            if( relative.phones ){
                                relativeElementHTML += '<br>';
                                relative.phones.forEach( phone => {
                                    relativeElementHTML += `<p><a href="tel:${phone.number}">${phone.number}</a></p>`
                                })
                            }
                            relativeElement.innerHTML = relativeElementHTML;
                            relatives.push( relativeElement );
                        });
                        const relativesSection = createCardSection( 'Relatives' , 'relatives' , relatives );


                        personCardBody.append( phoneSection );
                        personCardBody.append( emailsSection );
                        personCardBody.append( addressesSection );
                        personCardBody.append( relativesSection );
                        
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