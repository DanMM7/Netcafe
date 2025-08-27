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
}
