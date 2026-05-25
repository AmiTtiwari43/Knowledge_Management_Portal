# Project Description: Knowledge Portal (LMS Platform)

## Overview
The Knowledge Portal is a comprehensive, full-stack Learning Management System (LMS) designed to bridge the gap between content creators and learners. It provides a robust, scalable platform where instructors can author multi-media courses and students can seamlessly purchase, track, and complete their learning journeys.

## What Problem It Solves
Managing external LMS platforms often involves high overhead, lack of customizability, and fragmented analytics. This project solves that by providing an all-in-one, highly performant monolithic application. It allows administrators to have a bird's-eye view of revenue and user metrics, enables instructors to easily monetize their knowledge without third-party fees, and gives students an engaging, interactive learning environment.

## Technology Stack
- **Framework & Core:** Laravel 12.0, PHP 8.2
- **Frontend & Reactivity:** Laravel Livewire 4.3, Alpine.js, Tailwind CSS 4.0, Blade Templates
- **Database:** SQLite (Local/Testing), PostgreSQL (Production target)
- **Tooling:** Vite, NPM, Composer

## Key Features & Unique Implementations (For CV Extraction)

### Architecture & Frontend Performance
- **SPA-Like Reactivity:** Architected the frontend using Laravel Livewire and Alpine.js, eliminating the need for a separate heavy JavaScript framework (like React/Vue) while maintaining lightning-fast, reactive user interfaces.
- **Single-File Components:** Utilized `livewire/volt` to streamline UI components, keeping logic and presentation tightly coupled for maintainability.

### Security & Access Management
- **Role-Based Access Control (RBAC):** Integrated `spatie/laravel-permission` to construct secure, isolated portals for Admins, Instructors, and Students. Protected specific routes and actions to ensure strict data governance.

### Core Business Logic & Data Handling
- **Real-Time Financial Analytics:** Engineered optimized, dynamic Eloquent ORM queries to drive the Admin Dashboard. Shifted logic from static assumptions to calculating true historical revenue based on completed Order data, ensuring 100% financial accuracy for reporting.


### Media & Asset Optimization
- **Advanced Media Handling:** Employed `spatie/laravel-medialibrary` paired with `intervention/image` to optimize user uploads, dynamically scale course thumbnails, and manage heavy video/file assets efficiently.
- **Automated Certification:** Integrated `barryvdh/laravel-dompdf` to automatically generate customized, downloadable PDF certificates for students upon course completion.


