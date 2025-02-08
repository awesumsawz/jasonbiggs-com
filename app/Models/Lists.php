<?php
namespace App\Models;

class Lists
{
	public static function listBuilder(array $skills): string
	{
		$build = '';
		foreach ($skills as $skill) {
			$build .= '<li>' . $skill . '</li>';
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
		$build .= 			'<p class="range">' . $array['start_date'] . ' - ' . $array['end_date'] . '</p>';
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