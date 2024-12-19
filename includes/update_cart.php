<?php
session_start();

// Include database configuration
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Validate inputs (basic validation example)
    if (!is_numeric($item_id) || !is_numeric($quantity) || $quantity <= 0) {
        echo "Invalid item ID or quantity.";
        exit();
    }

    // Update quantity in cart table
    $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $user_id, $item_id);
    if ($stmt->execute()) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
