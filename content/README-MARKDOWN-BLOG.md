# Markdown-Based Blog System

This Laravel application implements a simple but powerful blog system that uses Markdown files for content instead of a database. This approach offers several advantages:

- **Version Control**: Blog posts can be version-controlled with Git
- **Offline Editing**: Write posts in your favorite text editor
- **No Database Required**: Content is stored directly in files
- **Simple Backup**: Just copy the files
- **Developer-Friendly**: Markdown is simple and widely used

## How It Works

1. Blog posts are stored as Markdown files in the `content/blog` directory
2. Each file follows the naming convention: `YYYY-MM-DD-post-slug.md`
3. Files contain YAML front matter followed by Markdown content
4. The system parses these files and converts them to HTML for display

## Post Format

Each post should follow this format:

```markdown
---
title: Your Post Title
date: YYYY-MM-DD
excerpt: A brief summary of your post
featured_image: /images/your-image.jpg
tags: [tag1, tag2, tag3]
---

# Your Main Title

Your post content in Markdown...
```

## YAML Front Matter

The front matter section (between the `---` delimiters) accepts the following properties:

- `title`: The title of your post
- `date`: Publication date (YYYY-MM-DD)
- `excerpt`: Short description for listings (optional)
- `featured_image`: Path to the post's main image (optional)
- `tags`: Array of relevant tags (optional)

## Adding a New Post

To create a new blog post:

1. Create a new Markdown file in the `content/blog` directory
2. Name it using the convention `YYYY-MM-DD-post-slug.md`
3. Add the YAML front matter at the top
4. Write your content using Markdown
5. Place any images in the `public/images` directory

## Routes

The blog is accessible at:

- `/blog` - Lists all blog posts
- `/blog/{slug}` - Views a specific post

## Implementation Details

- The blog is powered by the `BlogPostController` class
- Markdown conversion is handled by `league/commonmark`
- YAML parsing uses `symfony/yaml`

## Extending the System

You can extend this system by:

- Adding categories for posts (in the front matter)
- Implementing an RSS feed
- Adding pagination for the blog listing
- Creating a search feature (using Laravel Scout and Algolia)
- Implementing a static site generator for even better performance 

## Image Styling in Markdown

This blog system includes enhanced Markdown features for controlling image appearance. You can customize dimensions, create full-width cover images, and control background positioning - all using standard Markdown with custom extensions.

### Basic Image Syntax

Standard Markdown image syntax works as expected:

```markdown
![Alt text](/images/your-image.jpg)
```

### Setting Image Dimensions

You can specify width and/or height using the `=WIDTHxHEIGHT` syntax:

```markdown
![Alt text](/images/your-image.jpg =300x200)  <!-- Width: 300px, Height: 200px -->
![Alt text](/images/your-image.jpg =300x)     <!-- Width: 300px, Auto height -->
![Alt text](/images/your-image.jpg =x200)     <!-- Auto width, Height: 200px -->
```

Image dimensions are applied via CSS `style` attributes rather than HTML attributes, ensuring better responsive behavior and consistent styling.

### Cover Image Mode

For images that should span the full width with a controlled height (like hero images), use the `{cover}` attribute:

```markdown
![Alt text](/images/your-image.jpg){cover}
```

This applies:
- `width: 100%`
- A maximum height (500px by default, responsive on mobile)
- `object-fit: cover` to maintain aspect ratio while filling the space
- Centered display

### Controlling Background Position

For cover images, you can control which part of the image is visible using the `position` attribute:

```markdown
![Alt text](/images/your-image.jpg){position=center}     <!-- Center the image (CSS center) -->
![Alt text](/images/your-image.jpg){position=50% 25%}    <!-- Position at 50% horizontal, 25% vertical -->
![Alt text](/images/your-image.jpg){position=top}        <!-- Align to top (CSS top) -->
```

This uses CSS `object-position` property to control how the image is positioned within its container.

### Combining Attributes

You can combine dimensions, cover mode, and positioning:

```markdown
![Alt text](/images/your-image.jpg =800x300){cover}                     <!-- Full-width cover image, 300px height -->
![Alt text](/images/your-image.jpg =800x300){position=50% 25%}          <!-- Sized image with custom position -->
![Alt text](/images/your-image.jpg =800x300){cover position=50% 25%}    <!-- Cover image with custom position -->
```

### Spacing and Syntax Variations

The parser handles various spacing patterns, making your Markdown more flexible:

```markdown
<!-- All of these are valid -->
![Alt text](/images/your-image.jpg=300x200){cover}
![Alt text](/images/your-image.jpg =300x200){cover}
![Alt text](/images/your-image.jpg =300x200) {cover}
```

### Default Styling

All images in blog posts receive these base styles:
- `max-width: 100%` to ensure responsiveness
- Proper margins for spacing
- Center alignment for cover images

For more details on CSS styling options, see the `resources/assets/sass/components/blog-images.scss` file. 