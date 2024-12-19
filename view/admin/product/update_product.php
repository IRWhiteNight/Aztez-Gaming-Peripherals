<?php

@include '../../../includes/config.php';
@include 'update_model.php';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Product</title>

<!-- Font Awesome CDN link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Google Fonts link for Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

<!-- Custom CSS file link -->
<link rel="stylesheet" href="../../../css/product_update.css">
<link rel="stylesheet" href="../../../css/adminheader.css">

</head>
<body>

<?php include "../adminheader.html"?> 



<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>
<h3 style="margin-top: 50px; margin-left: 80px; font-size: 24px; color: #0c0c0c; text-align: left;">
    <i class="fas fa-edit"></i> Update Product
</h3>

<div class="containerProductCRUD">
    <div class="card">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
        if (mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $imagePath = 'uploaded_img/' . $row['image'] . '?' . time();
            $image1Path = 'uploaded_img/' . $row['image1'] . '?' . time();
            $image2Path = 'uploaded_img/' . $row['image2'] . '?' . time();
            $image3Path = 'uploaded_img/' . $row['image3'] . '?' . time();
        ?>
            
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="product_name">Name</label>
                <input type="text" id="product_name" placeholder="Enter product name" name="product_name" class="box" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
                <label for="product_description">Description</label>
                <textarea id="product_description" placeholder="Enter product description" name="product_description" class="box"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" id="product_price" placeholder="Enter product price" name="product_price" class="box" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="product_quantity">Quantity</label>
                <input type="number" id="product_quantity" placeholder="Enter product quantity" name="product_quantity" class="box" value="<?php echo $row['quantity']; ?>">
            </div>
    </div>

    <div class="card">
        <div class="form-group">
            <label for="product_category">Category</label>
            <select id="product_category" name="product_category" class="box">
                <option>Select category</option>
                <option value="laptop" <?php if($row['category'] == 'laptop') echo 'selected'; ?>>Laptop</option>
                <option value="headset" <?php if($row['category'] == 'headset') echo 'selected'; ?>>Headset</option>
                <option value="mouse" <?php if($row['category'] == 'mouse') echo 'selected'; ?>>Mouse</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product_image">Uploaded Images</label>
            <div class="photo-upload image-grid">
    <div class="image-container">
        <img id="product-image-preview" src="<?php echo $imagePath; ?>" alt="Current product image">
        <div class="change-text" onclick="document.getElementById('product_image').click();">Change</div>
    </div>
    <input type="hidden" name="current_image" value="<?php echo $row['image']; ?>">
    <input type="file" class="hidden-file-input" id="product_image" name="product_image" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'product-image-preview')">

    <div class="image-container">
        <img id="product-image1-preview" src="<?php echo $image1Path; ?>" alt="Current product image 1">
        <div class="change-text" onclick="document.getElementById('product_image1').click();">Change</div>
    </div>
    <input type="hidden" name="current_image1" value="<?php echo $row['image1']; ?>">
    <input type="file" class="hidden-file-input" id="product_image1" name="product_image1" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'product-image1-preview')">

    <div class="image-container">
        <img id="product-image2-preview" src="<?php echo $image2Path; ?>" alt="Current product image 2">
        <div class="change-text" onclick="document.getElementById('product_image2').click();">Change</div>
    </div>
    <input type="hidden" name="current_image2" value="<?php echo $row['image2']; ?>">
    <input type="file" class="hidden-file-input" id="product_image2" name="product_image2" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'product-image2-preview')">

    <div class="image-container">
        <img id="product-image3-preview" src="<?php echo $image3Path; ?>" alt="Current product image 3">
        <div class="change-text" onclick="document.getElementById('product_image3').click();">Change</div>
    </div>
    <input type="hidden" name="current_image3" value="<?php echo $row['image3']; ?>">
    <input type="file" class="hidden-file-input" id="product_image3" name="product_image3" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'product-image3-preview')">
</div>

        </div>
        <input type="submit" value="Update product" name="update_product" class="btn" onclick="return confirmAction('update');">
        <a href="add_product.php" class="btn" style="text-decoration: none;">Back</a>
        </form>
        <?php 
        } else {
            echo "<p>Product not found.</p>";
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
