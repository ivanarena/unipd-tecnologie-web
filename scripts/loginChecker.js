const loginButton = document.getElementById('accedi');

function checkEmail() {

    console.log('email ok');
}

function checkPassword() {

    console.log('password ok');
}



function checkForm() {
    if (checkEmail() && checkPassword()) {
        console.log('ok');

    }
    console.log('bottone premuto');
}

loginButton.addEventListener('click', checkForm);