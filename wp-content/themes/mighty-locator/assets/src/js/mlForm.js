import apiFetch from '@wordpress/api-fetch';

// Label behaviour

const mlInputs = document.querySelectorAll('.mlForm__input');

const activateLabel = ( input ) => {
    const inputGroup = input.closest('.mlForm__inputGroup');
    if( inputGroup ){
        const label = inputGroup.querySelector('.mlForm__label');
        if( label ){
            label.classList.add('mlForm__label_active');
        }
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
const waiterArea = document.querySelector('.psfWaiter');
const resultArea = document.querySelector('.psfResult');
const quickResultStatus = document.getElementById('preview-status');
const quickResultPeopleCount = document.getElementById('preview-people-count');
const quickResultAddressesCount = document.getElementById('preview-addresses-count');
const quickResultPhonesCount = document.getElementById('preview-phones-count');
const quickResultSearchType = document.getElementById('preview-search-type');
const quickResultPreviewTimer = document.getElementById('preview-redirect-timer');
const quickResultPreviewLink = document.getElementById('preview-redirect-link');
const userFreeSearchesBalance = document.getElementById('user-freeSearcherBalance');
const searchPrice = document.getElementById('preview-searchPrice');
const userWalletBalance = document.getElementById('user-walletBalance');

let personSearchTimeout = 10;
if( quickResultPreviewTimer ){
    quickResultPreviewTimer.textContent = personSearchTimeout;
}


const notificationList = [
    'Searching the databases',
    'Comparing different sources',
    'Filtering the data',
    'Removing the dublicates',
    'Saving the result',
    'Finishing the job'
];
let notificationIndex = 0;

const enableWaiter = () => {
    notificationTextContainer.textContent = notificationList[notificationIndex];
    psfWaiterLoaderContainer.classList.add('psfWaiter__loaderContainer_active');
}
const disableWaiter = () => {
    notificationTextContainer.textContent = '';
    psfWaiterLoaderContainer.classList.remove('psfWaiter__loaderContainer_active');
    waiterArea.remove();
    waiterArea.style.display = 'none';
}

if( submitButton ){
    submitButton.addEventListener( 'click' , function(e){
        waiterArea.style.display = 'block';
    
    
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
            enableWaiter();

            setInterval( function(){
                if( notificationIndex < notificationList.length - 1 ){
                    notificationIndex++;
                    notificationTextContainer.textContent = notificationList[notificationIndex];
                }
            } , 3500 )
    
            const searchInput = {
                searchType: 'single'
            };

            inputs.forEach(input => {
                if( input.value ){
                    searchInput[input.name.slice( 4 )] = input.value;
                }
            });

            console.log( searchInput );
    
            apiFetch( {
                path: 'wp-json/ml/v2/person-search',
                method: 'POST',
                data: searchInput
            } ).then( ( response ) => {
                const responseJSON = JSON.parse( response );
                console.log( responseJSON );
                quickResultPeopleCount.textContent = responseJSON.totalPeopleCount;
                quickResultStatus.textContent = responseJSON.status[0];
                quickResultAddressesCount.textContent = responseJSON.addressesCount;
                quickResultPhonesCount.textContent = responseJSON.phoneNumbersCount;
                quickResultSearchType.textContent = searchInput.searchType;
                quickResultPreviewLink.setAttribute( 'href', responseJSON.postUrl );
                resultArea.classList.add('psfResult_active');

                if( 'free' == responseJSON.searchType ){
                    userFreeSearchesBalance.textContent = responseJSON.freeSearchesBalance;
                    searchPrice.textContent = 'Free'
                } else if( 'paid' == responseJSON.searchType ){
                    searchPrice.textContent = '$' + responseJSON.searchPrice;
                    userWalletBalance.textContent = '$' + responseJSON.newWalletBalance;
                }

                setInterval( function(){
                    if( personSearchTimeout > 0){
                        personSearchTimeout--;
                        quickResultPreviewTimer.textContent = personSearchTimeout;
                    }
                } , 1000 )

                disableWaiter();

                // setTimeout( function(){
                //     window.location.href = responseJSON.postUrl;
                // } , 10000 );

            } );
    
        }
    
    })
}
