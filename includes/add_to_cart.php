<?php
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    // Validate product ID and quantity
    if ($product_id <= 0 || $quantity <= 0) {
        echo "Invalid product ID or quantity.";
        exit();
    }

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

    // Fetch product details from database
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Check if there is sufficient quantity in stock
        if ($quantity <= $product['quantity']) {
            // Check if the product is already in the user's cart
            $user_id = $_SESSION['user_id']; // Assuming you have a user session
            $check_sql = "SELECT * FROM cart WHERE user_id = ? AND id = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("ii", $user_id, $product_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                // Update quantity in cart
                $update_sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("iii", $quantity, $user_id, $product_id);

                if ($update_stmt->execute()) {
                    // Update product quantity in products table
                    $new_stock = $product['quantity'] - $quantity;
                    $update_products_sql = "UPDATE products SET quantity = ? WHERE id = ?";
                    $update_products_stmt = $conn->prepare($update_products_sql);
                    $update_products_stmt->bind_param("ii", $new_stock, $product_id);

                    if ($update_products_stmt->execute()) {
                        // Redirect back to product page or cart page
                        header('Location: ../product_details.php?id=' . $product_id);
                        exit();
                    } else {
                        echo "Error updating product quantity: " . $conn->error;
                    }
                } else {
                    echo "Error updating cart: " . $conn->error;
                }
            } else {
                // Insert into cart table
                $insert_sql = "INSERT INTO cart (user_id, id, quantity) VALUES (?, ?, ?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bind_param("iii", $user_id, $product_id, $quantity);

                if ($insert_stmt->execute()) {
                    // Update product quantity in products table
                    $new_stock = $product['quantity'] - $quantity;
                    $update_products_sql = "UPDATE products SET quantity = ? WHERE id = ?";
                    $update_products_stmt = $conn->prepare($update_products_sql);
                    $update_products_stmt->bind_param("ii", $new_stock, $product_id);

                    if ($update_products_stmt->execute()) {
                        // Redirect back to product page or cart page
                        header('Location: ../product_details.php?id=' . $product_id);
                        exit();
                    } else {
                        echo "Error updating product quantity: " . $conn->error;
                    }
                } else {
                    echo "Error adding to cart: " . $conn->error;
                }
            }
        } else {
            echo "Insufficient stock. Available quantity: " . $product['quantity'];
        }
    } else {
        echo "Product not found";
    }

    // Close database connection
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
