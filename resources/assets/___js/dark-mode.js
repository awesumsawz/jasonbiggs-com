document.addEventListener("DOMContentLoaded", () => {
    const toggles = document.querySelectorAll("#dark-mode-toggle-desktop, #dark-mode-toggle-mobile");
    const html = document.documentElement;

    // Initialize toggle state based on localStorage or system preference
    if (localStorage.getItem("theme") === "dark" || 
        (!localStorage.getItem("theme") && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        html.classList.add("dark");
        toggles.forEach(toggle => toggle.checked = true);
    } else {
        html.classList.remove("dark");
        toggles.forEach(toggle => toggle.checked = false);
    }

    toggles.forEach(toggle => {
        toggle.addEventListener("change", () => {
            if (toggle.checked) {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
                // Sync other toggles
                toggles.forEach(t => t.checked = true);
            } else {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
                // Sync other toggles
                toggles.forEach(t => t.checked = false);
            }
        });
    });
    
    // Add mobile menu toggle functionality
    const mobileMenu = document.getElementById("mobile-menu");
    const toggleMobileMenu = (element) => {
        mobileMenu.classList.toggle("is-active");
        document.body.classList.toggle("overflow-hidden");
    };
    
    // Make the toggleMobileMenu function available globally
    window.toggleMobileMenu = toggleMobileMenu;
});