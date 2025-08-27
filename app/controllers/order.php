<?php

class Order extends Controller {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function index() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "login");
            exit();
        }

        $data['page_title'] = "My Orders";

        // Get user's orders
        $this->db->query("SELECT o.*, os.name as status_name 
                         FROM orders o 
                         LEFT JOIN order_status os ON o.status_id = os.id 
                         WHERE o.user_id = ? 
                         ORDER BY o.created_at DESC");
        $this->db->bind(1, $_SESSION['user_id']);
        $data['orders'] = $this->db->resultSet();

        $this->view('order/index', $data);
    }

    public function place_order() {
        if(!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Please login to place an order']);
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $cart_items = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : [];
            $total_amount = floatval($_POST['total_amount']);
            $delivery_address = trim($_POST['delivery_address']);
            $special_instructions = trim($_POST['special_instructions']);
            $payment_method = trim($_POST['payment_method']);

            if(empty($cart_items)) {
                echo json_encode(['success' => false, 'message' => 'Your cart is empty']);
                exit();
            }

            try {
                $this->db->beginTransaction();

                // Create order
                $this->db->query("INSERT INTO orders (user_id, total_amount, delivery_address, 
                                special_instructions, payment_method, status_id) 
                                VALUES (?, ?, ?, ?, ?, 1)");
                $this->db->bind(1, $_SESSION['user_id']);
                $this->db->bind(2, $total_amount);
                $this->db->bind(3, $delivery_address);
                $this->db->bind(4, $special_instructions);
                $this->db->bind(5, $payment_method);
                $this->db->execute();

                $order_id = $this->db->lastInsertId();

                // Add order items
                foreach($cart_items as $item) {
                    $this->db->query("INSERT INTO order_items (order_id, menu_item_id, quantity, price) 
                                    VALUES (?, ?, ?, ?)");
                    $this->db->bind(1, $order_id);
                    $this->db->bind(2, $item['id']);
                    $this->db->bind(3, $item['quantity']);
                    $this->db->bind(4, $item['price']);
                    $this->db->execute();
                }

                $this->db->commit();
                echo json_encode([
                    'success' => true, 
                    'message' => 'Order placed successfully',
                    'order_id' => $order_id
                ]);
            } catch(Exception $e) {
                $this->db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error placing order']);
            }
        }
        exit();
    }

    public function details($id = null) {
        if(!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "login");
            exit();
        }

        if(!$id) {
            header("Location: " . ROOT . "order");
            exit();
        }

        $data['page_title'] = "Order Details";

        // Get order details
        $this->db->query("SELECT o.*, os.name as status_name, u.name as user_name 
                         FROM orders o 
                         LEFT JOIN order_status os ON o.status_id = os.id 
                         LEFT JOIN users u ON o.user_id = u.id 
                         WHERE o.id = ? AND o.user_id = ?");
        $this->db->bind(1, $id);
        $this->db->bind(2, $_SESSION['user_id']);
        $data['order'] = $this->db->single();

        if(!$data['order']) {
            header("Location: " . ROOT . "order");
            exit();
        }

        // Get order items
        $this->db->query("SELECT oi.*, mi.name, mi.image 
                         FROM order_items oi 
                         LEFT JOIN menu_items mi ON oi.menu_item_id = mi.id 
                         WHERE oi.order_id = ?");
        $this->db->bind(1, $id);
        $data['items'] = $this->db->resultSet();

        $this->view('order/details', $data);
    }

    public function cancel($id = null) {
        if(!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit();
        }

        if(!$id) {
            echo json_encode(['success' => false, 'message' => 'Invalid order']);
            exit();
        }

        // Check if order belongs to user and can be cancelled
        $this->db->query("SELECT status_id FROM orders WHERE id = ? AND user_id = ? LIMIT 1");
        $this->db->bind(1, $id);
        $this->db->bind(2, $_SESSION['user_id']);
        $order = $this->db->single();

        if(!$order) {
            echo json_encode(['success' => false, 'message' => 'Order not found']);
            exit();
        }

        if($order->status_id > 2) {
            echo json_encode(['success' => false, 'message' => 'Order cannot be cancelled']);
            exit();
        }

        // Cancel order
        $this->db->query("UPDATE orders SET status_id = 6 WHERE id = ?");
        $this->db->bind(1, $id);

        if($this->db->execute()) {
            echo json_encode(['success' => true, 'message' => 'Order cancelled successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error cancelling order']);
        }
        exit();
    }
}
