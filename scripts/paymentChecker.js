
function cardNumberIsValid() {
    const card = document.getElementById('n-carta');
    const mastercard = /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/;
    const visa = /^4[0-9]{12}(?:[0-9]{3})?$/;
    const amex = /^3[47][0-9]{13}$/;
    if (card.value.match(mastercard) || card.value.match(visa) || card.value.match(amex)) {
        return true;
    }
    else {
        alert("Please enter a valid credit card number.");
        return false;
    }
}

function dateIsValid() {
    let expireDate = document.getElementById('scadenza').value.getDate();
    const today = new Date();
    if (expireDate > today.getDate()) {
        alert('La carta di credito e'' scaduta');
        return false;
    }
    return true;
}

