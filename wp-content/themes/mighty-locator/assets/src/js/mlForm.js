import apiFetch from '@wordpress/api-fetch';

// Label behaviour

const mlInputs = document.querySelectorAll('.mlForm__input');

const activateLabel = ( input ) => {
    const inputGroup = input.closest('.mlForm__inputGroup');
    const label = inputGroup.querySelector('.mlForm__label');
    if( label ){
        label.classList.add('mlForm__label_active');
    }
}

const deactivateLabel = ( input ) => {
    const inputGroup = input.closest('.mlForm__inputGroup');
    const label = inputGroup.querySelector('.mlForm__label');
    if( !input.value || input.value.length == 0 ){
        label.classList.remove('mlForm__label_active');
    }
}

for (let i = 0; i < mlInputs.length; i++) {
    if( mlInputs[i].value && mlInputs[i].value.length > 0 ){
        activateLabel( mlInputs[i] )
    }
    mlInputs[i].addEventListener( 'focus' , function(){
        activateLabel( mlInputs[i] )
    });
    mlInputs[i].addEventListener( 'blur' , function(){
        deactivateLabel( mlInputs[i] )
    });
}



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

        console.log( searchInput );

        apiFetch( {
            path: '/ml/v2/person-search',
            method: 'POST',
            data: searchInput
        } ).then( ( response ) => {
            console.log( response );
            // const responseJSON = JSON.parse( response );
            // const content = JSON.parse( responseJSON.content );
            // resultArea.innerHTML += content;
            // disableWaiter();

        } );

    }

})