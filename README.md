# Jason Biggs Portfolio

## 📌 Overview

This is my personal portfolio website, built with Laravel, PHP, vanilla JavaScript, and SASS. The site showcases my work, skills, and experience as a web developer.

You can visit the (live version here)[https://jason-biggs.com].

## 🛠️ Technologies Used

Backend: Laravel, PHP

Frontend: Vanilla JavaScript (for now), SASS (for now)

Database: SQLite (for now)

Deployment: Hosted on Linode, with GitLab CI/CD

## 🚀 Features

Dynamic project showcase

Responsive design for all devices

## 🏗️ Setup & Installation

### Prerequisites

Ensure you have the following installed:

- PHP 8.2 or higher 
- Composer
- Node.js and npm
- SQLite

### Installation Steps

#### Clone the repository:

git clone https://github.com/your-username/your-repository.git
cd your-repository

#### Install dependencies:

composer install
npm install

#### Set up your .env file:

- cp .env.example .env
- Configure database credentials and other settings.

#### Generate application key:

- php artisan key:generate

#### Run database migrations:

- php artisan migrate --seed

#### Compile assets:

- npm run dev  # For development
- npm run build  # For production

#### Start the development server:

- php artisan serve

Visit http://127.0.0.1:8000 in your browser.

## 📜 License

This project is licensed under the MIT License - see the LICENSE file for details.
