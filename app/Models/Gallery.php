<?php
namespace App\Models;

class Gallery
{
	public static function galleryBuilder(array $slide_settings, int &$count): string
	{
		$title      = $slide_settings['slide_title'];
		$content    = $slide_settings['slide_contents'];
		$cta_url    = $slide_settings['cta_url'];
		$cta_text   = $slide_settings['cta_button_text'];
		$image_url  = $slide_settings['slide_image'];

		$output =   '<div id="slide-'. $count .'" class="slide'. ($count == 0 ? ' active' : null) .'" style="background-image: url(\''. $image_url .'\')">';
		$output .=      '<div class="title">';
		$output .=          '<h2>'. $title .'</h2>';
		$output .=      '</div>';
		$output .=      '<div class="content">';
		$output .=          '<p>'. $content .'</p>';
		$output .=      '</div>';
		$output .=      '<div class="cta">';
		$output .=          '<a href="'. $cta_url .'">'. $cta_text .'</a>';
		$output .=      '</div>';
		$output .=      '<div class="overlay"></div>';
		$output .=  '</div>';

		$count++;
		return $output;
	}

	public static function galleryCardBuilder(array $card_info, int &$count): string
	{
		$title          = $card_info['title'];
        $description    = $card_info['description'];
        $date           = $card_info['date'];
        $image_url      = $card_info['imageURL'];
        $image_alt      = $card_info['imageAlt'];
        
        $output =   '<article id="card-'. $count .'" class="card-wrapper">';
        $output .=    '<div class="grid-card" style="background-image: url(\''. $image_url .'\')">';
        $output .=      '<div class="overlay" onclick="galleryGridShowModal(this)"></div>';
        $output .=    '</div>';
        $output .=    '<div class="grid-card-modal-wrapper">';
        $output .=      '<div class="overlay" onclick="galleryGridCollapseModal(this)"></div>';
        $output .=    	'<div class="grid-card-modal">';
        $output .=        '<div class="close" onclick="galleryGridCollapseModal(this)">';
        $output .=          '<svg xmlns="http://www.w3.org/2000/svg" width="1216" height="1312" viewBox="0 0 1216 1312"><path fill="currentColor" d="M1202 1066q0 40-28 68l-136 136q-28 28-68 28t-68-28L608 976l-294 294q-28 28-68 28t-68-28L42 1134q-28-28-28-68t28-68l294-294L42 410q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294l294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68L880 704l294 294q28 28 28 68"/></svg>';
        $output .=        '</div>';
        $output .=				'<div class="image">';
        $output .=					'<img src="'. $image_url .'" alt="'. $image_alt .'">';
        $output .=				'</div>';
        $output .=      	'<div class="content border-l border-dark-gray">';
        $output .=      		'<div class="title">';
        $output .=        		$title;
        $output .=      		'</div>';
        $output .=      		'<div class="description">';
        $output .=        		$description;
        $output .=      		'</div>';
        $output .=      		'<div class="date">';
        $output .=        		$date;
        $output .=      		'</div>';
        $output .=      	'</div>';
        $output .=    	'</div>';
        $output .=  	'</div>';
        $output .=  '</article>';
        
        $count++;

        return $output;
		
	}
}
