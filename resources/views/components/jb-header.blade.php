<header id="main-menu" class="topbar navbar">
  <section class="title">
    <a href="/">
      <div class="desktop-view">
        <img class="logo" src="{{ asset( 'images/logos/green-logowordmark-flat.png' ) }}" alt="combined logo" />
      </div>
      <div class="tablet-view">
        <img class="logo" src="{{ asset( 'images/green-logowordmark-flat.png' ) }}" alt="graphic logo" />
      </div>
      <div class="mobile-view">
        <img class="logo" src="{{ asset( 'images/green-logo.png' ) }}" alt="graphic logo" />
      </div>
    </a>
  </section>
  <section class="menu secondary desktop-view">
    <div class="menu-wrapper">
      <?php echo wp_nav_menu( $secondary_navbar ); ?>
    </div>
  </section>
  <section class="menu">
    <div class="desktop-view">
        <?php echo wp_nav_menu( $primary_navbar ); ?>
    </div>
    <div class="mobile-view tablet-view">
      <div class="open" onclick="toggleMobileMenu(this)"><iconify-icon inline icon="ic:round-menu"></iconify-icon></div>
    </div>
  </section>

</header>

<div id="mobile-menu" class="sidebar navbar <?php echo is_admin_bar_showing() ? 'w-admin-bar' : '' ?>">
  <div class="menu-toggle">
    <div class="close" onclick="toggleMobileMenu(this)"><iconify-icon inline icon="ic:round-close"></iconify-icon></div>
  </div>
  <section class="top">
    <div class="primary-menu">
      <div class="menu-items">
        <?php echo wp_nav_menu( $primary_navbar ); ?>
      </div>
    </div>
    <hr>
    <div class="secondary-menu">
      <div class="menu-items">
        <?php echo wp_nav_menu( $secondary_navbar ); ?>
      </div>
    </div>
  </section>
  <section class="bottom">
    <div class="logo">
      <a href="<?php get_home_url() ?>">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/library/assets/logos/green-logowordmark-stacked.png" alt="<?php echo get_bloginfo('title'); ?>" />
      </a>
    </div>
  </section>
</div>
