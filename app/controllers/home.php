<?php

    Class Home extends Controller{
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }
        
        public function index() {
            $data['page_title'] = 'Netcafe - Welcome';
            
            // Get featured menu items
            $this->db->query("SELECT m.*, c.name as category_name 
                            FROM menu_items m 
                            LEFT JOIN categories c ON m.category_id = c.id 
                            WHERE m.is_available = 1 
                            ORDER BY RAND() 
                            LIMIT 6");
            $data['featured_items'] = $this->db->resultSet();
            
            $this->view('Netcafe/index', $data);
        }

        public function about() {
            $data['page_title'] = 'About Us - Netcafe';
            
            // Get staff members (users with role 'staff')
            $this->db->query("SELECT name, role FROM users WHERE role = 'staff' ORDER BY name");
            $data['staff'] = $this->db->resultSet();
            
            $this->view('Netcafe/about', $data);
        }

        public function setup() {
            try {
                // Create Users Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS users (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        username VARCHAR(50) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        role ENUM('admin', 'staff') NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )
                ");

                // Create Categories Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS categories (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(50) NOT NULL,
                        description TEXT,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )
                ");

                // Create Menu Items Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS menu_items (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        category_id INT,
                        name VARCHAR(100) NOT NULL,
                        description TEXT,
                        price DECIMAL(10,2) NOT NULL,
                        image VARCHAR(255),
                        is_available BOOLEAN DEFAULT TRUE,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (category_id) REFERENCES categories(id)
                    )
                ");

                // Create Orders Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS orders (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        user_id INT,
                        customer_name VARCHAR(100) NOT NULL,
                        customer_email VARCHAR(100),
                        customer_phone VARCHAR(20),
                        total_amount DECIMAL(10,2) NOT NULL,
                        status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    )
                ");

                // Create Order Items Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS order_items (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        order_id INT,
                        menu_item_id INT,
                        quantity INT NOT NULL,
                        price DECIMAL(10,2) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (order_id) REFERENCES orders(id),
                        FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
                    )
                ");

                // Create default admin user
                $this->db->executeSQL("
                    INSERT INTO users (username, password, email, role)
                    SELECT 'admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'admin@netcafe.com', 'admin'
                    WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin')
                ");

                echo "Database setup completed successfully!";
                
            } catch(Exception $e) {
                echo "Error setting up database: " . $e->getMessage();
            }
        }
    }

