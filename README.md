# Laravel Ecommerce

A full-featured e-commerce application built with Laravel and Tailwind CSS, developed as part of my OJT program to learn full-stack development.

## Technologies Used
- Laravel
- Tailwind CSS
- Alpine.js
- Vite
- PayPal SDK
- MySQL

## Features

- **Product Management**: Browse, view, and manage products
- **Shopping Cart**: Add/remove products, view cart contents
- **Order Processing**: Create and track orders
- **Payment Integration**: Supports PayPal and Cash on Delivery (COD)
- **User Authentication**: Registration, login, and profile management
- **Rating System**: Customers can rate purchased products
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Admin Dashboard**: Manage products, orders, and users

## Installation

1. Clone the repository:
```bash
git clone https://github.com/jei3m/laravel-ecommerce.git
```

2. Navigate to the project directory:
```bash
cd laravel-ecommerce
```

3. Install all required dependencies
```bash
composer install
npm install
```

4. Set up the environmental variables. Create a .env file in the root directory.
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# PAYPAL CLIENT
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=
PAYPAL_SANDBOX_CLIENT_SECRET=
```

5. Set up the database by running the following commands:
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
php artisan migrate:fresh --seed
```

6. Start the Vite development server (for frontend assets).
```bash
npm run dev
```

7. Start the Laravel development server in another terminal:
```bash
php artisan serve
```

## Usage
Once the development server is running, open your browser and navigate to http://127.0.0.1:8000. Here's what you can do:

### For Customers:
1. **Browse Products**: View all available products on the homepage
2. **Product Details**: Click on any product to see more details
3. **Add to Cart**: Select quantity and add products to your shopping cart
4. **Checkout**: 
   - View your cart contents
   - Proceed to checkout
   - Choose payment method (PayPal or Cash on Delivery)
   - Complete your order
5. **Account Management**:
   - Register/Login to your account
   - View order history
   - Update profile information
6. **Rate Products**: After receiving an order, you can rate purchased products

### For Admin Users:
1. **Dashboard**: Access admin features at `/admin` (requires admin privileges)
2. **Manage Products**:
   - Add new products with images, descriptions, and pricing
   - Edit/Delete existing products
3. **Manage Orders**:
   - View all customer orders
   - Update order status (Processing, Shipped, Delivered, etc.)
4. **User Management**:
   - View registered users
   - Assign admin privileges
5. **Reports**: View sales reports and analytics

### Testing Payment Integration:
1. For PayPal Sandbox testing:
   - Use sandbox accounts from developer.paypal.com
   - Test both successful and failed payment scenarios
2. For Cash on Delivery:
   - Orders will be marked as pending until manually confirmed