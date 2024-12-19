<?php
session_start();

// Include database connection file
require_once '../includes/config.php'; // Adjust the path as needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (!empty($email) && !empty($password)) {
        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with the provided email exists
        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start a session
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true; // Set a session variable to indicate login status


                // Redirect to the home page
                header("Location: ../index.php");
                exit;
            } else {
                // Incorrect password
                echo "Invalid email or password. Please try again.";
            }
        } else {
            // No user found with the provided email
            echo "No user found with this email. Please sign up first.";
        }

        $stmt->close();
    } else {
        // Form data is incomplete
        echo "Please fill in both email and password.";
    }
} else {
    // Form is not submitted
    echo "Invalid request.";
}

$conn->close();
?>
