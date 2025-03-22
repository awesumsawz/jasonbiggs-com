<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title ?? 'One A Day' }}</title>
        
        <!-- Early light/dark mode script to prevent flash -->
        <script id="theme-check">
            // Immediately apply dark mode if needed
            const darkMode = localStorage.getItem('darkMode') === 'true' || 
                            (localStorage.getItem('darkMode') === null && 
                             window.matchMedia('(prefers-color-scheme: dark)').matches);
            
            if (darkMode) {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark-mode');
            }
        </script>
        
        <!-- Immediate toggle script to ensure responsiveness -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggles = ['darkModeToggle', 'darkModeToggleMobile'];
                
                toggles.forEach(toggleId => {
                    const toggle = document.getElementById(toggleId);
                    if (toggle) {
                        // Set initial state
                        toggle.checked = document.documentElement.classList.contains('dark');
                        
                        // Add change listener
                        toggle.addEventListener('change', function() {
                            if (this.checked) {
                                document.documentElement.classList.add('dark');
                                document.body.classList.add('dark-mode');
                                localStorage.setItem('darkMode', 'true');
                            } else {
                                document.documentElement.classList.remove('dark');
                                document.body.classList.remove('dark-mode');
                                localStorage.setItem('darkMode', 'false');
                            }
                            
                            // Update other toggle
                            toggles.forEach(otherId => {
                                if (otherId !== toggleId) {
                                    const otherToggle = document.getElementById(otherId);
                                    if (otherToggle) {
                                        otherToggle.checked = this.checked;
                                    }
                                }
                            });
                        });
                    }
                });
            });
        </script>
        
        <meta name="description" content="{{ $description ?? 'One A Day Blog' }}">
        
		@vite([
			'resources/js/app.js', 
			'resources/js/dark-mode.js',
			'resources/css/app.css'
		])		
        
        <!-- Iconify for UI icons -->
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>		
	</head>
	<body class="min-h-screen">