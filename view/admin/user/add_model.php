<?php
// Include your database connection and any necessary configurations

$message = []; // Array to store messages

if(isset($_POST['add_user'])) {
    // Sanitize and retrieve form data
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $membership_type = mysqli_real_escape_string($conn, $_POST['membership_type']);
    $points = mysqli_real_escape_string($conn, $_POST['points']);

    // File upload handling for user image
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp_name = $_FILES['user_image']['tmp_name'];
    $user_image_folder = 'useruploaded_img/'.$user_image;

    // Validate form fields
    if(empty($user_id) || empty($username) || empty($email) || empty($password) || empty($role_id) || empty($membership_type) || empty($points) || empty($user_image)){
        $message[] = 'Please fill out all fields';
    } else {
        // Insert user data into the database
        $insert = "INSERT INTO users(user_id, username, email, password, role_id, membership_type, points, user_image) VALUES('$user_id', '$username', '$email', '$password', '$role_id', '$membership_type', '$points', '$user_image')";
        $upload = mysqli_query($conn, $insert);
        
        if($upload) {
            // Move uploaded image to the destination folder
            move_uploaded_file($user_image_tmp_name, $user_image_folder);
            $message[] = 'New user added successfully';
        } else {
            $message[] = 'Could not add the user';
        }
    }
}

// Handle user deletion
if(isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");

    if($delete) {
        $message[] = 'User deleted successfully';
    } else {
        $message[] = 'Could not delete the user';
    }
    header('location:add_user.php'); // Redirect after deletion
}
?>