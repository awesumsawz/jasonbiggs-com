<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Symfony\Component\Yaml\Yaml;
use App\Extensions\ImageDimensionsExtension;

class BlogPostController extends Controller
{
    protected $postsDirectory;
    
    public function __construct()
    {
        $this->postsDirectory = $this->getPostsDirectory();
    }
    
    /**
     * Get the directory where blog posts are stored.
     * This method allows for easier testing by overriding in tests.
     */
    public function getPostsDirectory()
    {
        return base_path('content/blog');
    }
    
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request)
    {
        $allPosts = $this->getAllPosts();
        
        // Get selected tag for filtering
        $selectedTag = $request->input('tag');
        
        // Filter posts by tag if a tag is selected
        if ($selectedTag) {
            $allPosts = array_filter($allPosts, function($post) use ($selectedTag) {
                return isset($post['metadata']['tags']) && 
                      is_array($post['metadata']['tags']) && 
                      in_array($selectedTag, $post['metadata']['tags']);
            });
        }
        
        // Format dates properly for all posts
        foreach ($allPosts as &$post) {
            // Ensure the date is properly formatted for display regardless of its original format
            if (isset($post['metadata']['date'])) {
                $timestamp = strtotime($post['metadata']['date']);
                if ($timestamp) {
                    // Format date for display
                    $post['metadata']['formatted_date'] = date('F j, Y', $timestamp);
                    // Keep the original date for sorting
                    $post['metadata']['date'] = date('Y-m-d', $timestamp);
                } else {
                    // If the date couldn't be parsed as a timestamp, use a default
                    $post['metadata']['formatted_date'] = 'Unknown Date';
                }
            }
        }
        unset($post); // Unset reference to avoid issues
        
        // Get per_page value from request or use default of 9
        $perPage = $request->input('per_page', 9);
        
        // Make sure per_page is one of our allowed values
        $allowedPerPage = [9, 12, 24, 48];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 9; // Default if not in allowed values
        }
        
        $currentPage = $request->query('page', 1);
        
        // Manually paginate the posts
        $offset = ($currentPage - 1) * $perPage;
        $paginatedItems = array_slice($allPosts, $offset, $perPage);
        
        // Create a custom paginator
        $posts = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedItems,
            count($allPosts),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->except('page')
            ]
        );
        
        // Get all unique tags for the filter dropdown
        $allTags = $this->getAllTags($this->getAllPosts());
        
        return view('blog.index', compact('posts', 'perPage', 'allowedPerPage', 'allTags', 'selectedTag'));
    }
    
    /**
     * Display a specific blog post.
     */
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
        
        // Format the date for display
        if (isset($post['metadata']['date'])) {
            $timestamp = strtotime($post['metadata']['date']);
            if ($timestamp) {
                $post['metadata']['formatted_date'] = date('F j, Y', $timestamp);
            } else {
                $post['metadata']['formatted_date'] = 'Unknown Date';
            }
        }
        
        // Calculate estimated reading time
        $wordCount = str_word_count(strip_tags($post['content']));
        $readingTime = max(1, ceil($wordCount / 200)); // Assuming 200 words per minute reading speed
        $post['metadata']['reading_time'] = $readingTime;
        
        // Get previous and next posts
        $allPosts = $this->getAllPosts();
        
        // Find the current post's index
        $currentIndex = -1;
        foreach ($allPosts as $index => $currentPost) {
            if ($currentPost['slug'] === $slug) {
                $currentIndex = $index;
                break;
            }
        }
        
        // Set previous and next posts
        $previousPost = null;
        $nextPost = null;
        
        if ($currentIndex > 0) {
            $previousPost = $allPosts[$currentIndex - 1];
        }
        
        if ($currentIndex < count($allPosts) - 1 && $currentIndex !== -1) {
            $nextPost = $allPosts[$currentIndex + 1];
        }
        
        return view('blog.show', compact('post', 'previousPost', 'nextPost'));
    }
    
    /**
     * Get all blog posts sorted by date (newest first).
     */
    protected function getAllPosts()
    {
        $files = File::files($this->postsDirectory);
        $posts = [];
        
        foreach ($files as $file) {
            $posts[] = $this->parsePost($file->getPathname());
        }
        
        // Sort posts by date (newest first)
        usort($posts, function($a, $b) {
            return strtotime($b['metadata']['date']) - strtotime($a['metadata']['date']);
        });
        
        return $posts;
    }
    
    /**
     * Parse a markdown post file into metadata and content.
     */
    protected function parsePost($path)
    {
        $content = File::get($path);
        $filename = basename($path);
        
        // Extract the slug and date from the filename
        $filenameDate = null;
        if (preg_match('/^(\d{4}-\d{2}-\d{2})-(.*)\.md$/', $filename, $matches)) {
            $filenameDate = $matches[1];
            $slug = $matches[2];
        } else {
            // If filename doesn't match pattern, just extract slug without date
            $slug = preg_replace('/\.md$/', '', $filename);
        }
        
        // Parse front matter and content
        if (preg_match('/^---\s*(.*?)\s*---\s*(.*)/s', $content, $matches)) {
            $frontMatter = $matches[1];
            $markdownContent = $matches[2];
            
            // Parse YAML front matter
            $metadata = Yaml::parse($frontMatter);
            
            // Handle date format - it could be a timestamp, string, or object
            if (isset($metadata['date'])) {
                // If it's an integer timestamp, convert to date string
                if (is_numeric($metadata['date'])) {
                    $metadata['date'] = date('Y-m-d', (int)$metadata['date']);
                }
                // If date is an object (like DateTime or Carbon), convert to string
                else if (is_object($metadata['date'])) {
                    $metadata['date'] = $metadata['date']->format('Y-m-d');
                }
                // If it's already a string, ensure it's formatted correctly
                else if (is_string($metadata['date'])) {
                    $timestamp = strtotime($metadata['date']);
                    if ($timestamp) {
                        $metadata['date'] = date('Y-m-d', $timestamp);
                    }
                }
            }
            
            // Prioritize date from front matter, fallback to filename date, then file modification time
            if (empty($metadata['date']) && $filenameDate) {
                $metadata['date'] = $filenameDate;
            } elseif (empty($metadata['date'])) {
                $metadata['date'] = date('Y-m-d', filemtime($path));
            }
            
            // For debugging - log the original and processed date
            file_put_contents(
                storage_path('logs/date_debug.log'),
                "File: {$filename}, Processed date: {$metadata['date']}, Filename date: {$filenameDate}" . PHP_EOL,
                FILE_APPEND
            );
            
        } else {
            // No front matter found
            $metadata = [
                'title' => $this->generateTitleFromSlug($slug),
                'date' => $filenameDate ?: date('Y-m-d', filemtime($path)),
            ];
            $markdownContent = $content;
        }
        
        // Convert markdown to HTML
        $html = $this->markdownToHtml($markdownContent);
        
        return [
            'slug' => $slug,
            'metadata' => $metadata,
            'content' => $html,
            'excerpt' => $metadata['excerpt'] ?? substr(strip_tags($html), 0, 200) . '...',
        ];
    }
    
    /**
     * Convert markdown content to HTML.
     */
    protected function markdownToHtml($markdown)
    {
        // Pre-process markdown to handle image dimensions
        $markdown = $this->preprocessImageDimensions($markdown);
        
        // Configure the Environment with all the CommonMark and GFM parsers/renderers
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new ImageDimensionsExtension());
        
        $converter = new MarkdownConverter($environment);
        
        $html = $converter->convert($markdown)->getContent();
        
        return $html;
    }
    
    /**
     * Pre-process markdown to convert image dimensions to HTML img tags
     */
    protected function preprocessImageDimensions($markdown)
    {
        // Create a multi-pass processor to handle all variations
        
        // Step 1: First normalize all dimension syntax (no space after URL, etc)
        $processed = preg_replace(
            '/!\[(.*?)\]\(([^()]+?)(?:=|\s+=)(\d*)x(\d*)\)/',
            '![\\1](\\2 =\\3x\\4)',
            $markdown
        );
        
        // Step 2: Handle spacing between image and attributes
        $processed = preg_replace(
            '/\)\s+{/',
            '){',
            $processed
        );
        
        // Step 3: Process each image with the clean syntax
        $processed = preg_replace_callback(
            '/!\[(.*?)\]\(([^()]+?)(?:\s+=(\d*)x(\d*))?\)(?:{([^}]+)})?/',
            function($matches) {
                $alt = $matches[1];
                $src = trim($matches[2]);
                $attributes = [];
                
                // Log all matches for debugging
                file_put_contents(
                    storage_path('logs/image_debug.log'),
                    "MATCHES: " . json_encode($matches) . PHP_EOL,
                    FILE_APPEND
                );
                
                // Handle width and height dimensions
                if (!empty($matches[3]) || !empty($matches[4])) {
                    // Initialize style if not set
                    if (!isset($attributes['style'])) {
                        $attributes['style'] = '';
                    }
                    
                    // Add width to style if specified
                    if (!empty($matches[3])) {
                        $attributes['style'] .= 'width: ' . $matches[3] . 'px; ';
                    }
                    
                    // Add height to style if specified
                    if (!empty($matches[4])) {
                        $attributes['style'] .= 'height: ' . $matches[4] . 'px; ';
                    }
                }
                
                // Handle additional attributes
                if (!empty($matches[5])) {
                    $attrText = $matches[5];
                    
                    // Log attribute text
                    file_put_contents(
                        storage_path('logs/image_debug.log'),
                        "ATTR TEXT: " . $attrText . PHP_EOL,
                        FILE_APPEND
                    );
                    
                    // Handle cover attribute
                    if (strpos($attrText, 'cover') !== false) {
                        $attributes['class'] = isset($attributes['class']) ? 
                            $attributes['class'] . ' img-cover' : 'img-cover';
                        $attributes['style'] = isset($attributes['style']) ? 
                            $attributes['style'] . 'object-fit: cover; ' : 'object-fit: cover; ';
                    }
                    
                    // Improved position attribute handling
                    if (preg_match('/position=([^,}]+),([^}]+)/', $attrText, $posMatch)) {
                        // Handle two-value position (X,Y) - Legacy format, convert to space-separated
                        $positionX = trim($posMatch[1]);
                        $positionY = trim($posMatch[2]);
                        $position = $positionX . ' ' . $positionY;
                        $attributes['style'] = isset($attributes['style']) ? 
                            $attributes['style'] . 'object-position: ' . $position . '; ' : 
                            'object-position: ' . $position . '; ';
                    } elseif (preg_match('/position=([^}]+)/', $attrText, $posMatch)) {
                        // Handle position value (already space-separated or single value)
                        $position = trim($posMatch[1]);
                        // No need to convert - CSS already uses space-separated values
                        $attributes['style'] = isset($attributes['style']) ? 
                            $attributes['style'] . 'object-position: ' . $position . '; ' : 
                            'object-position: ' . $position . '; ';
                    }
                }
                
                // Build HTML attributes string
                $attrString = '';
                foreach ($attributes as $key => $value) {
                    $attrString .= ' ' . $key . '="' . $value . '"';
                }
                
                $result = '<img src="' . $src . '" alt="' . $alt . '"' . $attrString . '>';
                
                // Log the final result
                file_put_contents(
                    storage_path('logs/image_debug.log'),
                    "RESULT: " . $result . PHP_EOL . PHP_EOL,
                    FILE_APPEND
                );
                
                return $result;
            },
            $processed
        );
        
        return $processed;
    }
    
    /**
     * Generate a title from a slug.
     */
    protected function generateTitleFromSlug($slug)
    {
        return ucfirst(str_replace('-', ' ', $slug));
    }
    
    /**
     * Debug method to show raw HTML of a post
     */
    public function debug($slug)
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
        
        return '<pre>' . htmlspecialchars($post['content']) . '</pre>';
    }
    
    /**
     * View the debug log
     */
    public function viewDebugLog()
    {
        $logPath = storage_path('logs/image_debug.log');
        
        if (file_exists($logPath)) {
            $content = file_get_contents($logPath);
            return '<pre>' . htmlspecialchars($content) . '</pre>';
        }
        
        return 'No debug log found.';
    }
    
    /**
     * Debug view that extracts and displays only image style attributes
     */
    public function debugImageStyles($slug)
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
        $html = $post['content'];
        
        // Extract all image tags and their style attributes
        $matches = [];
        preg_match_all('/<img [^>]*style="([^"]*)"[^>]*>/', $html, $matches, PREG_SET_ORDER);
        
        $output = "<h1>Image Style Attributes for: {$post['metadata']['title']}</h1>\n\n";
        $output .= "<table border='1' cellpadding='5'>\n";
        $output .= "<tr><th>Image</th><th>Style Attribute</th></tr>\n";
        
        foreach ($matches as $i => $match) {
            $img = $match[0];
            $style = $match[1];
            
            // Extract src and alt for easier identification
            preg_match('/src="([^"]*)"/', $img, $srcMatch);
            preg_match('/alt="([^"]*)"/', $img, $altMatch);
            
            $src = isset($srcMatch[1]) ? $srcMatch[1] : 'unknown';
            $alt = isset($altMatch[1]) ? $altMatch[1] : 'unnamed';
            
            $output .= "<tr>\n";
            $output .= "  <td>Image #{$i} - {$alt}<br><code>" . htmlspecialchars($src) . "</code></td>\n";
            $output .= "  <td><code>" . htmlspecialchars($style) . "</code></td>\n";
            $output .= "</tr>\n";
        }
        
        $output .= "</table>";
        
        return $output;
    }
    
    /**
     * Extract all unique tags from all blog posts.
     */
    protected function getAllTags($posts)
    {
        $tags = [];
        
        foreach ($posts as $post) {
            if (isset($post['metadata']['tags']) && is_array($post['metadata']['tags'])) {
                foreach ($post['metadata']['tags'] as $tag) {
                    // Add tag if it's not already in the array
                    if (!in_array($tag, $tags)) {
                        $tags[] = $tag;
                    }
                }
            }
        }
        
        // Sort tags alphabetically
        sort($tags);
        
        return $tags;
    }
} 