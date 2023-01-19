let date1 = document.getElementById("data-inizio-evento");
let date2 = document.getElementById("data-fine-evento");


function checkDate() {
    let d1 = date1.value;
    let d2 = date2.value;
    var inizioEv = new Date(d1);
    var fineEv = new Date(d2);
    if ((inizioEv.getFullYear() > fineEv.getFullYear()) && (inizioEv.getMonth() > fineEv.getMonth()) && (inizioEv.getDay() > fineEv.getDay())){
        document.getElementById("dateErr").classList.add('hide');;
        return false;
    }
    else {
        document.getElementById("dateErr").classList.remove('hide');
        return true;
    }
}

date1.addEventListener('focusout', checkDate);
date2.addEventListener('focusout', checkDate);
