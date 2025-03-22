<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'published', 'published_at'];
    
    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];
    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function scopePublished($query)
    {
        return $query->where('published', true)->whereNotNull('published_at')->orderBy('published_at', 'desc');
    }
} 