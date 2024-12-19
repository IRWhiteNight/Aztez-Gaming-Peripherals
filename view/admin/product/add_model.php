<?php

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
 
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;
 
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image1_tmp_name = $_FILES['product_image1']['tmp_name'];
    $product_image1_folder = 'uploaded_img/'.$product_image1;
 
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image2_tmp_name = $_FILES['product_image2']['tmp_name'];
    $product_image2_folder = 'uploaded_img/'.$product_image2;
 
    $product_image3 = $_FILES['product_image3']['name'];
    $product_image3_tmp_name = $_FILES['product_image3']['tmp_name'];
    $product_image3_folder = 'uploaded_img/'.$product_image3;
 
    if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_description) || empty($product_quantity) || empty($product_category)){
       $message[] = 'Please fill out all fields';
    }else{
       $insert = "INSERT INTO products(name, price, description, quantity, category, image, image1, image2, image3) VALUES('$product_name', '$product_price', '$product_description', '$product_quantity', '$product_category', '$product_image', '$product_image1', '$product_image2', '$product_image3')";
       $upload = mysqli_query($conn, $insert);
       if($upload){
          move_uploaded_file($product_image_tmp_name, $product_image_folder);
          move_uploaded_file($product_image1_tmp_name, $product_image1_folder);
          move_uploaded_file($product_image2_tmp_name, $product_image2_folder);
          move_uploaded_file($product_image3_tmp_name, $product_image3_folder);
          $message[] = 'New product added successfully';
       }else{
          $message[] = 'Could not add the product';
       }
    }
 }
 
 if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    if($delete) {
        $message[] = 'Product deleted successfully';
    } else {
        $message[] = 'Could not delete the product';
    }
    header('location:add_product.php');
 }