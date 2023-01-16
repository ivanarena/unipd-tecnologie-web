let card = document.getElementById('n-carta');
let expireDate = document.getElementById('scadenza');


function cardNumberIsValid() {
    let cardv = card.value;
    const mastercard = /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/;
    const visa = /^4[0-9]{12}(?:[0-9]{3})?$/;
    const amex = /^3[47][0-9]{13}$/;
    if (cardv.match(mastercard) || cardv.match(visa) || cardv.match(amex)) {
        document.getElementById("cardErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("cardErr").classList.remove('hide');
        return false;
    }
}

function dateIsValid() {
    let expireDatev = expireDate.value;
    const today = new Date();
    // console.log(today); 
    if ((new Date(expireDate.value)).getTime() < today.getTime()) { 
        document.getElementById("dateErr").classList.remove('hide');
        return false;
    }
    document.getElementById("dateErr").classList.add('hide');
    return true;
}

card.addEventListener('focusout', cardNumberIsValid);
expireDate.addEventListener('focusout', dateIsValid);