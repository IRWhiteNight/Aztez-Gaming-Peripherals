<?php
// Include database configuration
include_once "../includes/config.php";

// Check if user is logged in (example code, adjust as per your session handling)
session_start();
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'User not logged in.']));
}

// Fetch cart items for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id, cart.quantity, products.name, products.price, products.image FROM cart INNER JOIN products ON cart.id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$shipping = 0;
$totalPrice = 0;

// Calculate totals
while ($row = $result->fetch_assoc()) {
    $quantity = $row['quantity'];
    $item_price = $row['price'];

    // Calculate subtotal for each item
    $subtotal = $item_price * $quantity;
    $total += $subtotal;

    // Determine shipping based on quantity
    if ($quantity <= 2) {
        $shipping = 10;
    } else if ($quantity <= 4) {
        $shipping = 20;
    } else {
        $shipping = 50;
    }

    // Update total price including shipping
    $totalPrice = $total + $shipping;
}

// Return totals as JSON
echo json_encode(['totalPrice' => $totalPrice, 'shipping' => $shipping]);

// Close statement and connection
$stmt->close();
$conn->close();
?>
