let date1 = document.getElementById("data-inizio-evento").value;
let date2 = document.getElementById("data-fine-evento").value;

function checkDate() {
    if(date1.getDate() > date2.getDate()){
        document.getElementById("dateErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("dateErr").classList.remove('hide');
        return false;
    }
}
;