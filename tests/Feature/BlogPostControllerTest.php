<?php

use App\Http\Controllers\BlogPostController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

// Use unit tests instead of feature tests to avoid database connections
// These tests focus on the controller's functionality without database interaction

beforeEach(function () {
    // Create test blog post directory if it doesn't exist
    $testPostsDir = base_path('content/blog_test');
    if (!File::exists($testPostsDir)) {
        File::makeDirectory($testPostsDir, 0755, true);
    }
    
    // Create sample test posts
    $samplePost1 = <<<EOT
---
title: Test Post 1
date: 2024-01-01
excerpt: This is a test excerpt for post 1
featured_image: /images/test1.jpg
tags: [test, sample]
---

# Test Post 1

This is the content of test post 1.
EOT;

    $samplePost2 = <<<EOT
---
title: Test Post 2
date: 2024-01-02
excerpt: This is a test excerpt for post 2
featured_image: /images/test2.jpg
tags: [test, example]
---

# Test Post 2

This is the content of test post 2.
EOT;

    File::put(base_path('content/blog_test/2024-01-01-test-post-1.md'), $samplePost1);
    File::put(base_path('content/blog_test/2024-01-02-test-post-2.md'), $samplePost2);
    
    // Create post with no front matter
    File::put(base_path('content/blog_test/2024-01-03-no-front-matter.md'), "# No Front Matter\n\nThis post has no front matter.");
    
    // Register test routes with the controller for testing
    Route::get('/test-blog', [TestBlogPostController::class, 'index']);
    Route::get('/test-blog/{slug}', [TestBlogPostController::class, 'show']);
});

afterEach(function () {
    // Clean up test directory
    File::deleteDirectory(base_path('content/blog_test'));
});

// Test controller class that extends the BlogPostController
class TestBlogPostController extends BlogPostController
{
    public function __construct()
    {
        // Override the posts directory for testing
        $this->postsDirectory = base_path('content/blog_test');
    }
    
    public function parsePostForTest($path)
    {
        return $this->parsePost($path);
    }
    
    public function markdownToHtmlForTest($markdown)
    {
        return $this->markdownToHtml($markdown);
    }
    
    public function generateTitleFromSlugForTest($slug)
    {
        return $this->generateTitleFromSlug($slug);
    }
    
    public function getPostsDirectory()
    {
        return $this->postsDirectory;
    }
    
    // Override to return test views instead of actual views to avoid database connections
    public function index()
    {
        $posts = $this->getAllPosts();
        return response()->json(['posts' => $posts]);
    }
    
    public function show($slug)
    {
        // Find the post file matching the slug
        $files = File::files($this->postsDirectory);
        $postPath = null;
        
        foreach ($files as $file) {
            if (str_contains($file->getFilename(), $slug)) {
                $postPath = $file->getPathname();
                break;
            }
        }
        
        if (!$postPath) {
            abort(404);
        }
        
        $post = $this->parsePost($postPath);
        return response()->json(['post' => $post]);
    }
}

// Unit tests that don't require database
test('getAllPosts returns posts sorted by date', function () {
    $controller = new TestBlogPostController();
    $reflection = new ReflectionClass($controller);
    $method = $reflection->getMethod('getAllPosts');
    $method->setAccessible(true);
    
    $posts = $method->invoke($controller);
    
    expect($posts)->toHaveCount(3);
    expect($posts[0]['slug'])->toBe('test-post-2');
    expect($posts[1]['slug'])->toBe('test-post-1');
});

test('parsePost correctly extracts post metadata', function () {
    $controller = new TestBlogPostController();
    $testFilePath = base_path('content/blog_test/2024-01-02-test-post-2.md');
    
    $post = $controller->parsePostForTest($testFilePath);
    
    expect($post['metadata'])->toHaveKeys(['title', 'date', 'excerpt', 'featured_image', 'tags']);
    expect($post['metadata']['title'])->toBe('Test Post 2');
    expect($post['metadata']['date'])->toBe('2024-01-02');
    expect($post['metadata']['tags'])->toBe(['test', 'example']);
});

test('controller returns 404 for non-existent post', function () {
    $this->withoutExceptionHandling();
    
    try {
        $controller = new TestBlogPostController();
        $controller->show('non-existent-post');
        $this->fail('Expected 404 exception was not thrown');
    } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
        $this->assertTrue(true); // Successfully caught 404
    }
});

test('post with no front matter gets default metadata', function () {
    $controller = new TestBlogPostController();
    $testFilePath = base_path('content/blog_test/2024-01-03-no-front-matter.md');
    
    $post = $controller->parsePostForTest($testFilePath);
    
    expect($post['slug'])->toBe('no-front-matter');
    expect($post['metadata']['title'])->toBe('No front matter');
    expect($post['content'])->toContain('<h1>No Front Matter</h1>');
});

test('parsePost method generates excerpt from content if not in front matter', function () {
    // Create a post without excerpt in front matter
    $postContent = <<<EOT
---
title: No Excerpt Post
date: 2024-01-04
tags: [test]
---

# This is a post without excerpt

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
EOT;

    File::put(base_path('content/blog_test/2024-01-04-no-excerpt.md'), $postContent);
    
    $controller = new TestBlogPostController();
    $testFilePath = base_path('content/blog_test/2024-01-04-no-excerpt.md');
    
    $post = $controller->parsePostForTest($testFilePath);
    
    expect($post['excerpt'])->toContain('Lorem ipsum dolor sit amet');
});

test('parsePost method correctly extracts slug from filename', function () {
    $controller = new TestBlogPostController();
    
    $testFilePath = base_path('content/blog_test/2024-01-01-test-post-1.md');
    $post = $controller->parsePostForTest($testFilePath);
    
    expect($post['slug'])->toBe('test-post-1');
});

test('markdownToHtml method correctly converts markdown to HTML', function () {
    $controller = new TestBlogPostController();
    
    $markdown = "# Heading\n\nParagraph text\n\n* List item 1\n* List item 2";
    $html = $controller->markdownToHtmlForTest($markdown);
    
    expect($html)->toContain('<h1>Heading</h1>');
    expect($html)->toContain('<p>Paragraph text</p>');
    expect($html)->toContain('<li>List item 1</li>');
});

test('generateTitleFromSlug method correctly formats titles', function () {
    $controller = new TestBlogPostController();
    
    $slug = 'this-is-a-test-slug';
    $title = $controller->generateTitleFromSlugForTest($slug);
    
    expect($title)->toBe('This is a test slug');
}); 