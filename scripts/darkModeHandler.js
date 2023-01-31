const darkModeSwitch = document.getElementById('dark-mode-switch');
const darkModeLink = document.createElement("link");
darkModeLink.type = "text/css";
darkModeLink.rel = "stylesheet";
darkModeLink.href = './styles/dark-mode.css';

// cambiare con dark -- sto usando questo per testare

if (localStorage.prefersDark === undefined) {
    localStorage.setItem('prefersDark',
        window.matchMedia("(prefers-color-scheme: dark)").matches);
}

if (localStorage.prefersDark === "true" && darkModeSwitch.checked === false) {
    darkModeSwitch.checked = true;
    toggleDarkMode();
}

function toggleDarkMode() {
    let head = document.getElementsByTagName("head")[0];
    if (darkModeSwitch.checked) {
        localStorage.prefersDark = true;
        head.appendChild(darkModeLink);
    } else {
        localStorage.prefersDark = false;
        head.removeChild(darkModeLink);
    }
    console.log(localStorage.prefersDark);
}


darkModeSwitch.addEventListener('change', toggleDarkMode);