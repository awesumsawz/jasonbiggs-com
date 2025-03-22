<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'excerpt' => 'Learn the basics of Laravel and how to set up your first project.',
                'content' => '<p>Laravel is a PHP framework that makes web development easier and more enjoyable. In this post, we\'ll cover how to set up your first Laravel project and explore the basic concepts.</p><p>First, make sure you have Composer installed on your machine. Composer is a dependency manager for PHP that Laravel uses to manage its dependencies.</p><p>To create a new Laravel project, open your terminal and run the following command:</p><pre><code>composer create-project laravel/laravel my-project</code></pre><p>This will create a new Laravel project in a directory called "my-project". Navigate to the directory and start the development server:</p><pre><code>cd my-project<br>php artisan serve</code></pre><p>You should now see your Laravel application running at <a href="http://localhost:8000">http://localhost:8000</a>.</p>',
                'image' => 'images/placeholder.svg',
                'published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Mastering Blade Templates',
                'excerpt' => 'Dive deep into Laravel\'s Blade templating engine and learn how to create reusable components.',
                'content' => '<p>Blade is Laravel\'s templating engine that makes writing views simpler and more powerful. In this post, we\'ll explore how to use Blade templates effectively.</p><p>Blade templates are stored in the <code>resources/views</code> directory and have the <code>.blade.php</code> extension. Blade provides convenient shortcuts for common PHP operations and includes features like template inheritance, components, and slots.</p><p>One of the most powerful features of Blade is template inheritance. You can define a master layout and extend it in child templates:</p><pre><code>@extends(\'layouts.app\')

@section(\'content\')
    &lt;h1&gt;Hello, World!&lt;/h1&gt;
@endsection</code></pre><p>Blade also allows you to create reusable components that can be included in your views:</p><pre><code>@component(\'components.alert\')
    @slot(\'title\')
        Server Error
    @endslot

    &lt;strong&gt;Whoops!&lt;/strong&gt; Something went wrong!
@endcomponent</code></pre><p>With Blade, you can create clean, reusable templates that make your code more maintainable.</p>',
                'image' => 'images/placeholder.svg',
                'published' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Working with Eloquent ORM',
                'excerpt' => 'Explore Laravel\'s Eloquent ORM and how it simplifies database operations.',
                'content' => '<p>Eloquent is Laravel\'s implementation of the Active Record pattern, which provides an elegant way to interact with your database.</p><p>To create a model, you can use the <code>make:model</code> Artisan command:</p><pre><code>php artisan make:model Post</code></pre><p>This will create a model class in the <code>app/Models</code> directory. By default, Eloquent assumes that the table name is the plural form of the model name, so the <code>Post</code> model will correspond to the <code>posts</code> table.</p><p>You can retrieve all records from a table using the <code>all</code> method:</p><pre><code>$posts = Post::all();</code></pre><p>You can also use various query methods to filter results:</p><pre><code>$posts = Post::where(\'published\', true)
           ->orderBy(\'created_at\', \'desc\')
           ->take(10)
           ->get();</code></pre><p>Eloquent makes database operations simple and intuitive, allowing you to focus on building your application rather than writing complex SQL queries.</p>',
                'image' => 'images/placeholder.svg',
                'published' => true,
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Building API Endpoints with Laravel',
                'excerpt' => 'Learn how to create RESTful APIs using Laravel\'s routing and controller features.',
                'content' => '<p>Laravel makes it easy to build robust APIs for your web applications. In this post, we\'ll walk through the process of creating RESTful API endpoints.</p><p>First, let\'s create a resource controller using Artisan:</p><pre><code>php artisan make:controller API/PostController --resource</code></pre><p>This will generate a controller with methods for all the standard CRUD operations. Next, we need to define our API routes in <code>routes/api.php</code>:</p><pre><code>Route::apiResource(\'posts\', API\\PostController::class);</code></pre><p>This will create routes for all the RESTful actions in our controller. You can verify the routes using the <code>route:list</code> command:</p><pre><code>php artisan route:list</code></pre><p>Now, let\'s implement the index method in our controller to return a list of posts:</p><pre><code>public function index()
{
    $posts = Post::all();
    return response()->json($posts);
}</code></pre><p>With these basic steps, you\'ve created a simple API for your application. Laravel also provides features like API resources and Sanctum for more advanced API functionality.</p>',
                'image' => 'images/placeholder.svg',
                'published' => true,
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'Laravel Security Best Practices',
                'excerpt' => 'Protect your Laravel application with these essential security tips and techniques.',
                'content' => '<p>Security is a critical aspect of web application development. Laravel provides several built-in features to help secure your application, but it\'s important to understand and follow best practices.</p><p>Here are some essential security practices for Laravel applications:</p><ol><li><strong>Keep Laravel Updated:</strong> Always use the latest version of Laravel and its dependencies to benefit from security patches.</li><li><strong>Use Environment Variables:</strong> Store sensitive information like API keys and database credentials in environment variables.</li><li><strong>CSRF Protection:</strong> Laravel includes CSRF protection for forms. Make sure to include the <code>@csrf</code> directive in your forms.</li><li><strong>SQL Injection Prevention:</strong> Use Eloquent ORM or query builders to prevent SQL injection attacks.</li><li><strong>XSS Prevention:</strong> Escape output using Blade\'s <code>{{ }}</code> syntax, which automatically escapes content.</li><li><strong>Authentication:</strong> Use Laravel\'s built-in authentication system, which handles password hashing and session management securely.</li><li><strong>Authorization:</strong> Implement proper authorization using Laravel\'s gates and policies.</li></ol><p>By following these best practices, you can significantly improve the security of your Laravel application and protect your users\' data.</p>',
                'image' => 'images/placeholder.svg',
                'published' => true,
                'published_at' => Carbon::now()->subDays(7),
            ],
        ];

        foreach ($posts as $post) {
            $slug = Str::slug($post['title']);
            
            // Check if post with this slug already exists
            if (!BlogPost::where('slug', $slug)->exists()) {
                BlogPost::create($post);
            } else {
                $this->command->info("Post with slug '{$slug}' already exists. Skipping.");
            }
        }
    }
} 