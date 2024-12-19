<?php

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];

    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image1_tmp_name = $_FILES['product_image1']['tmp_name'];
    $product_image1_folder = 'uploaded_img/' . $product_image1;

    $product_image2 = $_FILES['product_image2']['name'];
    $product_image2_tmp_name = $_FILES['product_image2']['tmp_name'];
    $product_image2_folder = 'uploaded_img/' . $product_image2;

    $product_image3 = $_FILES['product_image3']['name'];
    $product_image3_tmp_name = $_FILES['product_image3']['tmp_name'];
    $product_image3_folder = 'uploaded_img/' . $product_image3;

    if (empty($product_image)) {
        $product_image = $_POST['current_image'];
    } else {
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $old_image = $_POST['current_image'];
        if (file_exists('uploaded_img/' . $old_image)) {
            unlink('uploaded_img/' . $old_image);
        }
    }

    if (empty($product_image1)) {
        $product_image1 = $_POST['current_image1'];
    } else {
        move_uploaded_file($product_image1_tmp_name, $product_image1_folder);
        $old_image1 = $_POST['current_image1'];
        if (file_exists('uploaded_img/' . $old_image1)) {
            unlink('uploaded_img/' . $old_image1);
        }
    }

    if (empty($product_image2)) {
        $product_image2 = $_POST['current_image2'];
    } else {
        move_uploaded_file($product_image2_tmp_name, $product_image2_folder);
        $old_image2 = $_POST['current_image2'];
        if (file_exists('uploaded_img/' . $old_image2)) {
            unlink('uploaded_img/' . $old_image2);
        }
    }

    if (empty($product_image3)) {
        $product_image3 = $_POST['current_image3'];
    } else {
        move_uploaded_file($product_image3_tmp_name, $product_image3_folder);
        $old_image3 = $_POST['current_image3'];
        if (file_exists('uploaded_img/' . $old_image3)) {
            unlink('uploaded_img/' . $old_image3);
        }
    }

    if (empty($product_name) || empty($product_price) || empty($product_description) || empty($product_quantity) || empty($product_category)) {
        $message[] = 'Please fill out all fields!';
    } else {
        $update_data = "UPDATE products SET 
                        name='$product_name', 
                        price='$product_price', 
                        description='$product_description', 
                        quantity='$product_quantity', 
                        category='$product_category', 
                        image='$product_image', 
                        image1='$product_image1', 
                        image2='$product_image2', 
                        image3='$product_image3' 
                        WHERE id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            header('location:add_product.php');
        } else {
            $message[] = 'Could not update the product!';
        }
    }
}

$select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
$row = mysqli_fetch_assoc($select);
