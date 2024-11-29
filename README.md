# **Library Application**

Welcome to this application! This application is built using **Laravel 11**, **Filament** for the admin panel, and **Tailwind CSS** for front-end styling. This guide will help you to clone and run this application on your device.

## Features

-   **Modern Framework**: Built using Laravel 11.
-   **Admin Panel**: Uses Filament for quick and easy data management.
-   **Front-End Styling**: Uses Tailwind CSS for a modern and responsive design.
-   **Easy to Develop**: Neat and adaptable code structure.

## Requirements

Make sure your device has:

-   **PHP** version 8.2 or later
-   **Composer** latest version
-   **Node.js** and **npm** (for front-end builds)
-   **Database**: MySQL, PostgreSQL, or any other database you use.

## How to Run the Application

Follow these steps to run this app on your device:

#### 1. Clone Repository

Clone this repository using the following command:

```bash
git clone https://github.com/dhearr/perpustakaan.git
```

Open the file you just cloned in your favorite code editor.

#### 2. Install Dependencies

Run the following command to install PHP dependencies:

```bash
composer install
```

```bash
npm install
```

#### 3. Configure the `.env` File

Create a `.env` file in your root directory, then copy the `.env.example` file to the `.env` file:

```bash
// File .env.example

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_name_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Customize your database configuration in the `.env` file.

#### 4. Generate Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

#### 5. Database Migration

Run the migration to create the necessary tables:

```bash
php artisan migrate
```

#### 6. Build Front-End Asset

Run the following command to build the asset with Tailwind CSS:

```bash
npm run dev
```

#### 7. Run the Server

Run the application using the command:

```bash
php artisan serve
```

Access your application at http://localhost:8000 or http://127.0.0.1:8000. You can already use this application.

## Contributions

We welcome your contributions. If you find problems or have ideas for new features, please create an issue or submit a pull request in this repository.
