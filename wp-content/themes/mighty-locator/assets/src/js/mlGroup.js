import $ from 'jquery';

const inputGroupTrigger = $('.inputGroup__trigger');

const userID = $('#current-user-id').val();

$(inputGroupTrigger).on( 'click' , function(){

    const group = $(this).closest('.inputGroup');
    const inputs  = $(group).find('.inputGroup__input');

    switch ( $(this).attr('data-action') ) {
        case 'enable':
            $(this).text('Update');
            $(inputs).removeAttr('disabled');
            $(this).attr( 'data-action' , 'update' );
            break;
        case 'update':
            const data = {
                action: 'update_user_info',
                userID: userID,
                infoType: $(inputs[0]).data('user-info-type'),
                info: $(inputs[0]).data('user-info'),
                value: $(inputs[0]).val(),
                nonce: 'nonce'
            }
            $(inputs).attr( 'disabled' , 'disabled' );
            console.log( data );
            $.post(
                ajaxObject.admin_ajax_url,
                data,
                function( response ){
                    console.log( response );
                }
            )
            break;
    }


})