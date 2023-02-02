const sendButton = document.getElementById('invia-messaggio');
let sname = document.getElementById("nome");
let surname = document.getElementById("cognome");
let email = document.getElementById("email");
let message = document.getElementById("msg");


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
        document.getElementById("cognomeErr").classList.remove('hide');
        return false;
    }
    else if (surnamev.length > 50) {
        document.getElementById("cognomeErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("cognomeErr").classList.add('hide');
        return true;
    }
}

function checkEmail() {
    let semail = email.value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(semail)) {
        document.getElementById("emailErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("emailErr").classList.remove('hide');
        return false;
    }
}

function checkMessage() {
    let smessage = message.value;
    if (smessage == "") {
        document.getElementById("messageErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("messageErr").classList.add('hide');
        return true;
    }
}

function checkForm() {
    if (checkName() && checkSurname() && checkEmail() && checkMessage()) {
    }
}



sendButton.addEventListener('click', checkForm);
sname.addEventListener('focusout', checkName);
surname.addEventListener('focusout', checkSurname);
email.addEventListener('focusout', checkEmail);
message.addEventListener('focusout', checkMessage);
