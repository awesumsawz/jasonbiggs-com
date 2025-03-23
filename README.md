# jason-biggs.com

## Overview
This is a personal website for Jason Biggs built with Laravel 11, using modern web development practices. The site features a blog system using markdown files, a responsive design with dark mode support, and React for interactive components.

## Technologies Used
- **Laravel 11** - PHP framework
- **React** - For dynamic, interactive components
- **Tailwind CSS** - For styling with custom configuration
- **PostgreSQL** - Database
- **Vite** - Frontend build tool
- **Pest** - PHP testing framework

## Features
- Markdown-based blog system with front matter support
- Dark mode toggle
- Responsive design for mobile, tablet and desktop views
- Custom font integration (DDC Hardware, Roboto Mono, Open Sans)

## Requirements
- PHP 8.2+
- Node.js (version specified in .nvmrc)
- Composer
- PostgreSQL

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
npm install
```

4. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your PostgreSQL database in the `.env` file

6. Run migrations
```bash
php artisan migrate
```

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
npm run dev
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
npm run build
```

## Directory Structure
- `app/` - Contains the core code of the application
- `resources/` - Contains views, CSS, and JavaScript
- `routes/` - Contains route definitions
- `public/` - Publicly accessible files
- `content/blog/` - Markdown files for blog posts
- `tests/` - Pest tests for the application

## License
MIT