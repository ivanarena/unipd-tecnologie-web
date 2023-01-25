const menuToggle = document.getElementById('mobile-menu');
const pagesMenu = document.getElementById('menu-nav');
const userMenu = document.getElementById('user-menu-nav');
const breadcrumb = document.getElementById('breadcrumb-nav');
const sanJunipero = document.getElementById('san-junipero');
const sanJuniperoLogo = document.getElementById('san-junipero-logo');
const darkModeToggle = document.getElementById('dark-mode-toggle')

const mobile = window.matchMedia("(max-width: 1300px)");
// const smallDesktop = window.matchMedia("(max-width: 1500px)");
// const desktop = window.matchMedia("(min-width: 729px)");

const toHide = [pagesMenu, userMenu];
const toFix = [sanJuniperoLogo, menuToggle];

let mobileToggled = false;
if (mobile.matches) {
    menuToggle.classList.toggle('hide');
    mobileToggled = true;
}

function mobileViewToggle() {
    if (mobile.matches && !mobileToggled) {
        mobileToggled = true;
        menuToggle.classList.toggle('hide');
    } else if (!mobile.matches && mobileToggled) {
        mobileToggled = false;
        menuToggle.classList.toggle('hide');

    }
}



function toggleMenu() {
    menuToggle.classList.toggle('is-active');
    pagesMenu.classList.toggle('menu-is-mobile');
    userMenu.classList.toggle('user-menu-is-mobile');
}

menuToggle.addEventListener('click', toggleMenu);
window.addEventListener('resize', mobileViewToggle, true);

document.querySelectorAll('div[role="button"]').forEach(el => {
    el.addEventListener('keydown', e => {
        const keyDown = e.key !== undefined ? e.key : e.keyCode;
        if ((keyDown === 'Enter' || keyDown === 13) || (['Spacebar', ' '].indexOf(keyDown) >= 0 || keyDown === 32)) {
            // (prevent default so the page doesn't scroll when pressing space)
            e.preventDefault();
            el.click();
        }
    });
});