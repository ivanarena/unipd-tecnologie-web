let card = document.getElementById('n-carta');
let expireDate = document.getElementById('scadenza');
let cvv = document.getElementById('ccv');
let intestatario = document.getElementById('intestatario');
const purchaseButton = document.getElementById('acquista');
const form = document.getElementById('payment-form');


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

function ccvIsValid() {
    let cvvv = cvv.value;
    if (cvvv.match(/^[0-9]{3}$/)) {
        document.getElementById("cvvErr").classList.add('hide')
        return true;
    }
    else {
        document.getElementById("cvvErr").classList.remove('hide')
        return false;
    }
}

function intestatarioIsValid() {
    let intestatariov = intestatario.value;
    if (!intestatariov.match(/^\w+/)) {
        document.getElementById("intestatarioErr").classList.remove('hide');
        return false;
    }
    else {
        document.getElementById("intestatarioErr").classList.add('hide');
        return true;
    }
}

function dateIsValid() {
    let expireDatev = expireDate.value;
    const today = new Date();
    if ((new Date(expireDate.value)).getTime() < today.getTime()) {
        document.getElementById("dateErr").classList.remove('hide');
        return false;
    }
    document.getElementById("dateErr").classList.add('hide');
    return true;
}


function checkForm(e) {
    e.preventDefault();
    if (cardNumberIsValid() && dateIsValid() && ccvIsValid() && intestatarioIsValid()) {
        document.getElementById("formErr").classList.add('hide');
        console.log(document.forms["payment-form"]);
        document.forms["payment-form"].submit();
    }
    else {
        document.getElementById("formErr").classList.remove('hide');
        return false;
    }
}

card.addEventListener('focusout', cardNumberIsValid);
expireDate.addEventListener('focusout', dateIsValid);
ccv.addEventListener('focusout', ccvIsValid);
intestatario.addEventListener('focusout', intestatarioIsValid);
purchaseButton.addEventListener('click', checkForm);