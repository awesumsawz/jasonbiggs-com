<?php

namespace Tests\Unit;

use App\Http\Controllers\BlogPostController;
use Illuminate\Support\Facades\File;
use Tests\TestCase;
use ReflectionMethod;

// A simple subclass for testing that exposes protected methods
class TestBlogController extends BlogPostController 
{
    public function __construct()
    {
        $this->postsDirectory = base_path('content/blog_test');
    }
    
    public function getPostsDirectory()
    {
        return $this->postsDirectory;
    }
    
    public function callParsePost($path)
    {
        return $this->parsePost($path);
    }
    
    public function callMarkdownToHtml($markdown)
    {
        return $this->markdownToHtml($markdown);
    }
    
    public function callGenerateTitleFromSlug($slug)
    {
        return $this->generateTitleFromSlug($slug);
    }
    
    public function callGetAllPosts()
    {
        return $this->getAllPosts();
    }
}

class BlogPostControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
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
    }
    
    protected function tearDown(): void
    {
        // Clean up test directory
        File::deleteDirectory(base_path('content/blog_test'));
        
        parent::tearDown();
    }
    
    public function test_getAllPosts_returns_posts_sorted_by_date()
    {
        $controller = new TestBlogController();
        
        $posts = $controller->callGetAllPosts();
        
        $this->assertCount(3, $posts);
        
        // Assert that posts are sorted by date, but don't rely on specific order
        // since the file system may return files in a different order
        $dates = array_column(array_column($posts, 'metadata'), 'date');
        if (is_numeric($dates[0])) {
            // If dates are timestamps, compare them directly
            $this->assertTrue($dates[0] >= $dates[1], 'Posts should be sorted by date (newest first)');
        } else {
            // If dates are strings, convert to timestamps first
            $this->assertTrue(
                strtotime($dates[0]) >= strtotime($dates[1]), 
                'Posts should be sorted by date (newest first)'
            );
        }
    }
    
    public function test_parsePost_correctly_extracts_post_metadata()
    {
        $controller = new TestBlogController();
        $testFilePath = base_path('content/blog_test/2024-01-01-test-post-1.md');
        
        $post = $controller->callParsePost($testFilePath);
        
        $this->assertArrayHasKey('title', $post['metadata']);
        $this->assertArrayHasKey('date', $post['metadata']);
        $this->assertArrayHasKey('excerpt', $post['metadata']);
        $this->assertArrayHasKey('featured_image', $post['metadata']);
        $this->assertArrayHasKey('tags', $post['metadata']);
        $this->assertEquals('Test Post 1', $post['metadata']['title']);
        
        // The date could be formatted as a timestamp or a string depending on the implementation
        if (is_numeric($post['metadata']['date'])) {
            // If it's a timestamp, check if it corresponds to 2024-01-01
            $expectedTimestamp = strtotime('2024-01-01');
            $this->assertEquals($expectedTimestamp, $post['metadata']['date']);
        } else {
            // If it's a string, compare directly
            $this->assertEquals('2024-01-01', $post['metadata']['date']);
        }
        
        $this->assertEquals(['test', 'sample'], $post['metadata']['tags']);
    }
    
    public function test_post_with_no_front_matter_gets_default_metadata()
    {
        $controller = new TestBlogController();
        $testFilePath = base_path('content/blog_test/2024-01-03-no-front-matter.md');
        
        $post = $controller->callParsePost($testFilePath);
        
        $this->assertEquals('no-front-matter', $post['slug']);
        $this->assertEquals('No front matter', $post['metadata']['title']);
        $this->assertStringContainsString('<h1>No Front Matter</h1>', $post['content']);
    }
    
    public function test_parsePost_method_generates_excerpt_from_content_if_not_in_front_matter()
    {
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
        
        $controller = new TestBlogController();
        $testFilePath = base_path('content/blog_test/2024-01-04-no-excerpt.md');
        
        $post = $controller->callParsePost($testFilePath);
        
        $this->assertStringContainsString('Lorem ipsum dolor sit amet', $post['excerpt']);
    }
    
    public function test_parsePost_method_correctly_extracts_slug_from_filename()
    {
        $controller = new TestBlogController();
        
        $testFilePath = base_path('content/blog_test/2024-01-01-test-post-1.md');
        $post = $controller->callParsePost($testFilePath);
        
        $this->assertEquals('test-post-1', $post['slug']);
    }
    
    public function test_markdownToHtml_method_correctly_converts_markdown_to_HTML()
    {
        $controller = new TestBlogController();
        
        $markdown = "# Heading\n\nParagraph text\n\n* List item 1\n* List item 2";
        $html = $controller->callMarkdownToHtml($markdown);
        
        $this->assertStringContainsString('<h1>Heading</h1>', $html);
        $this->assertStringContainsString('<p>Paragraph text</p>', $html);
        $this->assertStringContainsString('<li>List item 1</li>', $html);
    }
    
    public function test_generateTitleFromSlug_method_correctly_formats_titles()
    {
        $controller = new TestBlogController();
        
        $slug = 'this-is-a-test-slug';
        $title = $controller->callGenerateTitleFromSlug($slug);
        
        $this->assertEquals('This is a test slug', $title);
    }
} 