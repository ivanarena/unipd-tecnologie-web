const loginButton = document.getElementById('accedi');
const showPasswordButton = document.getElementById('mostra-password');
const passwordInput = document.getElementById("password");
let userName = "";
let password = "";



function printError(ElementId, result, errMessage) {
    if (!result) {
        ElementId.innerHTML = errMessage;
    } else {
        document.getElementById(ElementId).innerHTML = "";
    }
}

function checkUsername() {
    userName = document.getElementById('username').value;
    if (userName == "") {
        printError(document.getElementById('username'), true, "Inserisci il Nome Utente");
        return false;
    }
    else {
        return true;
    }
    console.log('username ok');
}

function checkPassword() {
    password = document.getElementById("password").value;
    if (password == "") {
        return false;
    }
    else {
        return true;
    }
    console.log('password ok');
}

function checkForm() {
    if (checkUsername() && checkPassword()) {
        console.log('ok');
    }
    console.log('bottone premuto');
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
