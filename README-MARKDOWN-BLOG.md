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