const loginButton = document.getElementById('accedi');
const showPasswordButton = document.getElementById('mostra-password');
const passwordInput = document.getElementById("password");

let userName = document.getElementById('username');
let password = document.getElementById("password");


function checkUsername() {
    let userNamev = userName.value;
    if (userNamev == "") {
        document.getElementById("usernameErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("usernameErr").classList.add('hide');
        return true;
    }
}

function checkPassword() {
    let passwordv = password.value;
    if (passwordv == "") {
        document.getElementById("passwordErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("passwordErr").classList.add('hide');
        return true;
    }
}

function checkForm() {
    if (checkUsername() && checkPassword()) {
        document.getElementById("formErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("formErr").classList.remove('hide');
    }
}

function showPassword() {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

loginButton.addEventListener('click', checkForm);
showPasswordButton.addEventListener('change', showPassword);
userName.addEventListener('focusout', checkUsername);
password.addEventListener('focusout', checkPassword);