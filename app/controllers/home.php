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

        public function contact() {
            $data['page_title'] = 'Contact Us - Netcafe';
            $data['errors'] = [];
            $data['success'] = false;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validate form data
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $subject = trim($_POST['subject'] ?? '');
                $message = trim($_POST['message'] ?? '');

                // Validation
                if (empty($name)) {
                    $data['errors']['name'] = 'Name is required';
                }
                if (empty($email)) {
                    $data['errors']['email'] = 'Email is required';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['errors']['email'] = 'Please enter a valid email';
                }
                if (empty($subject)) {
                    $data['errors']['subject'] = 'Subject is required';
                }
                if (empty($message)) {
                    $data['errors']['message'] = 'Message is required';
                }

                // If no errors, process the form
                if (empty($data['errors'])) {
                    try {
                        $this->db->query("INSERT INTO contact_messages (name, email, subject, message) 
                                        VALUES (:name, :email, :subject, :message)");
                        
                        $this->db->bind(':name', $name);
                        $this->db->bind(':email', $email);
                        $this->db->bind(':subject', $subject);
                        $this->db->bind(':message', $message);

                        if ($this->db->execute()) {
                            $data['success'] = true;
                            // You might want to send an email notification here
                        }
                    } catch (Exception $e) {
                        $data['errors']['db'] = 'Sorry, there was an error processing your message. Please try again later.';
                    }
                }
            }
            
            $this->view('Netcafe/contact', $data);
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

                // Create Contact Messages Table
                $this->db->executeSQL("
                    CREATE TABLE IF NOT EXISTS contact_messages (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(100) NOT NULL,
                        email VARCHAR(100) NOT NULL,
                        subject VARCHAR(200) NOT NULL,
                        message TEXT NOT NULL,
                        status ENUM('new', 'read', 'replied') DEFAULT 'new',
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

