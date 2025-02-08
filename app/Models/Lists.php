<?php
namespace App\Models;

class Lists
{
	public static function listBuilder(array $array): string
	{
		$build = '';
		foreach ($array as $item) {
			$build .= '<li>' . $item . '</li>';
		}
		return $build;
	}

	public static function h5ListBuilder(array $array): string 
	{
		$build = '';
		foreach ($array as $item) {
			$build .= '<h5>' . $item . '</h5>';
		}
		return $build;
	}

	public static function educationBuilder(array $degree): string 
	{
		$build = '';

		$build .= '<div class="degree">';
		$build .= '<h3>' . $degree['degree'] . '</h3>';
		$build .= '<p class="focus">' . $degree['field'] . '</p>';
		$build .= '<p>' . $degree['date'] . '</p>';
		$build .= '<p>' . $degree['university'] . '</p>';
		$build .= '<p>' . $degree['location'] . '</p>';
		$build .= '</div>';

		return $build;
	}

	public static function experienceBuilder(array $array): string 
	{
		$build = '';
		
		$build .= 	'<div class="experience">';
		$build .= 		'<h3 class="position">' . $array['position'] . '</h3>';
		$build .= 		'<div class="info">';
		$build .= 			'<p class="range">' . $array['start_date'] . ' - ' . ($array['end_date'] ? $array['end_date'] : 'Present') . '</p>';
		$build .= 			'<p class="company">' . $array['company'] . '</p>';
		$build .= 			'<p class="location">' . $array['location'] . '</p>';
		$build .= 		'</div>';
		$build .= 		'<ul class="list">';
		foreach ($array['description'] as $description) {
			$build .= '<li>' . $description . '</li>';
		}
		$build .= 		'</ul>';
		$build .= 	'</div>';

		return $build;
	}
}