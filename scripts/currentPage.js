let current = document.getElementsByClassName("breadcrumb")[0].innerText;


if(current == "Home"){
    var d = document.getElementsByClassName("page")[0];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}
if(current == "Abbonamenti"){
    var d = document.getElementsByClassName("page")[1];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}
if(current == "Locali"){
    var d = document.getElementsByClassName("page")[2];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}
if(current == "Eventi"){
    var d = document.getElementsByClassName("page")[3];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}
if(current == "Chi siamo"){
    var d = document.getElementsByClassName("page")[4];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}
if(current == "Contatti"){
    var d = document.getElementsByClassName("page")[5];
    d.className += " current-page";
    var cont = document.getElementsByTagName("main")[0];
    cont.setAttribute("id", "contenuto");
}