let date1 = document.getElementById("data-inizio-evento").value;
let date2 = document.getElementById("data-fine-evento").value;

function checkDate() {
    if(date1.getDate() > date2.getDate()){
        alert("La data di fine evento non può essere prima dell'inizio dell'evento")
    }
}