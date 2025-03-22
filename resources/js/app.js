import './dark-mode';

// Mobile menu toggle function
window.toggleMobileMenu = function() {
    console.log('Toggle mobile menu clicked');
    
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenu) {
        if (mobileMenu.classList.contains('is-active')) {
            mobileMenu.classList.remove('is-active');
            document.body.classList.remove('menu-open');
            console.log('Menu closed');
        } else {
            mobileMenu.classList.add('is-active');
            document.body.classList.add('menu-open');
            console.log('Menu opened');
            console.log('Menu style after opening:', {
                transform: window.getComputedStyle(mobileMenu).transform,
                display: window.getComputedStyle(mobileMenu).display,
                visibility: window.getComputedStyle(mobileMenu).visibility
            });
        }
    } else {
        console.error('Mobile menu element not found');
    }
};

// Gallery grid modal functions
window.galleryGridShowModal = function(element) {
    const cardWrapper = element.closest('.card-wrapper');
    const modalWrapper = cardWrapper.querySelector('.grid-card-modal-wrapper');
    if (modalWrapper) {
        modalWrapper.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
};

window.galleryGridCollapseModal = function(element) {
    const modalWrapper = element.closest('.grid-card-modal-wrapper');
    if (modalWrapper) {
        modalWrapper.classList.remove('active');
        // Restore scrolling after transition completes
        setTimeout(() => {
            document.body.style.overflow = '';
        }, 300);
    }
};

// Initialize components on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing components');
    
    // Check if mobile menu exists
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        console.log('Mobile menu found in DOM');
    } else {
        console.error('Mobile menu not found in DOM');
    }
});

// Initialize any components
document.addEventListener('DOMContentLoaded', function() {
    // Additional initialization code can go here
}); 