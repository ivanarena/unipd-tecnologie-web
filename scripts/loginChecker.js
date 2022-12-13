const loginButton = document.getElementById('accedi');
let userName = ""; 
let password = "";  

function printError(ElementId, result, errMessage) { 
	if (!result) {
		document.getElementById(ElementId).innerHTML = errMessage;
	} else {
		document.getElementById(ElementId).innerHTML = "";
	}
}

function checkUsername() {
    userName = document.getElementById('username').value; 
    if(userName == "") {   
        alert("Inserisci il Nome Utente");  
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
    if(password == "") {   
        alert("Inserisci la password");  
        return false;  
    }  
    else {  
        alert("La password è corretta");  
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

loginButton.addEventListener('click', checkForm);