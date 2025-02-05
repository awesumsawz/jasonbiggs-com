import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

/* Header JS */

/**
 * Toggle Mobile Menu
 *
 * @param parent
 */
function toggleMobileMenu(parent) {
	if (parent.classList.contains('open')) {
		/* if clicking the "open" toggle */
		const openIcon = parent;
		const mobileMenu = openIcon.closest('body').querySelector('#mobile-menu');
		
		// hide openIcon
		openIcon.style.visibility = 'hidden';
		// show mobileMenu
		mobileMenu.style.display = 'block';
	} else {
		/* if clicking the "close" toggle */
		const mobileMenu = parent.closest('#mobile-menu');
		const openIcon = parent.closest('body').querySelector('header .menu .open');
		
		// hide the mobile mneu
		mobileMenu.style.display = 'none';
		// show the openIcon
		openIcon.style.visibility = 'visible';
		
	}
}

/* Front Page JS */

/**
 * Gallery Slide Arrows
 *
 * @param parent
 */
function gallerySlideArrows(parent) {
	const thisArrow = parent;
	// get the parent arrow's ID to identify its purpose
	const thisDirection = thisArrow.id;
	const parentGallery = thisArrow.parentNode.parentNode;
	// get the active slide's ID number to identify the current slide number
	const activeSlide = parentGallery.querySelector('.slide.active')
	const activeSlideNumber = parseInt(activeSlide.id.replace('slide-', ''));
	// $Count the instances of .slide to figure out if the current slide is the final or first slide
	const totalSlideCount = parentGallery.querySelectorAll('.slide').length;
	
	
	let newSlideID = null;
	
	if ( thisDirection === 'advance' )
			// if the arrow is "advance"
	{
		if ( activeSlideNumber === ( totalSlideCount - 1 ) )
				// if the active slide number is equal to the total slide count, loop back to the first slide
		{
			newSlideID = 0;
		}
		else
				// if not, advance to the next slide by increasing active slide number by one
		{
			newSlideID = activeSlideNumber + 1;
		}
	}
	else if ( thisDirection === 'return' )
			// if the arrow is "return"
	{
		if ( activeSlideNumber === 0 )
				// if the active slide number is equal to the 0, loop to the last slide
		{
			newSlideID = ( totalSlideCount - 1 );
		}
		else
				// if not, return to the previous slide by reducing the active slide number by one
		{
			newSlideID = activeSlideNumber - 1;
		}
	}
	const newActiveSlide = parentGallery.querySelector('#slide-' + newSlideID );
	
	// remove the active class from the 'current' slide and add active class to the next slide
	activeSlide.classList.remove('active');
	newActiveSlide.classList.add('active');
	
	// swap dots as well
	const activeSlideDot = parentGallery.querySelector('.navigation #dot-' + activeSlideNumber );
	const newActiveSlideDot = parentGallery.querySelector('.navigation #dot-' + newSlideID );
	
	// remove the active class from the 'current' dot and add active class to the next dot
	activeSlideDot.classList.remove('active');
	newActiveSlideDot.classList.add('active');
}

/**
 * Dot Change Slide
 *
 * @param parent
 */
function dotChangeSlide(parent) {
	const thisDot = parent;
	const thisDotNumber = thisDot.id.replace('dot-', '');
	const dotGrid = thisDot.parentNode;
	const parentGallery = dotGrid.parentNode.parentNode;
	const activeSlide = parentGallery.querySelector('.slide.active');
	const activeDot = dotGrid.querySelector('.dot.active');
	
	const nextSlide = parentGallery.querySelector('#slide-' + thisDotNumber);
	const nextDot = thisDot;
	
	// remove active class from the current slide & dot
	activeSlide.classList.remove('active');
	activeDot.classList.remove('active');
	
	// add the active class to the next slide & dot
	nextSlide.classList.add('active');
	nextDot.classList.add('active');
}

/* Showcase Template JS */

/**
 * Gallery Grid Show Modal
 *
 * @param parent
 */
function galleryGridShowModal(parent) {
	const card = parent.parentNode;
	const cardWrapper = card.parentNode;
	const modalWrapper = cardWrapper.querySelector('.grid-card-modal-wrapper');
	
	modalWrapper.classList.add('active');
}

/**
 * Gallery Grid Collapse Modal
 *
 * @param parent
 */
function galleryGridCollapseModal(parent) {
	if ( parent.classList.contains('close')) {
		const modalWrapper = parent.parentNode.parentNode.parentNode;
		modalWrapper.classList.remove('active');
	}
	else if ( parent.classList.contains('overlay')) {
		const modalWrapper = parent.parentNode;
		modalWrapper.classList.remove('active');
	}
}

setInterval(
	function() {
		const gallery = document.querySelector('section.sliding-gallery');
		const activeSlide = gallery.querySelector('.slide.active')
		const activeSlideNumber = parseInt(activeSlide.id.replace('slide-', ''));
		// $Count the instances of .slide to figure out if the current slide is the final or first slide
		const totalSlideCount = gallery.querySelectorAll('.slide').length;
		
		let newSlideID = null;
		if ( activeSlideNumber === ( totalSlideCount - 1 ) )
				// if the active slide number is equal to the total slide count, loop back to the first slide
		{
			newSlideID = 0;
		}
		else
				// if not, advance to the next slide by increasing active slide number by one
		{
			newSlideID = activeSlideNumber + 1;
		}
		const newActiveSlide = gallery.querySelector('#slide-' + newSlideID );
		
		// remove the active class from the 'current' slide and add active class to the next slide
		activeSlide.classList.remove('active');
		newActiveSlide.classList.add('active');
		
		// swap dots as well
		const activeSlideDot = gallery.querySelector('.navigation #dot-' + activeSlideNumber );
		const newActiveSlideDot = gallery.querySelector('.navigation #dot-' + newSlideID );
		
		// remove the active class from the 'current' dot and add active class to the next dot
		activeSlideDot.classList.remove('active');
		newActiveSlideDot.classList.add('active');
	},
	10000
)