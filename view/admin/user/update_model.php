<?php
$id = $_GET['edit'];

if (isset($_POST['update_user'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $membership_type = $_POST['membership_type'];
    $points = $_POST['points'];

    // Handle user image upload
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp_name = $_FILES['user_image']['tmp_name'];
    $user_image_folder = 'useruploaded_img/' . $user_image;

    if (empty($user_image)) {
        $user_image = $_POST['current_image'];
    } else {
        move_uploaded_file($user_image_tmp_name, $user_image_folder);
        $old_image = $_POST['current_image'];
        if (file_exists('useruploaded_img/' . $old_image)) {
            unlink('useruploaded_img/' . $old_image);
        }
    }

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($role_id) || empty($membership_type) || empty($points)) {
        $message[] = 'Please fill out all fields!';
    } else {
        // Update user information in database
        $update_data = "UPDATE users SET 
                        username='$username', 
                        email='$email', 
                        password='$password', 
                        role_id='$role_id', 
                        membership_type='$membership_type', 
                        points='$points', 
                        user_image='$user_image' 
                        WHERE user_id = '$id'";
        
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            header('location: add_user.php');
        } else {
            $message[] = 'Could not update the user!';
        }
    }
}

// Fetch existing user data for editing
$select = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
$row = mysqli_fetch_assoc($select);
?>