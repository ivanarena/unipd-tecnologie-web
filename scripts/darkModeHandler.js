const darkModeSwitch = document.getElementById('dark-mode-switch');
const darkModeLink = document.createElement("link");
darkModeLink.type = "text/css";
darkModeLink.rel = "stylesheet";
darkModeLink.href = '/styles/dark-mode.css';

// cambiare con dark -- sto usando questo per testare
let prefersDark = window.matchMedia("(prefers-color-scheme: light)").matches;

if (prefersDark && !darkModeSwitch.checked) {
    darkModeSwitch.checked = true;
    toggleDarkMode();
}

function toggleDarkMode() {
    let head = document.getElementsByTagName("head")[0];
    if (darkModeSwitch.checked) {
        head.appendChild(darkModeLink);
    } else {

        head.removeChild(darkModeLink);
    }
}


darkModeSwitch.addEventListener('change', toggleDarkMode);