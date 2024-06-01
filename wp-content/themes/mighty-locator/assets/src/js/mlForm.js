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