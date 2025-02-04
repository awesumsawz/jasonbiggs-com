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