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
        document.getElementById("nameErr").classList.remove('hide');
        return false;
    }
    else if (snamev.length > 50) {
        document.getElementById("nameErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("nameErr").classList.add('hide');
        return true;
    }
}

function checkSurname() {
    let surnamev = surname.value;
    if (surnamev == "") {
        document.getElementById("surnameErr").classList.remove('hide');
        return false;
    }
    else if (surnamev.length > 50) {
        document.getElementById("surnameErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("surnameErr").classList.add('hide');
        return true; 
    }
}

function checkUsername() {
    let usernamev = userName.value;
    if (usernamev == "") {
        document.getElementById("usernameErr").classList.remove('hide');
        return false;
    }
    else if (usernamev.length > 20) {
        document.getElementById("usernameErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("usernameErr").classList.add('hide');
        return true;
    }
}

function checkEmail() {
    let emailv = email.value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailv)) {
        document.getElementById("emailErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("emailErr").classList.remove('hide');
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
        document.getElementById("dateErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("dateErr").classList.remove('hide');
        return false;
    }
}

function checkPassword() {
    let passwordv = password.value;
    if (passwordv == "") {
        document.getElementById("passErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("passErr").classList.add('hide');
        return true;
    }
}

function checkEqualPassword() {
    let password2v = password2.value;
    if (password2v == password.value) {
        document.getElementById("pass2Err").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("pass2Err").classList.remove('hide');
        return false;
    }
}

/*function checkForm() {
    if (checkUsername() && checkPassword() && checkName() && checkSurname() && checkDataNascita() && checkEqualPassword() && checkEmail()) {

    }
}*/

function showPassword() {
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
