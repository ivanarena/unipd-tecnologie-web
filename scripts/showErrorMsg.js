const errorMsgs = document.getElementsByClassName('error-msg');
const subscribeBtn = document.getElementsByClassName('unsubscribe-btn');
const bookingBtn = document.getElementsByClassName('booking-btn');

function showMsg(e) {
    e.currentTarget.previousElementSibling.classList.remove('hide');
}

for (let i = 0; i < subscribeBtn.length; i++) {
    subscribeBtn[i].addEventListener('click', showMsg);
}
for (let i = 0; i < bookingBtn.length; i++) {
    bookingBtn[i].addEventListener('click', showMsg);
}
