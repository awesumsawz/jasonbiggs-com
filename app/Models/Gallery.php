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
        $output .=    	'<div class="grid-card-modal">';
        $output .=				'<div class="image">';
        $output .=					'<img src="'. $image_url .'" alt="'. $image_alt .'">';
        $output .=      		'<div class="close" onclick="galleryGridCollapseModal(this)">';
        $output .=        		'<iconify-icon icon="fa:close"></iconify-icon>';
        $output .=      		'</div>';
        $output .=				'</div>';
        $output .=      	'<div class="content">';
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
        $output .=      '<div class="overlay" onclick="galleryGridCollapseModal(this)"></div>';
        $output .=  	'</div>';
        $output .=  '</article>';
        
        $count++;

        return $output;
		
	}
}
