const loginButton = document.getElementById('accedi');
const showPasswordButton = document.getElementById('mostra-password');
const passwordInput = document.getElementById("password");

let userName = document.getElementById('username').value;
let password = document.getElementById("password").value;


/*function printError(ElementId, result, errMessage) {
    if (!result) {
        ElementId.innerHTML = errMessage;
    } else {
        document.getElementById(ElementId).innerHTML = "";
    }
}*/

function checkUsername() {
    let userNamev = userName.value;
    if (userNamev == "") {
        document.getElementById("usernameErr").innerHTML = "Inserisci il tuo nome utente";
        return false;
    }
    else {
        return true;
    }
}

function checkPassword() {
    let passwordv = password.value;
    if (passwordv == "") {
        document.getElementById("passwordErr").innerHTML = "Inserisci la password";
        return false;
    }
    else {
        return true;
    }
}

function checkForm() {
    if (checkUsername() && checkPassword()) {
        return true;
    }
    else{
        document.getElementById("formErr").innerHTML = "O il nome utente o la password sono scorretti";
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