// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing dark mode');
    
    // Get the toggle elements (delay slightly to ensure mobile menu elements are accessible)
    setTimeout(function() {
        initializeDarkMode();
    }, 100);
    
    function initializeDarkMode() {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
        const htmlElement = document.documentElement;
        
        console.log('Toggle elements found:', {
            desktop: darkModeToggle !== null,
            mobile: darkModeToggleMobile !== null
        });
        
        // Function to apply dark mode
        function applyDarkMode(isDark) {
            console.log('Applying dark mode:', isDark);
            if (isDark) {
                htmlElement.classList.add('dark');
                document.body.classList.add('dark-mode');
                if (darkModeToggle) darkModeToggle.checked = true;
                if (darkModeToggleMobile) darkModeToggleMobile.checked = true;
                localStorage.setItem('darkMode', 'true');
                console.log('Dark mode enabled - classes added', {
                    htmlHasDarkClass: htmlElement.classList.contains('dark'),
                    bodyHasDarkModeClass: document.body.classList.contains('dark-mode')
                });
            } else {
                htmlElement.classList.remove('dark');
                document.body.classList.remove('dark-mode');
                if (darkModeToggle) darkModeToggle.checked = false;
                if (darkModeToggleMobile) darkModeToggleMobile.checked = false;
                localStorage.setItem('darkMode', 'false');
                console.log('Light mode enabled - classes removed', {
                    htmlHasDarkClass: htmlElement.classList.contains('dark'),
                    bodyHasDarkModeClass: document.body.classList.contains('dark-mode')
                });
            }
        }
        
        // Check system preference for dark mode
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        console.log('System prefers dark mode:', prefersDarkScheme.matches);
        
        // Check if dark mode is enabled in localStorage or use system preference
        const storedPreference = localStorage.getItem('darkMode');
        console.log('Stored preference:', storedPreference);
        
        const isDarkMode = storedPreference === 'true' || 
                        (storedPreference === null && prefersDarkScheme.matches);
        
        console.log('Initial dark mode state:', isDarkMode);
        
        // Set initial state
        applyDarkMode(isDarkMode);
        
        // Add event listeners to toggle switches
        if (darkModeToggle) {
            darkModeToggle.addEventListener('change', function() {
                console.log('Desktop toggle changed:', this.checked);
                applyDarkMode(this.checked);
            });
        }
        
        if (darkModeToggleMobile) {
            darkModeToggleMobile.addEventListener('change', function() {
                console.log('Mobile toggle changed:', this.checked);
                applyDarkMode(this.checked);
            });
        }
        
        // Listen for system preference changes
        prefersDarkScheme.addEventListener('change', function(e) {
            console.log('System preference changed:', e.matches);
            if (localStorage.getItem('darkMode') === null) {
                applyDarkMode(e.matches);
            }
        });
    }
}); 