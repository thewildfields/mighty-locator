import $ from 'jquery';

const skipSubmit = $('.single-skip');

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
                console.log( responseTrimmed.errorMessage );
            } else if( 'success' == responseStatus ){

                const balance = Math.round( responseTrimmed.balance * 100 ) / 100;

                $('#current-balance').text( balance )

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


                        // Name
                        $('[fast-search-data="name"]').text(`${contact.names[0].firstname} ${contact.names[0].lastname}`);
                        // Age
                        $('[fast-search-data="age"]').text(contact.names[0].age);
                        // Phone Numbers
                        if( contact.phones.length > 0 ){
                            $('[fast-search-data="phones"]').html('');
                            contact.phones.forEach(phone => {
                                $('[fast-search-data="phones"]').append(`<p class="cardSection__contentItem"><a href="tel:${phone.number}">${phone.number}</a></p>`);
                            });
                        }
                        // Addresses
                        if( contact.addresses.length > 0){
                            $('[fast-search-data="addresses"]').html('');
                            contact.addresses.forEach(address => {
                                $('[fast-search-data="addresses"]').append(`<p class="cardSection__contentItem">${address.street}, ${address.city}, ${address.state} ${address.zip}</p>`);
                            });
                        }
                        // Emails
                        if( contact.emails.length > 0 ){
                            $('[fast-search-data="emails"]').html('');
                            contact.emails.forEach(email => {
                                $('[fast-search-data="emails"]').append(`
                                <p class="cardSection__contentItem"><a href="mailto:${email}">${email}</a></p>
                                `);
                            });
                        }
                        // Relatives
                        if( contact.relatives.length > 0 ){
                            $('[fast-search-data="relatives"]').html('');
                            contact.relatives.forEach(relative => {
                                $('[fast-search-data="relatives"]').append(`<p class="cardSection__contentItem">${relative.name}</p>`);
                                if( relative.phones.length > 0 ){
                                    const relativePhonesContainer = ('<div class="cardSection__content cardSection__content_flex"></div>');
                                    $('[fast-search-data="relatives"]').append( relativePhonesContainer );
                                    relative.phones.forEach(phone => {
                                        $('[fast-search-data="relatives"]').append(`<p class="cardSection__contentItem cardSection__contentItem_small"><a href="tel:${ phone.number }">${ phone.number }</a></p>`);
                                        $(relativePhonesContainer).textContent += 'hi '
                                    })
                                }
                            })
                        };
                    });
                }
            }

            $('#fast-skip-result').animate({
                maxHeight: 50000,
                opacity: 1
            }, 300)

        }
    );

})