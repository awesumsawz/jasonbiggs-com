# jason-biggs.com

## Overview
This is a personal website for Jason Biggs built with Laravel 11, using modern web development practices. The application runs **without a database**, using static JSON files for content and markdown files for blog posts. This makes deployment simple and fast.

## Technologies Used
- **Laravel 11** - PHP framework
- **React** - For dynamic, interactive components
- **Tailwind CSS** - For styling with custom configuration
- **Vite** - Frontend build tool
- **Bun** - Fast JavaScript runtime and package manager
- **Pest** - PHP testing framework

## Features
- **Database-free architecture** - Uses JSON files for data storage (`data/` directory)
- **Markdown-based blog system** with YAML front matter support (`content/blog/` directory)
- Dark mode toggle
- Responsive design for mobile, tablet and desktop views
- Custom font integration (DDC Hardware, Roboto Mono, Open Sans)

## Requirements
- PHP 8.2+
- Bun 1.0+ (or Node.js 20+ if you prefer npm)
- Composer

## Installation

1. Clone the repository
```bash
git clone https://github.com/awesumsawz/jason-biggs-com_laravel.git
cd jason-biggs-com_laravel
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
bun install
```

4. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

**Note:** No database setup required! The application uses file-based sessions, cache, and static JSON files for content.

## Development

Start the development server:
```bash
composer dev
```

This will concurrently run:
- Laravel development server
- Queue listener
- Laravel Pail for logs
- Vite development server

Or run services individually:
```bash
php artisan serve
bun run dev
```

## Blog System

The blog system uses markdown files with YAML front matter stored in the `content/blog` directory. Each post should include:

```markdown
---
title: Post Title
date: YYYY-MM-DD
excerpt: A short description of the post
featured_image: /images/image-path.jpg
tags: [tag1, tag2]
---

# Post content in Markdown
```

## Testing

Tests are written using Pest, a progressive PHP testing framework:

```bash
php artisan test
```

## Building for Production

```bash
bun run build
```

## Directory Structure
- `app/` - Contains the core code of the application
- `resources/` - Contains views, CSS, and JavaScript
- `routes/` - Contains route definitions
- `public/` - Publicly accessible files
- `content/blog/` - Markdown files for blog posts
- `data/` - JSON files for page content and data (replaces database)
  - `pages.json` - Page content (home, web, resume)
  - `professional-experiences.json` - Resume professional experience
- `tests/` - Pest tests for the application

## Deployment

This application can be deployed to various platforms without requiring a database:

### Digital Ocean App Platform (Recommended)
Simple, managed deployment with automatic builds from Git.

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && bun install && bun run build
```

**Run Command:**
```bash
php artisan optimize && php artisan serve --host=0.0.0.0 --port=8080
```

**Environment Variables:**
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (generate with `php artisan key:generate --show`)
- `SESSION_DRIVER=file`
- `CACHE_STORE=file`
- `QUEUE_CONNECTION=sync`

### Traditional VPS
Deploy to any VPS with PHP 8.2+, Nginx/Apache, and Bun (or Node.js). No database required!

**Basic Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/jason-biggs-com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Shared Hosting
Compatible with shared hosting that supports PHP 8.2+ and allows setting document root to `public/`.

## Content Management

### Updating Page Content
Edit JSON files in the `data/` directory and commit changes to Git.

### Adding Blog Posts
Create markdown files in `content/blog/` with YAML front matter:

```markdown
---
title: Post Title
date: YYYY-MM-DD
excerpt: A short description
tags: [tag1, tag2]
---

# Your content here
```

## License
MIT