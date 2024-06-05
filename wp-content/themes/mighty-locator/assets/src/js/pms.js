// Login Form styling
const loginForm = document.getElementById('pms_login');
if( loginForm ){
    const loginFormInputGroups = loginForm.querySelectorAll('p');
    const loginFormInputs = loginForm.querySelectorAll('input');
    const loginFormLabels = loginForm.querySelectorAll('label');
    const loginFormSubmit = loginForm.querySelector('#wp-submit');
    const loginFormExtraText = loginForm.querySelector('.login-extra');
    
    loginForm.classList.add('mlForm','signinForm');
    loginFormInputGroups.forEach(group => {
        group.classList.add('mlForm__inputGroup');
    });
    loginFormInputs.forEach(input => {
        input.classList.add('mlForm__input');
    });
    loginFormLabels.forEach(label => {
        label.classList.add('mlForm__label');
    });
    loginFormSubmit.classList.add('button','button_info','signinForm__submit');
    loginFormExtraText.classList.add('signinForm__extra')
}

// Register And Password Recovery Form styling
const registerForms = document.querySelectorAll('.pms-form');
if( registerForms ){
    for (let i = 0; i < registerForms.length; i++) {
        const form = registerForms[i];
        const registerFormInputGroups = form.querySelectorAll('.pms-field');
        const registerFormInputs = form.querySelectorAll('input');
        const registerFormLabels = form.querySelectorAll('label');
        const registerFormSubmit = form.querySelector('input[type="submit"]');
        
        form.classList.add('mlForm','signinForm');
        registerFormInputGroups.forEach(group => {
            group.classList.add('mlForm__inputGroup');
        });
        registerFormInputs.forEach(input => {
            input.classList.add('mlForm__input');
        });
        registerFormLabels.forEach(label => {
            label.classList.add('mlForm__label');
        });
        registerFormSubmit.classList.add('button','button_info','signinForm__submit');
    }
}