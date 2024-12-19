<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Products</title>

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
<?php include "../adminheader.php" ?>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("mySidebar");
        if (sidebar.style.width === "250px") {
            sidebar.style.width = "0";
            document.removeEventListener('click', closeSidebarOnClickOutside);
        } else {
            sidebar.style.width = "250px";
            document.addEventListener('click', closeSidebarOnClickOutside);
        }
    }

    function closeSidebarOnClickOutside(event) {
        var sidebar = document.getElementById("mySidebar");
        var burgerMenu = document.getElementById("burger-menu");
        if (!sidebar.contains(event.target) && !burgerMenu.contains(event.target)) {
            sidebar.style.width = "0";
            document.removeEventListener('click', closeSidebarOnClickOutside);
        }
    }
</script>

<?php

@include '../../../includes/config.php';
@include 'add_model.php';

if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<h3 style="margin-top: 50px; margin-left: 80px; font-size: 24px; color: #0c0c0c; text-align: left;">
    <i class="fas fa-plus-circle"></i> Add Product
</h3>

<div class="containerProductCRUD">
    <div class="card">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Name</label>
                <input type="text" id="product_name" placeholder="Enter product name" name="product_name" class="box">
            </div>
            <div class="form-group">
                <label for="product_description">Description</label>
                <textarea id="product_description" placeholder="Enter product description" name="product_description" class="box"></textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" id="product_price" placeholder="Enter product price" name="product_price" class="box">
            </div>
            <div class="form-group">
                <label for="product_quantity">Quantity</label>
                <input type="number" id="product_quantity" placeholder="Enter product quantity" name="product_quantity" class="box">
            </div>
    </div>

    <div class="card">
        <div class="form-group">
            <label for="product_category">Category</label>
            <select id="product_category" name="product_category" class="box">
                <option>Select category</option>
                <option value="laptop">Laptop</option>
                <option value="headset">Headset</option>
                <option value="mouse">Mouse</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product_image">Upload Images</label>
            <div class="photo-upload image-grid">
                <div class="image-container">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" onchange="previewImage(event, 'imagePreview')">
                    <img id="imagePreview" src="" alt="Image Preview" style="display:none; width:100px;">
                </div>
                <div class="image-container">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image1" class="box" onchange="previewImage(event, 'imagePreview1')">
                    <img id="imagePreview1" src="" alt="Image Preview 1" style="display:none; width:100px;">
                </div>
                <div class="image-container">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image2" class="box" onchange="previewImage(event, 'imagePreview2')">
                    <img id="imagePreview2" src="" alt="Image Preview 2" style="display:none; width:100px;">
                </div>
                <div class="image-container">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image3" class="box" onchange="previewImage(event, 'imagePreview3')">
                    <img id="imagePreview3" src="" alt="Image Preview 3" style="display:none; width:100px;">
                </div>
            </div>
        </div>
        <input type="submit" class="btn" onclick="return confirmAction('add');" name="add_product" value="Add product" style="float: right; font-weight: bold; background-color: #289f47; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; text-decoration: none;" onmouseover="this.style.backgroundColor='#2b802b';" onmouseout="this.style.backgroundColor='#289f47';">
        </div>
    </form>
</div>

<?php
$select = mysqli_query($conn, "SELECT * FROM products");
?>
<div class="product-display">
    <table class="product-display-table">
        <thead>
            <tr style="background-color: #289f47; color: white;">
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Description</th>
                <th>Product Quantity</th>
                <th>Product Category</th>
                <th>Product Image</th>
                <th>Product Image 1</th>
                <th>Product Image 2</th>
                <th>Product Image 3</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>RM <?php echo $row['price']; ?></td>
                <td class="product-description"><?php echo $row['description']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                <td><img src="uploaded_img/<?php echo $row['image1']; ?>" height="100" alt=""></td>
                <td><img src="uploaded_img/<?php echo $row['image2']; ?>" height="100" alt=""></td>
                <td><img src="uploaded_img/<?php echo $row['image3']; ?>" height="100" alt=""></td>
                <td class="actions">
                    <a href="update_product.php?edit=<?php echo $row['id']; ?>" class="btn edit" onclick="return confirmAction('edit');"> <i class="fas fa-edit"></i></a>
                    <a href="add_product.php?delete=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirmAction('delete');"> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
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
