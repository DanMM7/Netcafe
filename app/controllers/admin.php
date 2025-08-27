<?php

class Admin extends Controller {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function index() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $data['page_title'] = "Admin Dashboard";
        $this->view('admin/dashboard', $data);
    }

    public function login() {
        $data['page_title'] = "Admin Login";
        $data['errors'] = [];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            // Process login
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validate input
            if(empty($username)) $data['errors'][] = "Username is required";
            if(empty($password)) $data['errors'][] = "Password is required";

            if(empty($data['errors'])) {
                $this->db->query("SELECT * FROM users WHERE username = ? AND role = 'admin' LIMIT 1");
                $this->db->bind(1, $username);
                $admin = $this->db->single();

                if($admin && password_verify($password, $admin->password)) {
                    // Login successful
                    $_SESSION['admin_id'] = $admin->id;
                    $_SESSION['admin_username'] = $admin->username;
                    
                    header("Location: " . ROOT . "admin");
                    exit();
                } else {
                    $data['errors'][] = "Invalid username or password";
                }
            }
        }

        $this->view('admin/login', $data);
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        header("Location: " . ROOT . "admin/login");
        exit();
    }

    // Category Management Methods
    public function categories() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $data['page_title'] = "Manage Categories";
        $data['errors'] = [];
        $data['success'] = "";

        // Get all categories
        $this->db->query("SELECT * FROM categories ORDER BY id DESC");
        $data['categories'] = $this->db->resultSet();

        $this->view('admin/categories', $data);
    }

    public function add_category() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if(empty($name)) {
                $response['message'] = "Category name is required";
            } else {
                // Check if category already exists
                $this->db->query("SELECT id FROM categories WHERE name = ? LIMIT 1");
                $this->db->bind(1, $name);
                if($this->db->single()) {
                    $response['message'] = "Category already exists";
                } else {
                    // Add new category
                    $this->db->query("INSERT INTO categories (name, description) VALUES (?, ?)");
                    $this->db->bind(1, $name);
                    $this->db->bind(2, $description);

                    if($this->db->execute()) {
                        $response['success'] = true;
                        $response['message'] = "Category added successfully";
                    } else {
                        $response['message'] = "Error adding category";
                    }
                }
            }
        }

        echo json_encode($response);
        exit();
    }

    public function edit_category() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if(empty($name)) {
                $response['message'] = "Category name is required";
            } else {
                // Check if category exists with same name but different id
                $this->db->query("SELECT id FROM categories WHERE name = ? AND id != ? LIMIT 1");
                $this->db->bind(1, $name);
                $this->db->bind(2, $id);
                if($this->db->single()) {
                    $response['message'] = "Category name already exists";
                } else {
                    // Update category
                    $this->db->query("UPDATE categories SET name = ?, description = ? WHERE id = ?");
                    $this->db->bind(1, $name);
                    $this->db->bind(2, $description);
                    $this->db->bind(3, $id);

                    if($this->db->execute()) {
                        $response['success'] = true;
                        $response['message'] = "Category updated successfully";
                    } else {
                        $response['message'] = "Error updating category";
                    }
                }
            }
        }

        echo json_encode($response);
        exit();
    }

    public function delete_category() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'];

            // Check if category has menu items
            $this->db->query("SELECT id FROM menu_items WHERE category_id = ? LIMIT 1");
            $this->db->bind(1, $id);
            if($this->db->single()) {
                $response['message'] = "Cannot delete category. It has menu items associated with it.";
            } else {
                // Delete category
                $this->db->query("DELETE FROM categories WHERE id = ?");
                $this->db->bind(1, $id);

                if($this->db->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Category deleted successfully";
                } else {
                    $response['message'] = "Error deleting category";
                }
            }
        }

        echo json_encode($response);
        exit();
    }
}
