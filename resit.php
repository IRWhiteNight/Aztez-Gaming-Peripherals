<?php
include_once "inludes/session.php";

// Check if order_id is set in URL parameter or session
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} elseif (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
} else {
    // If order_id is not found in session or URL parameter
    echo "Order ID not found.";
    exit();
}

// Fetch order details based on order_id
$sql = "SELECT order_id, user_id, user_name, order_date, total_amount, address, city, post_code, phone, delivery_status, state
        FROM orders
        WHERE order_id = ?";
    
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if order exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Format the receipt
    $receipt = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Receipt</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .receipt {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: 0 auto;
            }
            .receipt h1, .receipt h2 {
                text-align: center;
            }
            .receipt .details {
                margin-bottom: 20px;
            }
            .receipt .details p {
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <div class='receipt'>
            <h1>Receipt</h1>
            <div class='details'>
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> {$row['order_id']}</p>
                <p><strong>User ID:</strong> {$row['user_id']}</p>
                <p><strong>User Name:</strong> {$row['user_name']}</p>
                <p><strong>Order Date:</strong> {$row['order_date']}</p>
                <p><strong>Total Amount:</strong> \${$row['total_amount']}</p>
            </div>
            <div class='details'>
                <h2>Shipping Address</h2>
                <p>{$row['address']}</p>
                <p>{$row['city']}, {$row['state']} {$row['post_code']}</p>
                <p><strong>Phone:</strong> {$row['phone']}</p>
            </div>
            <div class='details'>
                <h2>Delivery Status</h2>
                <p>{$row['delivery_status']}</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Display the receipt
    echo $receipt;

} else {
    // If order_id is found but no matching order found in database
    echo "Order not found.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
