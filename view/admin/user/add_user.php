

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Users</title>

<!-- Font Awesome CDN link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Google Fonts link for Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

<!-- Custom CSS file link -->
<link rel="stylesheet" href="../../../css/product_add.css">
<link rel="stylesheet" href="../../../css/adminheader.css">
<style>
<style>
.message {
    background: #289f47; /* Green background */
    color: #fff; /* White font */
    padding: 10px 20px;
    border: 1px solid #1f7a37;
    border-radius: 4px;
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    white-space: nowrap;
    opacity: 1;
    transition: opacity 1s ease-out; /* Fade out effect */
}



.btn {
    display: inline-block;
    padding: 10px 15px;
    margin: 5px;
    background-color: #289f47;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.btn:hover {
    background-color: #2b802b;
}

.actions a {
    color: #fff;
    margin: 0 5px;
}

.actions a.edit {
    background-color: #ffc107;
}

.actions a.delete {
    background-color: #dc3545;
}

.actions a.edit:hover {
    background-color: #e0a800;
}

.actions a.delete:hover {
    background-color: #c82333;
}
</style></style>
</head>
<body>
<?php include "../adminheader.php" ?>


<!-- Display messages if any -->
<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<!-- Add User Form -->
<h3 style="margin-top: 50px; margin-left: 80px; font-size: 24px; color: #0c0c0c; text-align: left;">
    <i class="fas fa-user-plus"></i> Add User
</h3>

<div class="containerProductCRUD">
    <div class="card">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
        <!-- User Fields -->
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" id="user_id" placeholder="Enter user ID" name="user_id" class="box">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Enter username" name="username" class="box">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter email" name="email" class="box">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter password" name="password" class="box">
        </div>
        <div class="form-group">
            <label for="role_id">Role ID</label>
            <input type="text" id="role_id" placeholder="Enter role ID" name="role_id" class="box">
        </div>
        <div class="form-group">
            <label for="membership_type">Membership Type</label>
            <input type="text" id="membership_type" placeholder="Enter membership type" name="membership_type" class="box">
        </div>
        <div class="form-group">
            <label for="points">Points</label>
            <input type="number" id="points" placeholder="Enter points" name="points" class="box">
        </div>
        <div class="form-group">
            <label for="user_image">Upload User Image</label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="user_image" class="box" onchange="previewImage(event, 'userImagePreview')">
            <img id="userImagePreview" src="" alt="User Image Preview" style="display:none; width:100px;">
        </div>
        
        <!-- Submit Button -->
        <input type="submit" class="btn" name="add_user" value="Add User" style="float: right; font-weight: bold; background-color: #289f47; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; text-decoration: none;" onmouseover="this.style.backgroundColor='#2b802b';" onmouseout="this.style.backgroundColor='#289f47';">
        </form>
    </div>
</div>

<!-- Display Users Table -->
<?php
@include '../../../includes/config.php';
@include 'add_model.php';
$select_users = mysqli_query($conn, "SELECT * FROM users");
?>
<div class="product-display">
    <table class="product-display-table">
        <thead>
            <tr style="background-color: #289f47; color: white;">
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role ID</th>
                <th>Membership Type</th>
                <th>Points</th>
                <th>User Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($select_users)){ ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['role_id']; ?></td>
                <td><?php echo $row['membership_type']; ?></td>
                <td><?php echo $row['points']; ?></td>
                <td><img src="useruploaded_img/<?php echo $row['user_image']; ?>" height="100" alt="User Image"></td>
                <td class="actions">
                    <a href="update_user.php?edit=<?php echo $row['user_id']; ?>" class="btn edit" onclick="return confirmAction('edit');"> <i class="fas fa-edit"></i></a>
                    <a href="add_user.php?delete=<?php echo $row['user_id']; ?>" class="btn delete" onclick="return confirmAction('delete');"> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php }?>
</tbody>
</table>
</div>


<script>
function previewImage(event, previewId) {
var reader = new FileReader();
reader.onload = function(){
var output = document.getElementById(previewId);
output.src = reader.result;
output.style.display = 'block';
};
reader.readAsDataURL(event.target.files[0]);
}

function confirmAction(action) {
return confirm(`Are you sure you want to ${action} this item?`);
}

window.onload = function() {
setTimeout(function() {
var messages = document.querySelectorAll('.message');
messages.forEach(function(message) {
    message.style.display = 'none';
});
}, 3000); // 3000 milliseconds = 3 seconds
};
</script>
</body>
</html>
