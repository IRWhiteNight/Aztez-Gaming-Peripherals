<?php
@include '../../../includes/config.php'; // Include your database connection
@include 'update_model.php'; // Include your update model or logic file
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update User</title>

<!-- Font Awesome CDN link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Google Fonts link for Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

<!-- Custom CSS file link -->
<link rel="stylesheet" href="../../../css/product_update.css">
<link rel="stylesheet" href="../../../css/adminheader.css">

</head>
<body>

<?php include "../adminheader.html"; ?>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<h3 style="margin-top: 50px; margin-left: 80px; font-size: 24px; color: #0c0c0c; text-align: left;">
    <i class="fas fa-edit"></i> Update User
</h3>

<div class="containerProductCRUD">
    <div class="card">
        <?php
        // Assuming you have a way to get $user_id from the URL or some other method
        $user_id = isset($_GET['edit']) ? $_GET['edit'] : '';
        
        $select = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
        if (mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $user_image_path = 'useruploaded_img/' . $row['user_image']; // Path to current user image
        ?>
            
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" id="user_id" placeholder="Enter user ID" name="user_id" class="box" value="<?php echo $row['user_id']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter username" name="username" class="box" value="<?php echo $row['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter email" name="email" class="box" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter password" name="password" class="box" value="<?php echo $row['password']; ?>">
            </div>
            <div class="form-group">
                <label for="role_id">Role ID</label>
                <input type="text" id="role_id" placeholder="Enter role ID" name="role_id" class="box" value="<?php echo $row['role_id']; ?>">
            </div>
            <div class="form-group">
                <label for="membership_type">Membership Type</label>
                <input type="text" id="membership_type" placeholder="Enter membership type" name="membership_type" class="box" value="<?php echo $row['membership_type']; ?>">
            </div>
            <div class="form-group">
                <label for="points">Points</label>
                <input type="number" id="points" placeholder="Enter points" name="points" class="box" value="<?php echo $row['points']; ?>">
            </div>
            <div class="form-group">
                <label for="user_image">Uploaded User Image</label>
                <div class="photo-upload">
                    <img id="user-image-preview" src="<?php echo $user_image_path; ?>" alt="Current user image">
                    <input type="hidden" name="current_image" value="<?php echo $row['user_image']; ?>">
                    <input type="file" id="user_image" name="user_image" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'user-image-preview')">
                    <div class="change-text" onclick="document.getElementById('user_image').click();">Change</div>
                </div>
            </div>
        
            <input type="submit" value="Update User" name="update_user" class="btn" onclick="return confirmAction('update');">
            <a href="add_user.php" class="btn" style="text-decoration: none;">Back</a>
        </form>
        
        <?php 
        } else {
            echo "<p>User not found.</p>";
        }
        ?>
    </div>
</div>

<script>
function previewImage(event, previewId) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(previewId);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function confirmAction(action) {
    return confirm(`Are you sure you want to ${action} this item?`);
}
</script>

</body>
</html>
