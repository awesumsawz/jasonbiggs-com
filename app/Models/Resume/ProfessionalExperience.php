<?php

namespace App\Models\Resume;

use Illuminate\Support\Collection;

class ProfessionalExperience
{
    /**
     * Get all professional experiences from JSON file
     */
    public static function all(): Collection
    {
        $jsonPath = base_path('data/professional-experiences.json');

        if (!file_exists($jsonPath)) {
            return collect([]);
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        return collect($data)->map(fn($item) => (object) $item);
    }

    /**
     * Get experiences ordered by display_order
     */
    public static function orderBy(string $column, string $direction = 'asc'): Collection
    {
        $collection = static::all();

        return $direction === 'asc'
            ? $collection->sortBy($column)
            : $collection->sortByDesc($column);
    }
}