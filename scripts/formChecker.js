const sendButton = document.getElementById('invia-messaggio');
let sname = document.getElementById("nome").value;
let surname = document.getElementById("cognome").value;
let email = document.getElementById("email").value;
let message = document.getElementById("msg").value;


function checkName() {
    sname = document.getElementById("nome").value;
    if (sname == "") {

        return false;
    }
    else if (sname.length > 50) {

        return false;
    }
    else {
        return true;
    }
}

function checkSurname() {
    surname = document.getElementById("cognome").value;
    if (surname == "") {

        return false;
    }
    else if (surname.length > 50) {

        return false;
    }
    else {
        return true; s
    }
}

function checkEmail() {
    email = document.getElementById("email").value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true;
    }
    else {

        return false;
    }
}

function checkMessage() {
    message = document.getElementById("msg").value;
    if (message == "") {

        return false;
    }
    else {
        return true;
    }
}

function checkForm() {
    if (checkName() && checkSurname() && checkEmail() && checkMessage()) {
    }
}



sendButton.addEventListener('click', checkForm);