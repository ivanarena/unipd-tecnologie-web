const sendButton = document.getElementById('invia-messaggio');
let sname =  document.getElementById("nome").value;
let surname =  document.getElementById("cognome").value;
let email = document.getElementById("email").value; 
let message =  document.getElementById("msg").value;

function checkName() {
    sname =  document.getElementById("nome").value;
    if(sname == "") {
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
    surname =  document.getElementById("cognome").value;
    if(surname == "") {
        alert("Inserisci il tuo cognome");
        return false;
    }
    else if (surname.length > 50) {
        alert("Inserisci un cognome valido");
        return false;
    }
    else {
        return true;s
        console.log('cognome ok');
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

function checkMessage() {
    message =  document.getElementById("msg").value;
    if(message == "") {
        alert("Lasciaci un messaggio!");
        return false;
    }
    else {
        return true;
        console.log('nome ok');
    }
}

function checkForum() {
    if (checkName() && checkSurname() && checkEmail() && checkMessage()) {
        console.log('ok');
    }
    console.log('bottone premuto');
}

sendButton.addEventListener('click', checkForm);