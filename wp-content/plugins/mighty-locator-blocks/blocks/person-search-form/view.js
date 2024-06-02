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
const notificationTextContainer = document.querySelector('.psfWaiter__notification');
const psfWaiterLoaderContainer = document.querySelector('.psfWaiter__loaderContainer');
const resultArea = document.querySelector('.psfResult');

const notificationList = [
    'Searching the databases',
    'Comparing different sources',
    'Filtering the data',
    'Removing the dublicates',
    'Saving the result',
    'This takes longer than expected'
];

const enableWaiter = () => {
    notificationTextContainer.textContent = notificationList[0];
    psfWaiterLoaderContainer.classList.add('psfWaiter__loaderContainer_active');
}
const disableWaiter = () => {
    notificationTextContainer.textContent = '';
    psfWaiterLoaderContainer.classList.remove('psfWaiter__loaderContainer_active');
}

submitButton.addEventListener( 'click' , function(e){


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
        resultArea.innerHTML = '';
        enableWaiter();

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
            const content = JSON.parse( responseJSON.content );
            resultArea.innerHTML += content;
            disableWaiter();

        } );

    }

})


/* eslint-enable no-console */
