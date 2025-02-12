document.addEventListener("DOMContentLoaded", () => {
    const toggles = document.querySelectorAll(".dark-mode-toggle");
    const html = document.documentElement;

    // Initialize toggle state based on localStorage
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark-mode");
        toggles.forEach(toggle => toggle.checked = true);
    }

    toggles.forEach(toggle => {
        toggle.addEventListener("change", () => {
            if (toggle.checked) {
                html.classList.add("dark-mode");
                localStorage.setItem("theme", "dark");
                // Sync other toggles
                toggles.forEach(t => t.checked = true);
            } else {
                html.classList.remove("dark-mode");
                localStorage.setItem("theme", "light");
                // Sync other toggles
                toggles.forEach(t => t.checked = false);
            }
        });
    });
});