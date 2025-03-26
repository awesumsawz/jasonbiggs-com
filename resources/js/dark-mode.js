// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the toggle elements (delay slightly to ensure mobile menu elements are accessible)
    setTimeout(function() {
        initializeDarkMode();
    }, 100);
    
    function initializeDarkMode() {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
        const htmlElement = document.documentElement;
        
        // Function to apply dark mode
        function applyDarkMode(isDark) {
            if (isDark) {
                htmlElement.classList.add('dark');
                document.body.classList.add('dark-mode');
                if (darkModeToggle) darkModeToggle.checked = true;
                if (darkModeToggleMobile) darkModeToggleMobile.checked = true;
                localStorage.setItem('darkMode', 'true');
            } else {
                htmlElement.classList.remove('dark');
                document.body.classList.remove('dark-mode');
                if (darkModeToggle) darkModeToggle.checked = false;
                if (darkModeToggleMobile) darkModeToggleMobile.checked = false;
                localStorage.setItem('darkMode', 'false');
            }
        }
        
        // Check system preference for dark mode
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        
        // Check if dark mode is enabled in localStorage or use system preference
        const storedPreference = localStorage.getItem('darkMode');
        
        const isDarkMode = storedPreference === 'true' || 
                        (storedPreference === null && prefersDarkScheme.matches);
        
        // Set initial state
        applyDarkMode(isDarkMode);
        
        // Add event listeners to toggle switches - Only if they exist
        if (darkModeToggle) {
            darkModeToggle.addEventListener('change', function() {
                applyDarkMode(this.checked);
            });
        }
        
        if (darkModeToggleMobile) {
            darkModeToggleMobile.addEventListener('change', function() {
                applyDarkMode(this.checked);
            });
        }
        
        // Listen for system preference changes
        prefersDarkScheme.addEventListener('change', function(e) {
            if (localStorage.getItem('darkMode') === null) {
                applyDarkMode(e.matches);
            }
        });
    }
}); 