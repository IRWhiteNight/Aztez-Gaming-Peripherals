<?php
session_start();

include_once "config.php"; // Ensure this points to your database configuration

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure the database connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user data from session or database
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $username = htmlspecialchars($user['username']);
    $email = htmlspecialchars($user['email']);
    $password = htmlspecialchars($user['password']);
    $membership_type = htmlspecialchars($user['membership_type']);
    $points = htmlspecialchars($user['points']);
    $user_image = htmlspecialchars($user['user_image']);
} else {
    die("User not found in database.");
}
?>
