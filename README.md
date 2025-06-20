# README 

## Overview

The `fst_rh_back-end` repository is a backend application built using the Laravel framework. It provides a robust and scalable solution for web applications, leveraging Laravel's powerful features.

## Features

- Expressive Routing: Simple and fast routing engine.
- Dependency Injection: Powerful dependency injection container.
- Session and Cache Storage: Multiple back-ends for session and cache storage.
- Database ORM: Expressive and intuitive database ORM.
- Schema Migrations: Database agnostic schema migrations.
- Background Job Processing: Robust background job processing capabilities.
- Real-time Event Broadcasting: Support for real-time event broadcasting.

## Installation

To set up the project locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/AbardiySohayb/fst_rh_back-end.git
   ```

2. Navigate to the project directory:
   ```bash
   cd fst_rh_back-end
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Set up the environment file:
   - Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   - Update the `.env` file with your database and application settings.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start the server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000` after starting the server.
- Use the provided routes to interact with the backend services.


