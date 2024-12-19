<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Cart</title>

<!-- Font Awesome CDN link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Google Fonts link for Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

<!-- Custom CSS file link -->
<link rel="stylesheet" href="../../../css/product_add.css">
<link rel="stylesheet" href="../../../css/adminheader.css">

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
</style>

</head>
<body>

<?php include "../adminheader.html" ?>

<!-- Display messages if any -->
<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<!-- Cart Form -->
<h3 style="margin-top: 50px; margin-left: 80px; font-size: 24px; color: #0c0c0c; text-align: left;">
    <i class="fas fa-shopping-cart"></i> Manage Cart
</h3>

<div class="containerProductCRUD">
    <div class="card">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
            <!-- Cart Fields -->
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" id="user_id" placeholder="Enter user ID" name="user_id" class="box">
            </div>
            <div class="form-group">
                <label for="id">Product ID</label>
                <input type="text" id="product_id" placeholder="Enter product ID" name="product_id" class="box">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" placeholder="Enter quantity" name="quantity" class="box">
            </div>
            
            <!-- Submit Button -->
            <input type="submit" class="btn" name="add_to_cart" value="Add to Cart">
        </form>
    </div>
</div>


<?php
@include '../../../includes/config.php';
@include 'add_model.php';

// Assuming $conn is your database connection

// Fetch cart items for display with product details
$select_cart_items = mysqli_query($conn, "
    SELECT cart.cart_id, cart.user_id, cart.id AS product_id, cart.quantity, products.name, products.price, products.image
    FROM cart
    INNER JOIN products ON cart.id = products.id
    ORDER BY cart.cart_id DESC
");

?>

<div class="product-display">
    <table class="product-display-table">
        <thead>
            <tr style="background-color: #289f47; color: white;">
                <th>Cart ID</th>
                <th>User ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($select_cart_items)){ ?>
            <tr>
                <td><?php echo $row['cart_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 50px; height: auto;"></td>
                <td class="actions">
                    <a href="update_cart.php?edit=<?php echo $row['cart_id']; ?>" class="btn edit" onclick="return confirmAction('edit');"> <i class="fas fa-edit"></i></a>
                    <a href="add_cart.php?delete=<?php echo $row['cart_id']; ?>" class="btn delete" onclick="return confirmAction('delete');"> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<script>
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
