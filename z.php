<?php
include_once "includes/session.php";
include_once "includes/config.php"; // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view orders.";
    exit();
}

// Fetch orders for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No orders found for this user.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="css/view.css"> <!-- Adjust path to your CSS file -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>My Orders</h1>
        </header>
        <section class="orders-list">
            <?php while ($order = $result->fetch_assoc()) : ?>
                <div class="order-item">
                    <h2>Order ID: <?php echo $order['order_id']; ?></h2>
                    <p><strong>Total Amount:</strong> RM <?php echo number_format($order['total_amount'], 2); ?></p>
                    <p><strong>Order Date:</strong> <?php echo date('Y-m-d H:i:s', strtotime($order['order_date'])); ?></p>
                    <p><strong>Delivery Status:</strong> <?php echo $order['delivery_status']; ?></p>
                    <!-- You can display more details as needed -->
                    <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>" class="order-details-link">View Details</a>
                    <hr>
                </div>
            <?php endwhile; ?>
        </section>
    </div>
</body>
</html>
