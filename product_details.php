<?php
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_ict600";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$product = null;
$recommended_result = null;

// Check if the product ID is set
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product details based on the product ID
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Fetch recommended products from the same category
        $category = $product['category'];
        $recommended_sql = "SELECT * FROM products WHERE category = ? AND id != ? LIMIT 4";
        $stmt = $conn->prepare($recommended_sql);
        $stmt->bind_param("si", $category, $product_id);
        $stmt->execute();
        $recommended_result = $stmt->get_result();
    } else {
        echo "Product not found";
        exit();
    }
} else {
    echo "No product ID provided";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="css/product.css"> 
    <link rel="stylesheet" type="text/css" href="css/header.css"> 
    <link rel="stylesheet" type="text/css" href="css/footer.css"> 
    <title>Product Details</title>
</head>
<?php include "header.php"; ?>
<body class="bodys">
    <div class="productbody">
        <div class="productcontainer">
            <div class="borderproduct">
                <div class="productpreview" id="photoPreview">
                    <img id="mainPhoto" src="uploaded_img/<?php echo isset($product['image']) ? $product['image'] : ''; ?>" alt="Main Photo">
                </div>
                <div class="productthumbnails">
                    <img src="uploaded_img/<?php echo isset($product['image']) ? $product['image'] : ''; ?>" alt="Photo 1" onclick="selectPhoto('uploaded_img/<?php echo isset($product['image']) ? $product['image'] : ''; ?>')">
                    <img src="uploaded_img/<?php echo isset($product['image1']) ? $product['image1'] : ''; ?>" alt="Photo 2" onclick="selectPhoto('uploaded_img/<?php echo isset($product['image1']) ? $product['image1'] : ''; ?>')">
                    <img src="uploaded_img/<?php echo isset($product['image2']) ? $product['image2'] : ''; ?>" alt="Photo 3" onclick="selectPhoto('uploaded_img/<?php echo isset($product['image2']) ? $product['image2'] : ''; ?>')">
                    <img src="uploaded_img/<?php echo isset($product['image3']) ? $product['image3'] : ''; ?>" alt="Photo 4" onclick="selectPhoto('uploaded_img/<?php echo isset($product['image3']) ? $product['image3'] : ''; ?>')">
                </div>
            </div>
            <div class="productdetails">
                <h2><?php echo isset($product['name']) ? $product['name'] : ''; ?></h2>
                <a href="#"><p>By Aztez store</p></a>
                <p class="productprice">RM <?php echo isset($product['price']) ? $product['price'] : ''; ?></p>
                <hr>
                <p class="pdetails"><?php echo isset($product['description']) ? $product['description'] : ''; ?></p>
                    
                <form id="addToCartForm" method="post" action="includes/add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
                    <div class="quantity-container">
                        <button type="button" class="quantity-button1" onclick="changeQuantity(-1)">-</button>
                        <input type="text" class="quantity-input" id="quantity" name="quantity" value="1" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <button type="button" class="quantity-button" onclick="changeQuantity(1)">+</button>
                    </div>
                    <div class="submitproduct">
                        <button type="submit" class="submit-button" onclick="addToCart()">
                            <span>Add to Cart</span>
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <button type="button" class="submit-button" onclick="buyNow()">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="productcontainer2">
            <h1>You might also like</h1>
            <div class="recommended-products">
                <?php
                if ($recommended_result && $recommended_result->num_rows > 0) {
                    while ($recommended_product = $recommended_result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<img src="uploaded_img/' . $recommended_product['image'] . '" alt="' . $recommended_product['name'] . '">';
                        echo '<h3>' . $recommended_product['name'] . '</h3>';
                        echo '<p>' . $recommended_product['description'] . '</p>';
                        echo '<button>RM ' . $recommended_product['price'] . '</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No recommended products found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function selectPhoto(photo) {
            document.getElementById("mainPhoto").src = photo;
            var thumbnails = document.querySelectorAll('.productthumbnails img');
            thumbnails.forEach(function(thumbnail) {
                thumbnail.classList.remove('selected');
            });
            event.target.classList.add('selected');
        }
        
        function changeQuantity(amount) {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + amount;
            if (newQuantity >= 1) {
                quantityInput.value = newQuantity;
            }
        }
        
        function addToCart() {
            document.getElementById('addToCartForm').submit();
        }

        function buyNow() {
            // Implement your buy now functionality if needed
            console.log('Buy Now clicked');
        }
    </script>
</body>
<?php include "footer.html"; ?>
</html>
<?php
$conn->close();
?>
