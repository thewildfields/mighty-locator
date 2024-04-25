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

    console.log( formData );

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

            $('#fast-skip-result').html( '' );
            
            const responseTrimmed = JSON.parse( response.slice( 0 , -1 ) );
            const responseBody = JSON.parse( responseTrimmed.skip.body );

            console.log( responseTrimmed );

            const balance = Math.round( responseTrimmed.balance * 100 ) / 100;

            $('#current-balance').text( balance )

            if( responseBody.contacts.length <= 0 ){
                $('#fast-skip-status').text('Error');
                $('#fast-skip-status').removeClass('bg-info');
                $('#fast-skip-status').addClass('bg-danger');
                $('#fast-skip-name').text( 'No Results found' );
                $('#fast-skip-content').text('');
            } else {

                $('#fast-skip-status').addClass('bg-info');
                $('#fast-skip-status').removeClass('bg-danger');
                $('#fast-skip-status').text('Successfull');

                const totalResultsFonund = responseBody.contacts.length;

                responseBody.contacts.forEach(contact => {

                    const resultCard = $('<div class="app-card shadow-sm mb-4"></div>');

                    // ResultCard Header
                    const resultCardHeader = $('<div class="app-card-header px-4 py-3 searchResult__header"></div>');
                    const resultCardBadge = $(`<div class="mb-2"><span class="badge bg-info">Successfull</span></div>`);
                    const resultCardName = $(`<h2 class="mb-1">${contact.names[0].firstname} ${contact.names[0].lastname}</h2>`)
                    $(resultCardHeader).append(resultCardBadge);
                    $(resultCardHeader).append(resultCardName);
                    $(resultCard).append(resultCardHeader);

                    // ResultCard Body
                    const resultCardBody = $('<div class="app-card-body pt-4 px-4"><div class="notification-content"></div></div>');
                    // Age
                    if( contact.names[0].age ){
                        $(resultCardBody).append(`<p><strong>Age: </strong>${contact.names[0].age}</p>`);
                    }

                    // Phone Numbers
                    $(resultCardBody).append(`<h3><strong>Phones</strong></h3>`);
                    const phonesParagraph = $('<p></p>');
                    if( contact.phones.length == 0 ){
                        $(phonesParagraph).text('Sorry, no phone numbers were found.');
                    } else {
                        contact.phones.forEach(phone => {
                            $(phonesParagraph).append(`<a href="tel:${phone.phonenumber}:">${phone.phonenumber}</a><br/>`);
                        });
                    }
                    $(resultCardBody).append(phonesParagraph);

                    // Addresses
                    $(resultCardBody).append(`<h3><strong>Addresses</strong></h3>`);
                    const addressesParagraph = $('<p></p>');
                    if( contact.confirmed_address.length == 0 ){
                        $(addressesParagraph).text('Sorry, no addresses were found');
                    } else {
                        contact.confirmed_address.forEach(address => {
                            $(addressesParagraph).append(`${address.street}, ${address.city}, ${address.state} ${address.zip}<br/>`);
                        });
                    }
                    $(resultCardBody).append(addressesParagraph);

                    // Emails
                    $(resultCardBody).append(`<h3><strong>Emails</strong></h3>`);
                    const emailsParagraph = $('<p></p>');
                    if( contact.emails.length == 0 ){
                        $(emailsParagraph).append(`Sorry, no emails were found`);
                    } else {
                        contact.emails.forEach(email => {
                            $(emailsParagraph).append(`<a href="mailto:${email.email}">${email.email}</a><br/>`);
                        });
                    }
                    $(resultCardBody).append(emailsParagraph);

                    // Relatives
                    $(resultCardBody).append(`<h3><strong>Relatives</strong></h3>`);
                    const relativesParagraph = $('<p></p>');
                    if( contact.relatives.length == 0 ){
                        $(relativesParagraph).append(`Sorry, no relatives were found`);
                    } else {
                        contact.relatives.forEach(relative => {
                            $(relativesParagraph).append(`${relative.name} , ${relative.age}`);
                            if( relative.phones.length > 0 ){
                                $(relativesParagraph).append('<br>');
                                relative.phones.forEach(phone => {
                                    $(relativesParagraph).append(`<a style="margin-right: 20px;" href="tel:${phone.phonenumber}:">${phone.phonenumber}</a>`);
                                });
                            }
                            $(relativesParagraph).append('<br><br>');
                        });
                    }
                    $(resultCardBody).append(relativesParagraph);
                    $(resultCard).append(resultCardBody);

                    // ResultCard Footer
                    const resultCardFooter = $('<div class="app-card-footer px-4 py-3 pb-1"></div>');
                    $(resultCard).append(resultCardFooter);

                    $('#fast-skip-result').append(resultCard);

                    console.log( resultCard );

                });
                              




            }

            $('#fast-skip-result').animate({
                maxHeight: 50000,
                opacity: 1
            }, 300)

        }
    );

})