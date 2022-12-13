const menuToggle = document.getElementById('mobile-menu');
const pagesMenu = document.getElementById('menu-nav');
const userMenu = document.getElementById('user-menu-nav');
const breadcrumb = document.getElementById('breadcrumb-nav');
const sanJunipero = document.getElementById('san-junipero');

const mobile = window.matchMedia("(max-width: 1400px)");
// const desktop = window.matchMedia("(min-width: 729px)");

const toHide = [sanJunipero, pagesMenu, userMenu];

function mobileViewToggle() {
    console.log('pasta')
    if (mobile.matches) {
        menuToggle.classList.toggle('hide');
        hideElements();
    }
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
// window.addEventListener('resize', mobileViewToggle, true);