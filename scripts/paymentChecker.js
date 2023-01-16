const card = document.getElementById('n-carta');
const expireDate = document.getElementById('scadenza');

function cardNumberIsValid() {
    let cardv = card.value;
    const mastercard = /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/;
    const visa = /^4[0-9]{12}(?:[0-9]{3})?$/;
    const amex = /^3[47][0-9]{13}$/;
    if (cardv.value.match(mastercard) || cardv.value.match(visa) || cardv.value.match(amex)) {
        return true;
    }
    else {
        alert("Inserisci un numero valido");
        return false;
    }
}

function dateIsValid() {
    let expireDatev = expireDate.value.getDate();
    const today = new Date();
    if (expireDatev > today.getDate()) {
        alert('La carta di credito &egrave scaduta');
        return false;
    }
    return true;
}

card.addEventListener('focusout', cardNumberIsValid);
expireDate.addEventListener('focusout', dateIsValid);