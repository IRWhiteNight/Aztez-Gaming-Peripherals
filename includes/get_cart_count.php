<?php
// Start or resume a session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
include_once "config.php"; // Adjust the path as per your project structure

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo 0; // Return 0 if user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to fetch count of items in cart for the current user
$sql = "SELECT COUNT(*) AS count FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo $row['count']; // Return count of items in cart
} else {
    echo 0; // Return 0 if no items found (though ideally it should not happen if user is logged in)
}

$stmt->close();
$conn->close();
?>
