const signUpButton = document.getElementById('registrati');
const showPasswordButton = document.getElementById('mostra-password');
const passwordInput = document.getElementById("password");
const passwordRepeatInput = document.getElementById("password-repeat");

let userName = document.getElementById('username');
let password = document.getElementById("password");
let sname = document.getElementById("nome");
let surname = document.getElementById("cognome");
let dateOfBirth = document.getElementById("data");
let password2 = document.getElementById("password-repeat");
let email = document.getElementById("email");

function checkName() {
    let snamev = sname.value;
    if (snamev == "") {
        document.getElementById("nameErr").innerHTML = "Inserisci il tuo nome";
        return false;
    }
    else if (snamev.length > 50) {
        document.getElementById("nameErr").innerHTML = "Inserisci un nome valido";
        return false;
    }
    else {
        document.getElementById("nameErr").innerHTML = ""
        return true;
    }
}

function checkSurname() {
    let surnamev = surname.value;
    if (surnamev == "") {
        document.getElementById("surnameErr").innerHTML = "Inserisci il tuo cognome";
        return false;
    }
    else if (surnamev.length > 50) {
        document.getElementById("surnameErr").innerHTML = "Inserisci un cognome valido";
        return false;
    }
    else {
        document.getElementById("surnameErr").innerHTML = ""
        return true; 
    }
}

function checkUsername() {
    let usernamev = userName.value;
    if (usernamev == "") {
        document.getElementById("usernameErr").innerHTML = "Inserisci un nome utente";
        return false;
    }
    else if (usernamev.length > 20) {
        document.getElementById("usernameErr").innerHTML = "Il nome utente deve avere massimo 20 caratteri";
        return false;
    }
    else {
        document.getElementById("usernameErr").innerHTML = "";
        return true;
    }
}

function checkEmail() {
    let emailv = email.value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailv)) {
        document.getElementById("emailErr").innerHTML = ""
        return true;
    }
    else {
        document.getElementById("emailErr").innerHTML = "Indirizzo email non valido, riprova";
        return false;
    }
}

function checkDataNascita() {
    let dateOfBirthv = dateOfBirth.value;
    var today = new Date();
    var birthDate = new Date(dateOfBirthv);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age > 17) {
        document.getElementById("dateErr").innerHTML = "";
        return true;
    }
    else {
        document.getElementById("dateErr").innerHTML = "Questo servizio è riservato ai maggiorenni!";
        return false;
    }
}

function checkPassword() {
    let passwordv = password.value;
    if (passwordv == "") {
        document.getElementById("passErr").innerHTML = "Inserisci la password";
        return false;
    }
    else if (passwordv.length < 8) {
        return false;
    }
    else if (passwordv.length > 50) {
        document.getElementById("passErr").innerHTML = "La password non può essere più lunga di 15 caratteri";
        return false;
    }
    else {
        return true;
    }
}

function checkEqualPassword() {
    let password2v = password2.value;
    if (password2v == password2) {
        document.getElementById("pass2Err").innerHTML = "";
        return true;
    }
    else {
        document.getElementById("pass2Err").innerHTML = "La password non corrisponde";
        return false;
    }
}

/*function checkForm() {
    if (checkUsername() && checkPassword() && checkName() && checkSurname() && checkDataNascita() && checkEqualPassword() && checkEmail()) {

    }
}*/

function showPassword() {
    console.log(passwordInput)
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordRepeatInput.type = "text";
    } else {
        passwordInput.type = "password";
        passwordRepeatInput.type = "password";
    }
}

showPasswordButton.addEventListener('change', showPassword);
//signUpButton.addEventListener('onclick', checkForm);
userName.addEventListener('focusout', checkUsername);
sname.addEventListener('focusout', checkName);
surname.addEventListener('focusout', checkSurname);
email.addEventListener('focusout', checkEmail);
dateOfBirth.addEventListener('focusout', checkDataNascita);
password.addEventListener('focusout', checkPassword);
password2.addEventListener('focusout', checkEqualPassword);
