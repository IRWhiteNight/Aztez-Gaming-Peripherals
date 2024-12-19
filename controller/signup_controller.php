<?php
// Start session (if not already started)
session_start();

// Include your database connection
include_once '../includes/config.php'; // Adjust path as per your project

// Check if the form is submitted
if (isset($_POST['signup'])) {
    // Sanitize and retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Set role_id
    $role_id = 2; // Assuming role_id 2 is for regular users

    // Validate form fields (add more validation as per your requirements)
    if (empty($username) || empty($email) || empty($password)) {
        // Handle empty fields scenario
        $_SESSION['signup_error'] = 'Please fill out all fields.';
        header('Location: ../index.php'); // Redirect to index.php
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO users (username, email, password, role_id) 
                  VALUES ('$username', '$email', '$hashed_password', '$role_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Registration successful
            $_SESSION['signup_success'] = 'Registration successful!';
            header('Location: ../index.php'); // Redirect to index.php
            exit();
        } else {
            // Registration failed
            $_SESSION['signup_error'] = 'Registration failed. Please try again.';
            header('Location: ../index.php'); // Redirect to index.php
            exit();
        }
    }
} else {
    // Handle if someone tries to access this script directly without submitting the form
    header('Location: ../index.php');
    exit();
}
?>
