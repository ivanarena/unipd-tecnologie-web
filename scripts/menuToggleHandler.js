const menuToggle = document.getElementById('mobile-menu');
const pagesMenu = document.getElementById('menu-nav');
const userMenu = document.getElementById('user-menu-nav');
const breadcrumb = document.getElementById('breadcrumb-nav');
const sanJunipero = document.getElementById('san-junipero');
const sanJuniperoLogo = document.getElementById('san-junipero-logo');
const darkModeToggle = document.getElementById('dark-mode-toggle')

const mobile = window.matchMedia("(max-width: 1400px)");
// const desktop = window.matchMedia("(min-width: 729px)");

const toHide = [sanJunipero, pagesMenu, userMenu];
const toFix = [sanJuniperoLogo, menuToggle];

let mobileToggled = false;
if (mobile.matches) {
    mobileToggled = true;
    menuToggle.classList.toggle('hide');
    toggleHideElements();
}

function mobileViewToggle() {
    if (mobile.matches && !mobileToggled) {
        mobileToggled = true;
        menuToggle.classList.toggle('hide');
        toggleHideElements();
    } else if (!mobile.matches && mobileToggled) {
        mobileToggled = false;
        menuToggle.classList.toggle('hide');
        toggleHideElements();
    }
}


function toggleMenu() {
    menuToggle.classList.toggle('is-active');
    pagesMenu.classList.toggle('hide');
    pagesMenu.classList.toggle('menu-is-mobile');
    userMenu.classList.toggle('hide');
    userMenu.classList.toggle('user-menu-is-mobile');
    breadcrumb.classList.toggle('hide');
    darkModeToggle.classList.toggle('hide');
    menuToggle.classList.toggle('fix-toggle');
    toFix.forEach(x => x.classList.toggle('fixate'));
}


function toggleHideElements() {
    toHide.forEach(x => x.classList.toggle('hide'));
}

menuToggle.addEventListener('click', toggleMenu);
window.addEventListener('resize', mobileViewToggle, true);