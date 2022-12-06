let menuToggle = document.getElementById('mobile-menu');
let pagesMenu = document.getElementById('menu-nav');
let userMenu = document.getElementById('user-menu-nav');
let breadcrumb = document.getElementById('breadcrumb-nav');
let sanJunipero = document.getElementById('san-junipero');

const mobile = window.matchMedia("(max-width: 728px)");

let toHide = [sanJunipero, pagesMenu, userMenu];

if (mobile.matches) {
    hideElements();
}


function toggleMenu() {
    menuToggle.classList.toggle('is-active');
    pagesMenu.classList.toggle('hide');
    pagesMenu.classList.toggle('menu-is-mobile');
    userMenu.classList.toggle('hide');
    userMenu.classList.toggle('user-menu-is-mobile');
    breadcrumb.classList.toggle('hide');
}


function hideElements() {
    toHide.forEach(x => x.classList.add('hide'))
}

menuToggle.addEventListener('click', toggleMenu);