let menuToggle = document.getElementById('mobile-menu');
let pagesMenu = document.getElementById('menu-nav');
let userMenu = document.getElementById('user-menu-nav');

function toggleMenu() {
    menuToggle.classList.toggle('is-active');
    console.log(menuToggle);
    console.log(pagesMenu);
    console.log(userMenu);
}

addEventListener('click', toggleMenu);