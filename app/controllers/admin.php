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

    // Menu Item Management Methods
    public function menu() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $data['page_title'] = "Manage Menu Items";
        
        // Get all menu items with their categories
        $this->db->query("SELECT m.*, c.name as category_name 
                         FROM menu_items m 
                         LEFT JOIN categories c ON m.category_id = c.id 
                         ORDER BY m.id DESC");
        $data['menu_items'] = $this->db->resultSet();

        // Get categories for the dropdown
        $this->db->query("SELECT * FROM categories ORDER BY name");
        $data['categories'] = $this->db->resultSet();

        $this->view('admin/menu', $data);
    }

    public function add_menu_item() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = floatval($_POST['price']);
            $category_id = intval($_POST['category_id']);
            $is_available = isset($_POST['is_available']) ? 1 : 0;

            // Handle image upload
            $image = '';
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['image']['name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if(in_array($file_ext, $allowed)) {
                    $image_name = uniqid() . '.' . $file_ext;
                    $target_path = "public/assets/Netcafe/images/menu/" . $image_name;
                    
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                        $image = $image_name;
                    }
                }
            }

            if(empty($name)) {
                $response['message'] = "Item name is required";
            } elseif($price <= 0) {
                $response['message'] = "Price must be greater than 0";
            } elseif($category_id <= 0) {
                $response['message'] = "Please select a category";
            } else {
                // Add new menu item
                $this->db->query("INSERT INTO menu_items (name, description, price, category_id, image, is_available) 
                                VALUES (?, ?, ?, ?, ?, ?)");
                $this->db->bind(1, $name);
                $this->db->bind(2, $description);
                $this->db->bind(3, $price);
                $this->db->bind(4, $category_id);
                $this->db->bind(5, $image);
                $this->db->bind(6, $is_available);

                if($this->db->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Menu item added successfully";
                } else {
                    $response['message'] = "Error adding menu item";
                }
            }
        }

        echo json_encode($response);
        exit();
    }

    public function edit_menu_item() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = intval($_POST['id']);
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = floatval($_POST['price']);
            $category_id = intval($_POST['category_id']);
            $is_available = isset($_POST['is_available']) ? 1 : 0;

            // Handle image upload
            $image_sql = "";
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['image']['name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if(in_array($file_ext, $allowed)) {
                    $image_name = uniqid() . '.' . $file_ext;
                    $target_path = "public/assets/Netcafe/images/menu/" . $image_name;
                    
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                        // Delete old image
                        $this->db->query("SELECT image FROM menu_items WHERE id = ?");
                        $this->db->bind(1, $id);
                        $old_image = $this->db->single();
                        if($old_image && $old_image->image) {
                            @unlink("public/assets/Netcafe/images/menu/" . $old_image->image);
                        }
                        
                        $image_sql = ", image = '" . $image_name . "'";
                    }
                }
            }

            if(empty($name)) {
                $response['message'] = "Item name is required";
            } elseif($price <= 0) {
                $response['message'] = "Price must be greater than 0";
            } elseif($category_id <= 0) {
                $response['message'] = "Please select a category";
            } else {
                // Update menu item
                $this->db->query("UPDATE menu_items 
                                SET name = ?, description = ?, price = ?, 
                                    category_id = ?, is_available = ? $image_sql
                                WHERE id = ?");
                $this->db->bind(1, $name);
                $this->db->bind(2, $description);
                $this->db->bind(3, $price);
                $this->db->bind(4, $category_id);
                $this->db->bind(5, $is_available);
                $this->db->bind(6, $id);

                if($this->db->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Menu item updated successfully";
                } else {
                    $response['message'] = "Error updating menu item";
                }
            }
        }

        echo json_encode($response);
        exit();
    }

    public function delete_menu_item() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = intval($_POST['id']);

            // Get the image name before deleting
            $this->db->query("SELECT image FROM menu_items WHERE id = ?");
            $this->db->bind(1, $id);
            $item = $this->db->single();

            // Delete menu item
            $this->db->query("DELETE FROM menu_items WHERE id = ?");
            $this->db->bind(1, $id);

            if($this->db->execute()) {
                // Delete the image file if it exists
                if($item && $item->image) {
                    @unlink("public/assets/Netcafe/images/menu/" . $item->image);
                }
                
                $response['success'] = true;
                $response['message'] = "Menu item deleted successfully";
            } else {
                $response['message'] = "Error deleting menu item";
            }
        }

        echo json_encode($response);
        exit();
    }

    // Order Management Methods
    public function orders() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $data['page_title'] = "Manage Orders";

        // Get all orders with user and status info
        $this->db->query("SELECT o.*, os.name as status_name, 
                         CASE 
                            WHEN o.user_id IS NOT NULL THEN COALESCE(u.name, u.username)
                            ELSE o.customer_name 
                         END as customer_name,
                         CASE 
                            WHEN o.user_id IS NOT NULL THEN u.email
                            ELSE o.customer_email
                         END as customer_email,
                         o.customer_phone
                         FROM orders o 
                         LEFT JOIN order_status os ON o.status_id = os.id 
                         LEFT JOIN users u ON o.user_id = u.id 
                         ORDER BY o.created_at DESC");
        $data['orders'] = $this->db->resultSet();

        // Get order statuses for dropdown
        $this->db->query("SELECT * FROM order_status ORDER BY id");
        $data['statuses'] = $this->db->resultSet();

        $this->view('admin/orders', $data);
    }

    public function order_details($id = null) {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        if(!$id) {
            header("Location: " . ROOT . "admin/orders");
            exit();
        }

        $data['page_title'] = "Order Details";

        // Get order details
        $this->db->query("SELECT o.*, os.name as status_name, 
                         CASE 
                            WHEN o.user_id IS NOT NULL THEN COALESCE(u.name, u.username)
                            ELSE o.customer_name 
                         END as customer_name,
                         CASE 
                            WHEN o.user_id IS NOT NULL THEN u.email
                            ELSE o.customer_email
                         END as customer_email,
                         o.customer_phone
                         FROM orders o 
                         LEFT JOIN order_status os ON o.status_id = os.id 
                         LEFT JOIN users u ON o.user_id = u.id 
                         WHERE o.id = ?");
        $this->db->bind(1, $id);
        $data['order'] = $this->db->single();

        if(!$data['order']) {
            header("Location: " . ROOT . "admin/orders");
            exit();
        }

        // Get order items
        $this->db->query("SELECT oi.*, mi.name, mi.image 
                         FROM order_items oi 
                         LEFT JOIN menu_items mi ON oi.menu_item_id = mi.id 
                         WHERE oi.order_id = ?");
        $this->db->bind(1, $id);
        $data['items'] = $this->db->resultSet();

        // Get order statuses for dropdown
        $this->db->query("SELECT * FROM order_status ORDER BY id");
        $data['statuses'] = $this->db->resultSet();

        $this->view('admin/order_details', $data);
    }

    public function update_order_status() {
        // Check if admin is logged in
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . ROOT . "admin/login");
            exit();
        }

        $response = ['success' => false, 'message' => ''];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $order_id = intval($_POST['order_id']);
            $status_id = intval($_POST['status_id']);
            $status_note = trim($_POST['status_note'] ?? '');

            if($order_id <= 0 || $status_id <= 0) {
                $response['message'] = "Invalid input";
            } else {
                // Update order status
                $this->db->query("UPDATE orders SET status_id = ? WHERE id = ?");
                $this->db->bind(1, $status_id);
                $this->db->bind(2, $order_id);

                if($this->db->execute()) {
                    // Add status history
                    if(!empty($status_note)) {
                        $this->db->query("INSERT INTO order_status_history (order_id, status_id, note, updated_by) 
                                        VALUES (?, ?, ?, ?)");
                        $this->db->bind(1, $order_id);
                        $this->db->bind(2, $status_id);
                        $this->db->bind(3, $status_note);
                        $this->db->bind(4, $_SESSION['admin_id']);
                        $this->db->execute();
                    }

                    $response['success'] = true;
                    $response['message'] = "Order status updated successfully";
                } else {
                    $response['message'] = "Error updating order status";
                }
            }
        }

        echo json_encode($response);
        exit();
    }
}
