# POS System

A Point of Sale (POS) system built with Laravel framework for managing sales, inventory, and customer orders.

## About This Project

This is a web-based Point of Sale application designed to help businesses manage their sales operations, inventory, and customer transactions efficiently.

## Language

**English** | [**日本語**](./README.ja.md)

## 📄 Portfolio Description (For Screening)

### Product Name

POS System

### Development Period

Start date: October 16, 2024  
End date: December 16, 2025

### Purpose / Background

POS System is a Laravel application built with the image of an online shop and store management.

I started this project because I wanted to create a system for my family that would allow them to manage and sell products online. The goal was to let my family register products and check orders, while customers could browse and purchase products.

However, in Myanmar, depending on the region, internet/Wi‑Fi can be unstable and power outages are frequent, so it was difficult to move this system into real-world operation quickly. Even so, through this project I was able to gain experience building a web application while thinking about the features needed for actual stores and online shops.

The main purpose of this project was to learn how to build business-system-like features with Laravel, such as product management, order management, cart, payment, and user management. In addition to building screens, I also focused on learning database design, authentication, authorization, and how to handle data securely.

### Key Features

- Separate screens by role (Admin / Customer)
- Product category management
- Product create/edit/delete
- Product listing
- Product search
- Filters and sorting
- Cart
- Checkout
- Order history
- Payment method management
- Payment history
- Comments, ratings, and contact feature
- Admin profile / account management

### Technologies Used

- Laravel
- PHP
- Blade
- Tailwind CSS
- Bootstrap
- jQuery
- Laravel Breeze
- Sanctum
- Socialite
- Vite
- MySQL

### My Responsibilities

This was a personal project. I handled everything myself, including the admin screens, customer screens, product management, category management, cart, order & payment-related features, integrating templates across screens, and overall testing.

### What I Worked Hard On

The hardest part was building this while learning many things from scratch.

At the beginning, there were many areas I didn’t understand well, such as Laravel routing, controllers, Blade templates, Eloquent, migrations, authentication, and authorization. In particular, database design—how to connect product, user, order, and payment data—was challenging.

I also focused on separating features available to admins vs customers. Admins can manage products and orders, while customers can search for products, add them to the cart, and place orders.

Because online shops handle user and order information, I learned how important it is to handle data securely. I implemented the system while studying authentication, roles/permissions, input forms, and the overall flow of storing data.

During development I encountered many issues such as routing errors, database errors, broken layouts, and authentication-related problems. Each time, I read the error messages, checked official documentation and references, and fixed them step by step.

Through this project, I learned not only how to write code, but also the importance of designing admin/customer screens and data flow while thinking about real users.

### Future Improvements

Once Myanmar’s internet and power situation becomes more stable, I would like to develop this system further into a more practical online shop.

Also, since I aim to become an AI engineer, in the future I would like to integrate AI agents and MCP to build a more automated agentic app.

For example, an admin could type natural-language requests such as “Show me the best-selling products this week,” “List products with low stock,” or “Create a description for a new product,” and the AI agent could query the database, summarize the necessary information, or generate product descriptions.

From a technical perspective, I’d like to improve route/controller naming, add more tests, stabilize payment processing, improve the README, organize seed data, and strengthen security.

## Tech Stack

- **Framework:** Laravel 11.9 (PHP 8.2+)
- **Authentication:** Laravel Breeze, Sanctum, Socialite
- **Frontend:** Blade templating engine, Tailwind CSS
- **Build Tool:** Vite
- **Notifications:** RealRashid SweetAlert
- **Debug Tool:** Laravel Debugbar (Development)
- **Package Manager:** Composer, NPM

## System Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite database
- Web server (Apache/Nginx)

## Key Features

### 🔐 Authentication & Authorization

- **Laravel Breeze** - Authentication scaffolding with login, registration, password reset
- **Laravel Sanctum** - API token authentication
- **Social Login (Laravel Socialite)** - Login with Google, GitHub, and other providers
- **Role-Based Access Control** - Three user roles: 
  - **Super Admin** - Full system access including admin management
  - **Admin** - Category, product, order, and payment management
  - **User/Customer** - Shopping and order placement
- **Middleware Protection** - Route-level access control (`admin`, `superadmin`, `user` middleware)

### 👥 User Management (Super Admin Only)

- Create new admin accounts
- View admin list
- Delete admin accounts
- View user/customer list
- Delete user accounts

