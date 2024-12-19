<?php
// Include your database connection and any necessary configurations
@include '../../../includes/config.php';

$message = []; // Array to store messages

// Function to sanitize input data
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Add item to cart
if(isset($_POST['add_to_cart'])) {
    // Sanitize and retrieve form data
    $user_id = sanitize($conn, $_POST['user_id']);
    $id = sanitize($conn, $_POST['id']); // Assuming 'id' corresponds to 'product_id'
    $quantity = sanitize($conn, $_POST['quantity']);

    // Validate form fields
    if(empty($user_id) || empty($id) || empty($quantity)) {
        $message[] = 'Please fill out all fields';
    } else {
        // Check if item already exists in the cart for the user
        $check_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND id = '$id'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Item already exists in cart, update quantity
            $update_query = "UPDATE cart SET quantity = quantity + '$quantity' WHERE user_id = '$user_id' AND id = '$id'";
            $update_result = mysqli_query($conn, $update_query);

            if($update_result) {
                $message[] = 'Quantity updated in the cart';
            } else {
                $message[] = 'Failed to update quantity in the cart';
            }
        } else {
            // Item does not exist in cart, insert new record
            $insert_query = "INSERT INTO cart (user_id, id, quantity) VALUES ('$user_id', '$id', '$quantity')";
            $insert_result = mysqli_query($conn, $insert_query);

            if($insert_result) {
                $message[] = 'Item added to cart successfully';
            } else {
                $message[] = 'Failed to add item to cart';
            }
        }
    }
}

// Handle cart item deletion
if(isset($_GET['delete'])) {
    $cart_id = sanitize($conn, $_GET['delete']);
    $delete_query = "DELETE FROM cart WHERE cart_id = '$cart_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if($delete_result) {
        $message[] = 'Item removed from cart';
    } else {
        $message[] = 'Failed to remove item from cart';
    }
}

// Fetch and display cart items
$select_query = "SELECT cart.cart_id, cart.user_id, cart.id AS product_id, cart.quantity, products.image
                FROM cart
                INNER JOIN products ON cart.id = products.id
                ORDER BY cart.cart_id DESC"; // Adjust JOIN condition based on your database structure

$select_result = mysqli_query($conn, $select_query);
?>
