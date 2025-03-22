<?php
namespace App\Models;

class Lists
{
	public static function listBuilder(array $array): string
	{
		$build = '';
		foreach ($array as $item) {
			$build .= '<li class="text-gray-800 dark:text-gray-200">' . $item . '</li>';
		}
		return $build;
	}

	public static function h5ListBuilder(array $array): string 
	{
		$build = '';
		foreach ($array as $item) {
			$build .= '<p class="text-[1.6rem] font-semibold mb-2 text-gray-800 dark:text-gray-200">' . $item . '</p>';
		}
		return $build;
	}

	public static function linkListBuilder(array $array): string 
	{
		$build = '';
		foreach ($array as $item) {
			$build .= '<div class="link mb-2"><a href="' . $item['url'] . '" class="underline">' . $item['label'] . '</a></div>';
		}
		return $build;
	}

	public static function educationBuilder(array $degree): string 
	{
		$build = '';

		$build .= '<div class="degree text-center">';
		$build .= '<h3 class="font-display mb-2">' . $degree['degree'] . '</h3>';
		$build .= '<p class="">' . $degree['field'] . '</p>';
		$build .= '<p class="">' . $degree['date'] . '</p>';
		$build .= '<p class="">' . $degree['university'] . '</p>';
		$build .= '<p class="">' . $degree['location'] . '</p>';
		$build .= '</div>';

		return $build;
	}

	public static function experienceBuilder(array $array): string 
	{
		$build = '';
		
		$build .= 	'<div class="experience pb-8 border-gray-200 dark:border-gray-700 last:pb-0 mb-8">';
		$build .= 		'<h3 class="position text-2xl md:text-3xl font-display text-blue-600 dark:text-blue-400 mb-4">' . $array['position'] . '</h3>';
		$build .= 		'<div class="info flex flex-row justify-between gap-8">';
		$build .= 			'<div class="flex flex-col gap-1 flex-none">';
		$build .= 				'<p class="range">' . $array['start_date'] . ' - ' . ($array['end_date'] ? $array['end_date'] : 'Present') . '</p>';
		$build .= 				'<p class="company text-gray-600 dark:text-gray-300 font-semibold">' . $array['company'] . '</p>';
		$build .= 				'<p class="location text-gray-600 dark:text-gray-300">' . $array['location'] . '</p>';
		$build .= 			'</div>';
		$build .= 			'<ul>';
		foreach ($array['description'] as $description) {
			$build .= '<li class="leading-relaxed text-gray-800 dark:text-gray-200">' . $description . '</li>';
		}
		$build .= 			'</ul>';
		$build .= 		'</div>';
		$build .= 	'</div>';

		return $build;
	}
}