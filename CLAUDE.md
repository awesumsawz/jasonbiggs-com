# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

This is a personal website built with Laravel 11 that runs **database-free** using static JSON files and markdown content. The architecture prioritizes simplicity and fast deployment without requiring database infrastructure.

## Key Architecture Patterns

### Database-Free Data Layer
- **Models without Eloquent**: Models like `Pages` and `ProfessionalExperience` read directly from JSON files in `data/` directory
- **JSON-based content**: `data/pages.json` and `data/professional-experiences.json` store structured page content
- **File-based storage**: Sessions, cache, and queues all use file drivers (no database/Redis required)

### Blog System Architecture
- **Markdown files with YAML front matter**: Blog posts stored in `content/blog/` as `.md` files
- **Filename convention**: `YYYY-MM-DD-slug.md` format for posts
- **Front matter structure**: YAML metadata includes `title`, `date`, `excerpt`, `tags`, `featured_image`
- **Custom markdown processor**: `BlogPostController` uses League CommonMark with custom `ImageDimensionsExtension`
- **Image dimensions syntax**: Supports `![alt](image.jpg =300x200)` for dimensions and `{cover}`, `{position=X Y}` for styling

### Custom Tailwind Configuration
The project uses a highly customized Tailwind config (`tailwind.config.js`) that mirrors legacy SASS variables:
- Custom color palette: `primary`, `secondary` with variants (`light`, `hover`, `dark`)
- Custom font families: `DDC Hardware`, `Roboto Mono`, `Open Sans`
- Custom font sizes matching SASS: `3xl` = 1.6rem, `9xl` = 4rem
- Custom spacing, shadows (`layer0`, `layer1`, `layer2`), and z-index scales
- Typography plugin configured for blog content with dark mode support

### CommonMark Extension
`App\Extensions\ImageDimensionsExtension` processes markdown images to:
- Extract dimensions from URL syntax: `=WIDTHxHEIGHT`
- Convert to inline styles instead of width/height attributes
- Handle `{cover}` attribute for `object-fit: cover`
- Parse `{position=X Y}` for `object-position` CSS property

## Development Commands

### Starting Development Environment
```bash
composer dev
```
This runs concurrently (using bun concurrently):
- Laravel development server (`php artisan serve`)
- Queue listener (`php artisan queue:listen --tries=1`)
- Laravel Pail for logs (`php artisan pail --timeout=0`)
- Vite development server (`bun run dev`)

### Individual Services
```bash
# Laravel server only
php artisan serve

# Vite only
bun run dev

# Queue listener
php artisan queue:listen --tries=1

# View logs
php artisan pail
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/BlogPostControllerTest.php

# Run specific test
php artisan test --filter test_blog_post_index
```

### Building for Production
```bash
# Build frontend assets
bun run build

# Optimize Laravel
php artisan optimize
```

### Code Quality
```bash
# Laravel Pint (PHP CS Fixer)
./vendor/bin/pint

# ESLint (JavaScript)
bunx eslint resources/js/**/*.js
```

## Content Management

### Updating Page Content
Edit JSON files in `data/` directory:
- `pages.json`: Page content keyed by `slug` and `key` fields
- `professional-experiences.json`: Resume work history with `display_order` for sorting

### Adding Blog Posts
Create markdown file in `content/blog/`:

```markdown
---
title: Your Post Title
date: YYYY-MM-DD
excerpt: A short description
tags: [tag1, tag2]
featured_image: /images/your-image.jpg
---

# Your post content here
```

Image syntax with dimensions:
```markdown
![Alt text](image.jpg =300x200)
![Cover image](hero.jpg =1200x400){cover}
![Positioned image](photo.jpg =500x300){position=50% 25%}
```

## Deployment Notes

### Digital Ocean App Platform
- **Build command**: `composer install --no-dev --optimize-autoloader && bun install && bun run build`
- **Run command**: `php artisan optimize && php artisan serve --host=0.0.0.0 --port=8080`
- **Required environment variables**: `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY`, `SESSION_DRIVER=file`, `CACHE_STORE=file`, `QUEUE_CONNECTION=sync`
- **No database required**: All drivers use file-based storage

### Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

No database migrations needed - application is fully file-based.

## Important Patterns to Follow

### Adding New Pages
1. Routes defined in `routes/web.php` as closures (not controllers for simple pages)
2. Fetch content using `Pages::getBySlugAndKey('page-slug', 'content-key')`
3. Pass data to views via `compact()` or array

### Working with Blog Posts
- `BlogPostController::getAllPosts()` returns all posts sorted by date
- `BlogPostController::parsePost()` handles markdown parsing and front matter extraction
- Date handling prioritizes: front matter date → filename date → file modification time
- Custom markdown processing happens in `markdownToHtml()` and `preprocessImageDimensions()`

### Styling Conventions
- Use Tailwind utility classes first
- Custom colors: `text-primary`, `bg-secondary-light`, `text-dark-gray`
- Dark mode: `dark:` prefix with `class` strategy
- Typography: Use `@tailwindcss/typography` plugin with custom configuration
- Spacing: Use defined scale (`spacing-standard` = `12` = `3rem`)

## Project Structure
- `app/Models/`: File-based models (no Eloquent for main content)
- `app/Http/Controllers/`: Controllers (mainly `BlogPostController`)
- `app/Extensions/`: Custom CommonMark extensions
- `app/Helpers.php`: Global helper functions (autoloaded via composer.json)
- `data/`: JSON data files (replaces database tables)
- `content/blog/`: Markdown blog posts
- `resources/js/`: JavaScript modules (app.js, dark-mode.js, showcase.js)
- `resources/css/`: Tailwind CSS entry point
- `resources/views/`: Blade templates

## Common Gotchas

- **No database**: Don't create migrations or use Eloquent query builder for content
- **BlogPost model exists but isn't used**: Legacy model from before file-based refactor (has $table property but no actual database)
- **Image dimensions**: Use custom syntax in markdown, not standard HTML
- **Date formatting**: Blog posts handle multiple date formats; check `parsePost()` for logic
- **Tailwind custom config**: Many utility classes differ from defaults; reference `tailwind.config.js`
