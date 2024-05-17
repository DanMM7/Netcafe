# Netcafe Web App

Welcome to the E-Commerce Web Application! This project is built using a custom PHP framework that follows the MVC (Model-View-Controller) architecture and OOP (Object-Oriented Programming) principles. This application provides a robust platform for managing products, orders, and users.

## Features

- User authentication and authorization
- Product catalog with categories
- Shopping cart functionality
- Order processing and management
- Admin panel for managing products, orders, and users
- Responsive design for desktop and mobile devices

## Technologies Used

- PHP
- MySQL
- HTML, CSS, JavaScript
- Composer for dependency management
- Dotenv for environment variables
- Custom MVC framework

## Project Structure

```plaintext
project/
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ProductController.php
│   │   ├── CartController.php
│   │   ├── OrderController.php
│   │   └── AdminController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── Category.php
│   ├── Views/
│   │   ├── auth/
│   │   ├── products/
│   │   ├── cart/
│   │   ├── orders/
│   │   └── admin/
│   ├── Helpers/
│   ├── Middleware/
│   ├── Config/
│   └── Routes/
│       └── web.php
├── public/
│   ├── index.php
│   └── assets/
├── vendor/
├── .env
├── composer.json
└── .htaccess
```

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/ecommerce-webapp.git
   cd ecommerce-webapp
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Set up the environment variables:**

   Rename the `.env.example` file to `.env` and configure your environment variables (database credentials, etc.).

4. **Run the database migrations:**

   Ensure your MySQL server is running and create a database for the project. Then, run the migrations to set up the database schema.

   ```bash
   php vendor/bin/phinx migrate
   ```

5. **Start the development server:**

   ```bash
   php -S localhost:8000 -t public
   ```

   Your application should now be accessible at `http://localhost:8000`.

## Usage

- **User Registration and Login:**
  Users can register for an account and log in to access the product catalog and manage their shopping cart and orders.

- **Product Management:**
  Admin users can add, edit, and delete products from the admin panel.

- **Order Processing:**
  Users can add products to their cart, proceed to checkout, and place orders. Admin users can view and manage all orders.

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request with your changes. Make sure to follow the coding standards and write meaningful commit messages.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or need further assistance, please contact [yourname@domain.com].

```

This README file provides an overview of the e-commerce web application, including its features, technologies used, project structure, installation instructions, usage information, contribution guidelines, license, and contact details. Feel free to customize it to better suit your project's specific details and requirements.
