<header id="main-menu" class="navbar">
  {{-- Secondary navigation section - commented out
  <section class="menu secondary desktop-view">
    <ul>
      <li class="form-check desktop">
        <div class="toggle-icons">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.995 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007-2.246-5.007-5.007-5.007S6.995 9.239 6.995 12zM11 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2H2zm17 0h3v2h-3zM5.637 19.778l-1.414-1.414 2.121-2.121 1.414 1.414zM16.242 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.344 7.759 4.223 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"></path></svg>
        </div>
        <input type="checkbox" id="darkModeToggle" class="form-check-input">
        <label for="darkModeToggle" class="form-check-label"></label>
        <div class="toggle-icons">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 11.807A9.002 9.002 0 0 1 10.049 2a9.942 9.942 0 0 0-5.12 2.735c-3.905 3.905-3.905 10.237 0 14.142 3.906 3.906 10.237 3.905 14.143 0a9.946 9.946 0 0 0 2.735-5.119A9.003 9.003 0 0 1 12 11.807z"></path></svg>
        </div>
      </li>
      @include('components.nav.secondary')
    </ul>
  </section>
  --}}

  <!-- Add dark mode toggle to main menu since we removed secondary nav -->
  <section class="dark-mode-toggle desktop-view">
    <li class="form-check desktop">
      <div class="toggle-icons">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.995 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007-2.246-5.007-5.007-5.007S6.995 9.239 6.995 12zM11 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2H2zm17 0h3v2h-3zM5.637 19.778l-1.414-1.414 2.121-2.121 1.414 1.414zM16.242 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.344 7.759 4.223 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"></path></svg>
      </div>
      <input type="checkbox" id="darkModeToggle" class="form-check-input">
      <label for="darkModeToggle" class="form-check-label"></label>
      <div class="toggle-icons">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 11.807A9.002 9.002 0 0 1 10.049 2a9.942 9.942 0 0 0-5.12 2.735c-3.905 3.905-3.905 10.237 0 14.142 3.906 3.906 10.237 3.905 14.143 0a9.946 9.946 0 0 0 2.735-5.119A9.003 9.003 0 0 1 12 11.807z"></path></svg>
      </div>
    </li>
  </section>

  <section class="title">
    <a href="/">
      <div class="desktop-view">
        <img class="logo" src="{{ asset('images/logos/green-logowordmark-flat.png') }}" alt="combined logo" />
      </div>
      <div class="tablet-view">
        <img class="logo" src="{{ asset('images/logos/green-logowordmark-flat.png') }}" alt="graphic logo" />
      </div>
      <div class="mobile-view">
        <img class="logo" src="{{ asset('images/logos/green-logo.png') }}" alt="graphic logo" />
      </div>
    </a>
  </section>

  <section class="menu">
    <div class="desktop-view">
      @include('components.nav.primary')
    </div>
    <div class="tablet-view mobile-view menu-trigger">
      <button type="button" onclick="toggleMobileMenu()" class="menu-button" aria-label="Toggle mobile menu">
        <iconify-icon inline icon="ic:round-menu" width="32" height="32"></iconify-icon>
      </button>
    </div>
  </section>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; background-color: white; z-index: 9999; transform: translateX(100%); transition: transform 0.3s ease; display: flex; flex-direction: column; overflow: hidden;">
  <div style="display: flex; justify-content: flex-end; padding: 1rem;">
    <button type="button" onclick="toggleMobileMenu()" style="background: transparent; border: 0; padding: 0.5rem; cursor: pointer; font-size: 3rem;">
      <iconify-icon inline icon="ic:round-close" width="32" height="32"></iconify-icon>
    </button>
  </div>
  
  <div style="display: flex; flex-direction: column; align-items: center; flex-grow: 1; padding: 2rem; overflow-y: auto;">
    <div style="margin-bottom: 3rem;">
      <a href="/">
        <img src="{{ asset('images/logos/green-logowordmark-stacked.png') }}" alt="Logo" style="max-height: 8rem;" />
      </a>
    </div>
    
    <nav style="width: 100%; margin-bottom: 3rem;">
      <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; align-items: center; gap: 2rem;">
        <li style="width: 100%; text-align: center;"><a href="/" style="font-family: 'DDC Hardware', sans-serif; font-size: 2.4rem; color: #333; text-decoration: none; display: block;">Home</a></li>
        <li style="width: 100%; text-align: center;"><a href="/web" style="font-family: 'DDC Hardware', sans-serif; font-size: 2.4rem; color: #333; text-decoration: none; display: block;">Web</a></li>
        <li style="width: 100%; text-align: center;"><a href="/resume" style="font-family: 'DDC Hardware', sans-serif; font-size: 2.4rem; color: #333; text-decoration: none; display: block;">Resume</a></li>
        <li style="width: 100%; text-align: center;"><a href="/blog" style="font-family: 'DDC Hardware', sans-serif; font-size: 2.4rem; color: #333; text-decoration: none; display: block;">Blog</a></li>
      </ul>
    </nav>
    
    <div style="display: flex; justify-content: center; margin-top: 2rem;">
      <div class="form-check mobile">
        <div class="toggle-icons">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.995 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007-2.246-5.007-5.007-5.007S6.995 9.239 6.995 12zM11 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2H2zm17 0h3v2h-3zM5.637 19.778l-1.414-1.414 2.121-2.121 1.414 1.414zM16.242 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.344 7.759 4.223 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"></path></svg>
        </div>
        <input type="checkbox" id="darkModeToggleMobile" class="form-check-input">
        <label for="darkModeToggleMobile" class="form-check-label"></label>
        <div class="toggle-icons">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 11.807A9.002 9.002 0 0 1 10.049 2a9.942 9.942 0 0 0-5.12 2.735c-3.905 3.905-3.905 10.237 0 14.142 3.906 3.906 10.237 3.905 14.143 0a9.946 9.946 0 0 0 2.735-5.119A9.003 9.003 0 0 1 12 11.807z"></path></svg>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
#mobile-menu.is-active {
  transform: translateX(0) !important;
}

.dark #mobile-menu {
  background-color: #333 !important;
}

.dark #mobile-menu button iconify-icon,
.dark #mobile-menu nav a {
  color: white !important;
}

#mobile-menu nav a:hover {
  color: #00b880 !important;
}

.dark #mobile-menu nav a:hover {
  color: #5fdbb5 !important;
}

body.menu-open {
  overflow: hidden !important;
}
</style>
