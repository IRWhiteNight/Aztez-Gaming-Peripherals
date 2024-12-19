<?php
@include 'store_model.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Store Page</title>
    <link rel="stylesheet" type="text/css" href="css/store copy.css"> 
    <link rel="stylesheet" type="text/css" href="css/footer.css"> 
    <link rel="stylesheet" type="text/css" href="css/header.css"> 
    
</head>
<?php include "header.php" ?>
<body class="bodystore">
    <div class="designmid">
        <div class="storebody">
            <div class="storeh1">
                <h1>Products</h1>
                <h4>High-performance wired and wireless made for every gamer's hand</h4>
            </div>
            <div class="componentstore">
                <div class="filter">
                    <h3>Filters</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" name="filterForm">
                        <div class="dropdown">
                            <h4>Products Type</h4>
                            <ul>
                                <li><label><input type="checkbox" name="categories[]" value="Laptop"> Laptop</label></li>
                                <li><label><input type="checkbox" name="categories[]" value="Headset"> Headset</label></li>
                                <li><label><input type="checkbox" name="categories[]" value="Mouse"> Mouse</label></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="dropdown">
                            <h4>Brands</h4>
                            <ul>
                                <li><label><input type="checkbox" name="brands[]" value="Asus"> Asus</label></li>
                                <li><label><input type="checkbox" name="brands[]" value="FinalMouse"> FinalMouse</label></li>
                                <li><label><input type="checkbox" name="brands[]" value="Razer"> Razer</label></li>
                            </ul>
                        </div>
                        <hr>
                        <h4>Price Range</h4>
                        <div class="price">
                            <p class="marginp">MYR</p>
                            <input type="number" class="priceinput" name="min_price" placeholder="From" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
                        </div>
                        <div class="price">
                            <p class="marginp">MYR</p>
                            <input type="number" class="priceinput" name="max_price" placeholder="To" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
                        </div>
                        <div>
                            <button type="submit">Apply Filter</button>
                            <button type="button" onclick="clearFields()">Reset</button>
                        </div>
                    </form>
                </div>

                <div class="card-container">
                    <?php
                    // Constructing the SQL query based on filters
                    $sql = "SELECT * FROM products WHERE 1";

                    if (isset($_GET['categories']) && !empty($_GET['categories'])) {
                        $categories = implode("','", $_GET['categories']);
                        $sql .= " AND category IN ('$categories')";
                    }

                    if (isset($_GET['brands']) && !empty($_GET['brands'])) {
                        $brands = implode("','", $_GET['brands']);
                        $sql .= " AND brand IN ('$brands')";
                    }

                    if (isset($_GET['min_price']) && $_GET['min_price'] != '') {
                        $min_price = $_GET['min_price'];
                        $sql .= " AND price >= $min_price";
                    }

                    if (isset($_GET['max_price']) && $_GET['max_price'] != '') {
                        $max_price = $_GET['max_price'];
                        $sql .= " AND price <= $max_price";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = 'uploaded_img/' . $row["image"];
                            // Adding anchor tag with product ID as query parameter
                            echo "<a href=\"product_details.php?id=" . $row['id'] . "\">";
                            echo "<div class=\"card-store\">";
                            echo "<img src=\"$imagePath\" alt=\"Product Image\">";
                            echo "<div>";
                            echo "<p>" . $row["name"] . "</p>";
                            echo "</div>";
                            echo "<div>";
                            echo "<p class=\"cardp\">RM " . $row["price"] . "</p>";
                            echo "</div>";
                            echo '<div><input type="submit" class="btn" name="add_product" value="Add to cart" style="font-weight: bold; background-color: #289f47; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; text-decoration: none;" onmouseover="this.style.backgroundColor=\'#2b802b\';" onmouseout="this.style.backgroundColor=\'#289f47\';"></div>';
                            echo "</div>";
                            echo "</a>";
                        }
                    } else {
                        echo "<p>No products found</p>";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include "footer.html" ?>
</html>
