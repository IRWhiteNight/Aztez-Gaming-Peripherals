<?php
include_once "session.php";  // Ensure user is logged in and session is started
include_once "config.php";  // Database connection

// Display errors for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $file = $_FILES['profile_image'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // Get the file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size <= 2097152) { // 2MB limit
                $file_new_name = uniqid('', true) . '.' . $file_ext;
                $file_destination = '../uploaded_img/' . $file_new_name;

                if (move_uploaded_file($file_tmp, $file_destination)) {
                    // Update session with new image
                    $_SESSION['user_image'] = $file_new_name;

                    // Update database with new image
                    $user_id = $_SESSION['user_id'];
                    $sql_update = "UPDATE users SET user_image = ? WHERE user_id = ?";
                    $stmt_update = $conn->prepare($sql_update);

                    if ($stmt_update) {
                        $stmt_update->bind_param("si", $file_new_name, $user_id);
                        $stmt_update->execute();

                        if ($stmt_update->affected_rows > 0) {
                            echo "Profile image updated successfully.";
                        } else {
                            echo "Error updating profile image in database.";
                        }

                        $stmt_update->close();
                    } else {
                        echo "Error preparing SQL statement: " . $conn->error;
                    }

                    header('Location: ../profile.php');
                    exit();
                } else {
                    echo "Error moving uploaded file.";
                }
            } else {
                echo "File size exceeds limit (2MB).";
            }
        } else {
            echo "Error uploading file: $file_error.";
        }
    } else {
        echo "Invalid file type. Allowed types: jpg, jpeg, png.";
    }
} else {
    echo "No file uploaded or invalid request method.";
}
?>
