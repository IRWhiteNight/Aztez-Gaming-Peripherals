<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="css/product.css"> 

    <title>Photo Preview E-commerce Product</title>
    
</head>
<?php include "header.php"?>
<body class="productbody">
    <div class="productcontainer">
        <div class="borderproduct">
            <div class="productpreview" id="photoPreview">
                <img id="mainPhoto" src="img/FINAL-01.png" alt="Main Photo">
            </div>
            <div class="productthumbnails">
                <img src="img/FINAL-01.png" alt="Photo 1" onclick="selectPhoto('img/FINAL-01.png')">
                <img src="img/mouse-01.png" alt="Photo 2" onclick="selectPhoto('img/mouse-01.png')">
                <img src="img/keyboard-01.png" alt="Photo 3" onclick="selectPhoto('img/keyboard-01.png')">
            </div>
        </div>
        <div class="productdetails">
            <h2>DeathStalker V2 Pro Tenkeyless - Wireless Low-Profile RGB Tenkeyless Optical Keyboard</h2>
            <a href="#"><p>By Aztez store</p></a>
            <p class="productprice">RM1000</p>
            <hr>
            <p class="pdetails">About Razer Viper V3 Hyperspeed Wireless Gaming Mouse
                82G LIGHTWEIGHT DESIGN — Featuring a mass centralized design, the Razer Viper V3 HyperSpeed ensures seamless, consistent swipes crucial to competitive play—no need to settle for unbalanced battery-powered mice
                FOCUS PRO 30K OPTICAL SENSOR 
            </p>
            <div class="quantity-container">
                Quantity
                <button class="quantity-button1" onclick="changeQuantity(-1)">-</button>
                <input type="text" class="quantity-input" id="quantity" value="1" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                <button class="quantity-button" onclick="changeQuantity(1)">+</button>
            </div>
            <div class="submitproduct">
                <button type="submit" class="submit-button">
                    <span>Add to Cart</span>
                    <i class="fas fa-shopping-cart"></i>
                </button>
                <button type="submit" class="submit-button">Buy Now</button>
            </div>
            
        </div>
    </div>
    <hr>
    <div class="productcontainer2">
        <h1> You also like</h1>
        <div class="recommended-products">
            <div class="product-card">
                <img src="img/keyboard-01.png" alt="Recommended Product 1">
                <h3>Recommended Product 1</h3>
                <p>Sales 1000</p>
                <p class="editproductp">RM 1000</p>
                <button>See</button>
            </div>
            <div class="product-card">
                <img src="img/mouse-01.png" alt="Recommended Product 2">
                <h3>Recommended Product 2</h3>
                <p>Sales 1000</p>
                <p class="editproductp">RM 1000</p>
                <button>See</button>
            </div>
            <div class="product-card">
                <img src="img/keyboard-01.png" alt="Recommended Product 2">
                <h3>Recommended Product 2</h3>
                <p>Sales 1000</p>
                <p class="editproductp">RM 1000</p>
                <button>See</button>
            </div>
            <div class="product-card">
                <img src="img/mouse-01.png" alt="Recommended Product 2">
                <h3>Recommended Product 2</h3>
                <p>Sales 1000</p>
                <p class="editproductp">RM 1000</p>
                <button>See</button>
            </div>
            <!-- Add more product cards as needed -->
        </div>
        
    </div>

    <script>
        function selectPhoto(photoSrc) {
            // Update the main photo
            const mainPhoto = document.getElementById('mainPhoto');
            mainPhoto.src = photoSrc;
    
            // Remove the selected class from all thumbnails
            const thumbnails = document.querySelectorAll('.productthumbnails img');
            thumbnails.forEach(thumbnail => thumbnail.classList.remove('selected'));
    
            // Add the selected class to the clicked thumbnail
            const selectedThumbnail = Array.from(thumbnails).find(thumbnail => thumbnail.src.includes(photoSrc));
            selectedThumbnail.classList.add('selected');
        }
    
        function changeQuantity(amount) {
            const quantityInput = document.getElementById('quantity');
            let currentQuantity = parseInt(quantityInput.value);
            if (isNaN(currentQuantity)) currentQuantity = 0;
            const newQuantity = currentQuantity + amount;
            if (newQuantity > 0) {
                quantityInput.value = newQuantity;
            }
        }
        // Initialize with the first photo selected
        document.querySelector('.productthumbnails img').classList.add('selected');
    </script>
    