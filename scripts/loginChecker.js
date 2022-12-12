const loginButton = document.getElementById('accedi');
let userName = document.getElementById('username').value; 
let password = document.getElementById("password").value;  

function checkUsername() {
    userName = document.getElementById('username').value; 
    if(userName == "") {   
        alert("Inserisci il Nome Utente");  
        return false;  
    }
    else {
        return true;
    }  
    console.log('username ok');
}

function checkPassword() { 
    password = document.getElementById("password").value; 
    if(password == "") {   
        alert("Inserisci la password");  
        return false;  
    }  
    else {  
        alert("La password è corretta");  
    }  
    console.log('password ok');
}

function checkForm() {
    if (checkUsername() && checkPassword()) {
        console.log('ok');
    }
    else if (!checkUsername() && checkPassword()) {
        alert('Inserire un Nome Utente Valido');
    }
    else {
        alert('Inserire una Password')
    }
    console.log('bottone premuto');
}

loginButton.addEventListener('click', checkForm);