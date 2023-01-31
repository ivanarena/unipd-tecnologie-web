const darkModeSwitch = document.getElementById('dark-mode-switch');


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
        body.classList.add("dark");
    } else {
        localStorage.prefersDark = false;
        body.classList.remove("dark");
    }
    console.log(localStorage.prefersDark);
}


darkModeSwitch.addEventListener('change', toggleDarkMode);