import $ from 'jquery';

const skipSubmit = $('.single-skip');

$(skipSubmit).on( 'click' , function( e ){

    e.preventDefault();
    e.stopPropagation();

    const form = $(this).closest('.skipForm');

    const formData = {
        authorID: $(form).find('#skip-author-id').val(),
        firstName: $(form).find('#skip-first-name').val(),
        lastName: $(form).find('#skip-last-name').val(),
        streetAddress: $(form).find('#skip-street-address').val(),
        city: $(form).find('#skip-city').val(),
        state: $(form).find('#skip-state').val(),
        zip: $(form).find('#skip-zip').val(),
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

            $('#fast-skip-content').text( '' );
            
            const responseTrimmed = JSON.parse( response.slice( 0 , -1 ) );
            const responseBody = JSON.parse( responseTrimmed.body );

            let contact;

            if( responseBody.contacts.length <= 0 ){
                $('#fast-skip-status').text('Error');
                $('#fast-skip-status').removeClass('bg-info');
                $('#fast-skip-status').addClass('bg-danger');
                $('#fast-skip-name').text( 'No Results found' );
                $('#fast-skip-content').text('');
                $('#fast-skip-link').text('Upgrade membership to use waterfall search!');
            } else {
                const totalResultsFonund = responseBody.contacts.length;
                contact = responseBody.contacts[0];
                $('#fast-skip-status').addClass('bg-info');
                $('#fast-skip-status').removeClass('bg-danger');
                $('#fast-skip-status').text('Successfull');
                $('#fast-skip-link').text('Upgrade your membership to see more data!');

                $('#fast-skip-name').text( `${contact.names[0].firstname} ${contact.names[0].lastname}` );
                if( contact.names[0].age ){
                    $('#fast-skip-content').append(`<p><strong>Age: </strong> ${contact.names[0].age} </p>`);
                }
                if( contact.relatives.length > 0 ){
                    $('#fast-skip-content').append(`<p><strong>Relatives found: </strong> ${contact.relatives.length} </p>`);
                }
            }

            $('#fast-skip-result').animate({
                maxHeight: 500,
                opacity: 1
            }, 300)

        }
    );

})