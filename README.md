# ECommerce API

This project is a simple CRUD API for managing products in an eCommerce application, built with Laravel 10.

## Features

- CRUD operations for products


## Technologies

- PHP
- Laravel 10
- MySQL


## Getting Started

### Prerequisites

- PHP (>= 8.1)
- Composer
- MySQL
- Git

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/suryamdlsk/ecommerceapi.git
    cd ecommerce-api
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up the environment:
    ```bash
    cp .env.example .env
    ```
    Update the `.env` file with your database credentials.

4. Run migrations:
    ```bash
    php artisan migrate
    ```



5. Run the application:
    ```bash
    php artisan serve
    ```

### API Documentation

API documentation is available at `http://localhost:8000/api/documentation`.

### API Endpoints

- `GET /api/products` - List all products
- `POST /api/products` - Create a new product
- `GET /api/products/{id}` - Get a product by ID
- `PUT /api/products/{id}` - Update a product by ID
- `DELETE /api/products/{id}` - Delete a product by ID


