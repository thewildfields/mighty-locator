/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';

/* eslint-disable no-console */


const submitButton = document.getElementById('person-serch-form-submit');

submitButton.addEventListener( 'click' , function(e){

    console.log( 'loading' );

    const form = this.closest('.psf');
    const inputs = form.querySelectorAll('.mlForm__input');
    const requiredInputs = form.querySelectorAll('.mlForm__input[required]');

    let requiredInputsHaveValues = true;

    for (let i = 0; i < requiredInputs.length; i++) {
        const val = requiredInputs[i].value.trim();
        if( !val || val == '' || val.length == 0 ){
            requiredInputsHaveValues = false;
            break;
        }
    }

    if( requiredInputsHaveValues ){

        e.preventDefault();
        e.stopPropagation();

        const searchInput = {};
        inputs.forEach(input => {
            if( input.value ){
                searchInput[input.name.slice( 4 )] = input.value;
            } 
        });

        apiFetch( {
            path: '/ml/v2/person-search',
            method: 'POST',
            data: searchInput
        } ).then( ( response ) => {
            const responseJSON = JSON.parse( response );

            console.log(
                responseJSON
            );
            // people.forEach(person => {
            //     console.log( person );
            // });
        } );

    }





})


/* eslint-enable no-console */
