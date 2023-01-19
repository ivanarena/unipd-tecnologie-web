let date1 = document.getElementById("data-inizio-evento").value;
let date2 = document.getElementById("data-fine-evento").value;

let d1 = Date.parse(date1);
let d2 = Date.parse(date2);

function checkDate() {
    if(d1 > d2){
        document.getElementById("dateErr").classList.add('hide');
        return true;
    }
    else {
        document.getElementById("dateErr").classList.remove('hide');
        return false;
    }
}
;