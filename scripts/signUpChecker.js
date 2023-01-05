const signUpButton = document.getElementById('registrati');
const showPasswordButton = document.getElementById('mostra-password');
const passwordInput = document.getElementById("password");
const passwordRepeatInput = document.getElementById("password-repeat");

let userName = document.getElementById('username');
let password = document.getElementById("password").value;
let sname = document.getElementById("nome").value;
let surname = document.getElementById("cognome").value;
let dateOfBirth = document.getElementById("data").value;
let password2 = document.getElementById("password-repeat").value;
let email = document.getElementById("email").value;

function checkName() {
    sname = document.getElementById("nome").value;
    if (sname == "") {
        alert("Inserisci il tuo nome");
        return false;
    }
    else if (sname.length > 50) {
        alert("Inserisci un nome valido");
        return false;
    }
    else {
        return true;
        console.log('nome ok');
    }
}

function checkSurname() {
    surname = document.getElementById("cognome").value;
    if (surname == "") {
        alert("Inserisci il tuo cognome");
        return false;
    }
    else if (surname.length > 50) {
        alert("Inserisci un cognome valido");
        return false;
    }
    else {
        return true; s
        console.log('cognome ok');
    }
}

function checkUsername() {
    let usernamev = userName.value;
    if (usernamev == "") {
        document.getElementById("usernameErr").innerHTML = "Inserisci un nome utente";
        return false;
    }
    else if (usernamev.length > 20) {
        alert("Il nome utente deve avere massimo 20 caratteri");
        return false;
    }
    else {
        document.getElementById("usernameErr").innerHTML = "";
        return true;
        console.log('username ok');
    }
}

function checkEmail() {
    email = document.getElementById("email").value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true;
    }
    else {
        alert("Indirizzo email non valido, riprova");
        return false;
    }
}

function checkDataNascita() {
    dateOfBirth = document.getElementById("data").value;
    var today = new Date();
    var birthDate = new Date(dateOfBirth);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    console.log(age);
    if (age > 17) {
        return true;
        console.log('data ok');
    }
    else {
        alert('Ci dispiace, questo servizio è riservato ai maggiorenni!')
        return false;
    }
}

function checkPassword() {
    password = document.getElementById("password").value;
    if (password == "") {
        alert("Inserisci la password");
        return false;
    }
    else if (password.length < 8) {
        alert("La password deve essere lunga almeno 8 caratteri");
        return false;
    }
    else if (password.length > 50) {
        alert("La password non può essere più lunga di 15 caratteri");
        return false;
    }
    else {
        alert("La password è corretta");
        return true;
        console.log('password ok');
    }
}

function checkEqualPassword() {
    password2 = document.getElementById("password-repeat").value;
    if (password == password2) {
        return true;
        console.log('password2 ok');
    }
    else {
        alert("La password inserita non corrisponde alla precendente. Riprova");
        return false;
    }
}

function checkForm() {
    if (checkUsername() && checkPassword() && checkName() && checkSurname() && checkDataNascita() && checkEqualPassword() && checkEmail()) {
        console.log('ok');
    }
    console.log('bottone premuto');
}

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
userName.addEventListener('focusout', checkUsername);