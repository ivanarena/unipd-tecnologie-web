const errorMsgs = document.getElementsByClassName('error-msg');
const btns = document.getElementsByClassName('unsubscribe-btn');

function showMsg(e) {
    e.currentTarget.previousElementSibling.classList.toggle('hide');
}

for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', showMsg);
}