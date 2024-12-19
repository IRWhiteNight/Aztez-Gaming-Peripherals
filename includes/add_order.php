<?php
include_once "session.php";
include_once "config.php"; // Include your database connection file

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and capture form data
    $user_id = $_SESSION['user_id'] ?? null;
    $user_name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $post_code = $_POST['postcode'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Validate items and quantities
    $items = json_decode($_POST['items'], true) ?? [];
    $quantities = json_decode($_POST['quantity'], true) ?? [];
    $subtotal = 0;
    $totalquantity = 0;

    foreach ($items as $id => $item) {
        if (!isset($quantities[$id])) {
            echo "Invalid item quantities.";
            exit();
        }
        $quantity = $quantities[$id];
        $totalquantity += $quantity;
        $subtotal += $item['price'] * $quantity;
    }

    // Calculate shipping based on total quantity
    if ($totalquantity <= 2) {
        $shipping = 20;
    } elseif ($totalquantity <= 4) {
        $shipping = 50;
    } else {
        $shipping = 100;
    }

    // Calculate total amount
    $total_amount = $subtotal + $shipping;

    // Insert into orders table
    $sql = "INSERT INTO orders (user_id, user_name, order_date, total_amount, delivery_status, address, city, state, post_code, phone)
            VALUES (?, ?, NOW(), ?, 'Pending', ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "SQL Error: " . $conn->error;
        exit();
    }

    // Bind parameters to the statement
    $stmt->bind_param("ssdsssss", $user_id, $user_name, $total_amount, $address, $city, $state, $post_code, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the newly inserted order ID
        $order_id = $stmt->insert_id;

        // Store order_id in session for later retrieval in resit.php
        $_SESSION['order_id'] = $order_id;

        // Redirect to resit.php with order_id parameter
        header("Location: ../resit.php?order_id=" . $order_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
