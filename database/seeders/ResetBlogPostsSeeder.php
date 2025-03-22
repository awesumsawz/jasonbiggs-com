<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BlogPost;

class ResetBlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all blog posts
        BlogPost::truncate();
        
        $this->command->info('All blog posts have been deleted.');
        
        // Optional: Run the BlogPostSeeder to add fresh posts
        $this->call(BlogPostSeeder::class);
    }
} 