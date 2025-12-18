<?php

namespace App\Models;

use Illuminate\Support\Collection;

class Pages
{
    /**
     * Get all pages data from JSON file
     */
    public static function all(): Collection
    {
        $jsonPath = base_path('data/pages.json');

        if (!file_exists($jsonPath)) {
            return collect([]);
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        return collect($data)->map(fn($item) => (object) $item);
    }

    /**
     * Get page data by slug and key
     */
    public static function getBySlugAndKey(string $slug, string $key): ?object
    {
        return static::all()
            ->where('slug', $slug)
            ->where('key', $key)
            ->first();
    }

    /**
     * Get all data for a specific page slug
     */
    public static function getBySlug(string $slug): Collection
    {
        return static::all()
            ->where('slug', $slug);
    }

    /**
     * Get value by slug and key
     */
    public static function getValue(string $slug, string $key, $default = null)
    {
        $page = static::getBySlugAndKey($slug, $key);
        return $page ? $page->value : $default;
    }
}
