<?php
// order_view.php

include_once "includes/config.php"; // Include your database connection file

class OrderController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserOrders($user_id) {
        $orders = [];

        $sql = "SELECT * FROM orders WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $order = [
                'order_id' => $row['order_id'],
                'user_id' => $row['user_id'],
                'user_name' => $row['user_name'],
                'order_date' => $row['order_date'],
                'total_amount' => $row['total_amount'],
                'delivery_status' => $row['delivery_status'],
                'address' => $row['address'],
                'city' => $row['city'],
                'post_code' => $row['post_code'],
                'phone' => $row['phone'],
                'state' => $row['state'],
                'image1' => $row['image1'], // Assuming this is the column for image1
                'name' => $row['name'] // Assuming this is the column for product name
            ];

            $orders[] = $order;
        }

        $stmt->close();

        return $orders;
    }
}

// Usage example:
$orderController = new OrderController($conn); // Assuming $conn is your database connection
?>
