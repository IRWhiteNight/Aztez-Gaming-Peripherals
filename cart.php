<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/cart.css"> 
    <link rel="stylesheet" type="text/css" href="css/header.css"> 
    <link rel="stylesheet" type="text/css" href="css/footer.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .quantitycart-input {
            border: none;
            width: 40px;
            text-align: center;
            padding: 5px;
            font-size: 14px;
        }

        .quantitycart-input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            margin: 0;
        }

        .quantitycart-input::-webkit-outer-spin-button,
        .quantitycart-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<?php 
include "header.php";
include_once "includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id, cart.quantity, products.name, products.price, products.image FROM cart INNER JOIN products ON cart.id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<body class="bodycartcart">
    <div class="cartbody">
        <div class="cartcomponent">
            <h1>Your Cart</h1>

            <form action="payment.php" method="post">
                <?php 
                $total = 0;
                $totalPrice = 0;
                $totalquantity = 0;
                $shipping = 0;
                while ($row = $result->fetch_assoc()) {
                    $item_id = $row['id'];
                    $quantity = $row['quantity'];
                    $totalquantity += $row['quantity'];
                    $item_name = $row['name'];
                    $item_price = $row['price'];
                    $item_image = $row['image'];
                    if ($totalquantity <= 2) {
                        $shipping = 20;
                    } else if ($totalquantity <= 4) {
                        $shipping = 50;
                    } else {
                        $shipping = 100;
                    }
                    $subtotal = $item_price * $quantity;
                    $total += $subtotal;
                    $totalPrice = $total + $shipping;

                    echo '<div class="cart-card">';
                    echo '<img src="uploaded_img/' . $item_image . '" alt="' . $item_name . '">';
                    echo '<div class="cart-card-content">';
                    echo '<h3>' . $item_name . '</h3>';
                    echo '<p>Price: RM' . number_format($item_price, 2) . '</p>';
                    echo '</div>';
                    echo '<div class="quantity-cart">';
                    echo '<p>Quantity</p>';
                    echo '<button type="button" class="quantitycart-button" onclick="changeQuantity(' . $item_id . ', -1)">-</button>';
                    echo '<input type="number" class="quantitycart-input" id="cartquantity' . $item_id . '" name="quantity[' . $item_id . ']" value="' . $quantity . '" min="1" onchange="updateQuantity(' . $item_id . ')">';
                    echo '<button type="button" class="quantitycart-button" onclick="changeQuantity(' . $item_id . ', 1)">+</button>';
                    echo '</div>';
                    echo '<div class="cart-price">';
                    echo 'RM' . number_format($subtotal, 2);
                    echo '</div>';
                    echo '</div>';

                    echo '<input type="hidden" name="items[' . $item_id . '][name]" value="' . $item_name . '">';
                    echo '<input type="hidden" name="items[' . $item_id . '][price]" value="' . $item_price . '">';
                    echo '<input type="hidden" name="items[' . $item_id . '][image]" value="' . $item_image . '">';
                }

                $stmt->close();
                ?>
                <hr>
                <div class="carttot">
                    <h1>Subtotal</h1>
                    <div class="pricetot">
                        <h3><?php echo 'RM' . number_format($totalPrice, 2); ?></h3>
                    </div>
                </div>
                <div class="cartt">
                    <p>Aztez Point</p>
                    <div class="pricetot">
                        <h3><?php echo 'RM 5'; ?></h3>
                    </div>
                </div>
                <div class="cartt">
                    <p>Aztez Membership</p>
                    <div class="pricetot">
                        <h3><?php echo 'RM 100'; ?></h3>
                    </div>
                </div>
                <div class="cartt">
                    <p>Taxes and shipping calculated at checkout</p>
                    <div class="pricetot">
                        <h3><?php echo 'RM' . number_format($shipping, 2); ?></h3>
                    </div>
                </div>
                <button type="submit" class="submittot">Checkout</button>
            </form>
        </div>
    </div>
    <script>
        function changeQuantity(itemId, amount) {
            const quantityInput = document.getElementById('cartquantity' + itemId);
            let currentQuantity = parseInt(quantityInput.value);
            if (isNaN(currentQuantity)) currentQuantity = 0;
            const newQuantity = currentQuantity + amount;
            if (newQuantity > 0) {
                quantityInput.value = newQuantity;
                updateQuantity(itemId);
            }
        }

        function updateQuantity(itemId) {
            const quantityInput = document.getElementById('cartquantity' + itemId);
            const newQuantity = parseInt(quantityInput.value);
            if (isNaN(newQuantity) || newQuantity <= 0) {
                alert('Invalid quantity.');
                return;
            }

            $.ajax({
                type: "POST",
                url: "includes/update_cart.php",
                data: {
                    item_id: itemId,
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.trim() === 'success') {
                        calculateSubtotal();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating quantity.');
                }
            });
        }

        function calculateSubtotal() {
            // Implement logic to refresh subtotal on the page if needed
        }
    </script>
</body>
<?php include "footer.php"; ?>
</html>
