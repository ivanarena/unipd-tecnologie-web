let current = document.getElementsByClassName("breadcrumb")[0].innerText;


if(current == "Home"){
    var d = document.getElementsByClassName("page")[0];
    d.removeAttribute("href");  
}

if(current == "Abbonamenti"){
    var d = document.getElementsByClassName("page")[1];
    d.removeAttribute("href");  
}

if(current == "Locali"){
    var d = document.getElementsByClassName("page")[2];
    d.removeAttribute("href");  
}

if(current == "Eventi"){
    var d = document.getElementsByClassName("page")[3];
    d.removeAttribute("href");  
}

if(current == "Chi siamo"){
    var d = document.getElementsByClassName("page")[4];
    d.removeAttribute("href");  
}

if(current == "Contatti"){
    var d = document.getElementsByClassName("page")[5];
    d.removeAttribute("href");
}