### 📦 Product Management (Admin)

- Create new products
- List all products with pagination
- Update product details
- Delete products
- View product descriptions
- Product images upload

### 📂 Category Management (Admin)

- Create categories
- List all categories
- Update categories
- Delete categories

### 💳 Payment Method Management (Admin)

- Add payment methods
- List payment methods
- Update payment methods
- Delete payment methods

### 🛒 Customer Shopping Features

- Browse products by category
- View product details
- Add products to cart
- View shopping cart
- Remove items from cart
- Place orders
- View order list
- Product rating system
- Product comment/review system
- Delete own comments

### 📦 Order Management

- **Admin Side:**
  - View all orders
  - View order details
  - Change order status
  - Confirm orders
  - Reject orders
  
- **Customer Side:**
  - View order history
  - Track order status

### 👤 Profile Management

- **Admin Profile:**
  - View profile
  - Edit profile information
  - Change password
  
- **Customer Profile:**
  - View customer information
  - Update personal information
  - Change password

### 📞 Contact System

- Contact form for customers
- Submit contact messages

### 🔌 API Endpoints

- User authentication (Sanctum protected)
- Product list API
- Delete API

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/heinaungtesting/pos.git
cd pos
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit `.env` file and configure your database: 

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Configure Social Login

Set up social authentication providers in `.env`:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback

# GitHub OAuth (or other providers)
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URL=http://localhost:8000/auth/github/callback
```

### 6. Run Migrations

```bash
# Run database migrations
php artisan migrate

# (Optional) Seed database with sample data
php artisan db:seed
```

### 7. Build Assets

```bash
# Build for production
npm run build

# Or run development server with hot reload
npm run dev
```

### 8. Start the Application

```bash
# Start Laravel development server
php artisan serve
```

The application will be available at `http://localhost:8000`

## Database Structure

The system includes the following tables:

- **users** - User accounts and roles
- **products** - Product catalog
- **categories** - Product categories
- **orders** - Customer orders
- **carts** - Shopping cart items
- **payments** - Payment methods
- **payment_histories** - Payment transaction logs
- **discounts** - Discount management
- **ratings** - Product ratings
- **comments** - Product comments and reviews
- **contacts** - Customer contact messages
- **action_logs** - System activity audit trail

## User Roles & Permissions

### Super Admin
- All admin permissions
- Create/delete admin accounts
- Manage users

### Admin
- Manage categories (create, update, delete)
- Manage products (create, update, delete)
- Manage orders (view, confirm, reject, change status)
- Manage payment methods
- Edit profile and change password

### User/Customer
- Browse products
- Add to cart and checkout
- Place orders and view order history
- Rate and comment on products
- Manage profile
- Submit contact messages

## Routes Structure

### Admin Routes (`/admin/*`)
- Requires `admin` middleware
- `/admin/home` - Admin dashboard
- `/admin/category/*` - Category management
- `/admin/product/*` - Product management
- `/admin/order/*` - Order management
- `/admin/profile/*` - Admin profile & user management

### Customer Routes (`/customer/*`)
- Requires `user` middleware
- `/customer/home` - Customer homepage
- `/customer/product/detail/{id}` - Product details
- `/customer/cart` - Shopping cart
- `/customer/orderlist` - Order history
- `/customer/profile/*` - Customer profile management

### API Routes (`/api/*`)
- `/api/user` - Get authenticated user (Sanctum protected)
- `/api/product/list` - Get product list
- `/api/delete` - Delete resource

## Development

### Running in Development Mode

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server for hot reload
npm run dev
```

### Code Formatting

```bash
# Format code using Laravel Pint
./vendor/bin/pint
```

## Testing

```bash
# Run all tests
php artisan test
```

## Deployment

This project includes configuration files for: 

- **Docker** - `dockerfile`
- **Vercel** - `vercel.json`
- **Netlify** - `netlify.toml`

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure database credentials
- [ ] Set up SSL certificate
- [ ] Configure social login credentials
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Build assets:  `npm run build`

## Security Features

- CSRF protection on all forms
- Password hashing with bcrypt
- Role-based middleware protection
- Sanctum API authentication
- XSS protection
- SQL injection prevention through Eloquent ORM

## License

This project is private and proprietary. 

---

**Laravel Version:** 11.9  
**PHP Version:** 8.2+
