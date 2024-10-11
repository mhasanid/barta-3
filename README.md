# Barta App

Barta App is a Laravel-based web application for managing user profiles, authentication, and dashboard functionalities. This project demonstrates user authentication, profile management, and secure password handling using Laravel.

## Features

- User registration and login
- Profile view and update
- Dashboard with user-specific data
- Secure password hashing and verification

## Installation

To set up the project locally, follow these steps:

### Prerequisites

Ensure you have the following installed:
- PHP >= 8.0
- Composer
- Sqlite database
- Laravel (installed via Composer)

### Clone the Repository
```bash
git clone https://github.com/yourusername/barta-app.git
cd barta-app
```

### Install Dependencies
```bash
composer install
```

### Set Up Environment File
```bash
cp .env.example .env
```

### Generate Application Key
```bash
php artisan key:generate
```

### Run Migrations
```bash
php artisan migrate
```

### Seed the Database (Optional)
```bash
php artisan db:seed
```

### Serve the Application
```bash
php artisan serve
```

## Usage
### Authentication
- Register: Navigate to /register to create a new user account.
- Login: Navigate to /login to log in with your credentials.
### User Profile
- View Profile: Navigate to /profile to view your profile information.
- Edit Profile: Use /profile/edit to update your profile information.
### Dashboard
- Dashboard: Access the user dashboard at /home.