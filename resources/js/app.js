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

// Home page gallery slider functions
window.gallerySlideArrows = function(element) {
    const allSlides = document.querySelectorAll('.sliding-gallery .slide');
    const allDots = document.querySelectorAll('.sliding-gallery .dot');
    const totalSlides = allSlides.length;
    let currentIndex = 0;
    
    // Find current active slide
    for (let i = 0; i < totalSlides; i++) {
        if (allSlides[i].classList.contains('active')) {
            currentIndex = i;
            break;
        }
    }
    
    // Determine which direction to slide
    let newIndex;
    if (element.id === 'advance') {
        newIndex = (currentIndex + 1) % totalSlides;
    } else {
        newIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    }
    
    // Update slides and dots
    allSlides[currentIndex].classList.remove('active');
    allDots[currentIndex].classList.remove('active');
    allSlides[newIndex].classList.add('active');
    allDots[newIndex].classList.add('active');
};

window.dotChangeSlide = function(element) {
    const allSlides = document.querySelectorAll('.sliding-gallery .slide');
    const allDots = document.querySelectorAll('.sliding-gallery .dot');
    
    // Get the dot index from its ID
    const dotId = element.id;
    const newIndex = parseInt(dotId.split('-')[1]);
    
    // Remove active class from all slides and dots
    allSlides.forEach(slide => slide.classList.remove('active'));
    allDots.forEach(dot => dot.classList.remove('active'));
    
    // Add active class to the selected slide and dot
    allSlides[newIndex].classList.add('active');
    allDots[newIndex].classList.add('active');
};

// Auto advance gallery slides every 7 seconds
function autoAdvanceGallery() {
    const allSlides = document.querySelectorAll('.sliding-gallery .slide');
    if (allSlides.length > 0) {
        const advanceButton = document.getElementById('advance');
        if (advanceButton) {
            gallerySlideArrows(advanceButton);
        }
    }
}

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
    
    // Start auto-advancing gallery if it exists
    const slidingGallery = document.querySelector('.sliding-gallery');
    if (slidingGallery) {
        console.log('Gallery found - setting up auto-advance');
        // Set interval for auto-advancing slides
        setInterval(autoAdvanceGallery, 7000);
    }
});

// Initialize any components
document.addEventListener('DOMContentLoaded', function() {
    // Additional initialization code can go here
}); 