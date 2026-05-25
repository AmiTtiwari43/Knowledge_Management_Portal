# Knowledge Portal (LMS Platform)

A full-stack, scalable Learning Management System (LMS) designed for content creators and students. The platform allows instructors to build rich courses, sections, and lectures, while providing students with an intuitive interface to enroll, take quizzes, and track progress.

## 🚀 Features

- **Role-Based Access Control:** Secure portals tailored for Admins, Instructors, and Students.
- **Instructor Dashboard:** Course creation, curriculum management, and performance tracking.
- **Student Dashboard:** Course tracking, rich video player, dynamic quizzes, and personalized notes.
- **Admin Dashboard:** Real-time analytics, user management, and revenue tracking.

- **Dynamic UI:** Built with Laravel Livewire and Alpine.js for a reactive, SPA-like experience without writing heavy custom JavaScript.

## 💻 Tech Stack

- **Backend:** Laravel 12.x, PHP 8.2
- **Frontend:** Laravel Blade, Livewire 4.x, Alpine.js, Tailwind CSS 4.0
- **Database:** SQLite (Local) / PostgreSQL (Production ready)
- **Key Packages:**
  - `spatie/laravel-permission`: Advanced role & permission management.
  - `stripe/stripe-php`: Secure payment gateway integration.
  - `spatie/laravel-medialibrary` & `intervention/image`: Robust media and file handling.
  - `barryvdh/laravel-dompdf`: Automated certificate generation.
  - `laravel/socialite`: OAuth Authentication (Google Login).

## 🛠️ Local Setup

1. **Clone the repository**
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install NPM dependencies:**
   ```bash
   npm install
   ```
4. **Environment Setup:**
   Copy `.env.example` to `.env` and configure your database and Stripe keys.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. **Database Migration & Seeding:**
   ```bash
   php artisan migrate:fresh --seed
   ```
6. **Run Development Servers:**
   ```bash
   php artisan serve
   npm run dev
   ```

## 🌐 Deployment
This application is fully optimized for deployment on modern PaaS providers like **Render**, **Railway**, or **Laravel Forge**. Set your `DB_CONNECTION` to `pgsql` or `mysql` in production for persistent data storage.
