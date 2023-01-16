let card = document.getElementById('n-carta');
let expireDate = document.getElementById('scadenza');


function cardNumberIsValid() {
    let cardv = card.value;
    const mastercard = /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/;
    const visa = /^4[0-9]{12}(?:[0-9]{3})?$/;
    const amex = /^3[47][0-9]{13}$/;
    if (cardv.match(mastercard) || cardv.match(visa) || cardv.match(amex)) {
        return true;
    }
    else {
        alert("Inserisci un numero valido");
        return false;
    }
}

function dateIsValid() {
    let expireDatev = expireDate.value;
    const today = new Date();
    // console.log(today); 
    if (expireDatev > today.getDate()) { // getDate e' sbagliato, googla come trovare la data in formato giusto
        alert('La carta di credito &egrave scaduta');
        return false;
    }
    return true;
}

card.addEventListener('focusout', cardNumberIsValid);
expireDate.addEventListener('focusout', dateIsValid);