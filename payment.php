<?php include_once "includes/session.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/newpayment.css">
</head>
<?php include "header.php"; ?>
<body class="bodybg">
    <div class="relativedesign">
        <div class="paymentbody">
            <div class="leftside">
                <div class="detail1">
                    <p class="marginaccount1">Account</p>
                    <p><?php echo $email; ?></p>
                    <p><?php echo $username; ?></p>
                </div>
                <hr>
                <div class="detail2">
                    <h3>Delivery</h3>
                    <form action="includes/add_order.php" method="post" class="paymentform" target="_blank">
                        <!-- User details inputs -->
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="address" placeholder="Address" required>
                        <div class="addressdetail">
                            <input type="number" name="postcode" placeholder="Postcode" required>
                            <input type="text" name="city" placeholder="City" required>
                            <select id="state" name="state" class="statestyle" required>
                                <option value="" disabled selected hidden>State</option>
                                <option value="johor">Johor</option>
                                <option value="kedah">Kedah</option>
                                <option value="perlis">Perlis</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <input type="tel" name="phone" placeholder="Phone" required>
                        <hr>
                        <!-- Card details inputs -->
                        <h3>Card Details</h3>
                        <input type="text" name="first_name" placeholder="First name on card" required>
                        <input type="text" name="last_name" placeholder="Last name on card" required>
                        <input type="text" name="cardnumber" placeholder="Card Number" required>
                        <div class="addressdetail2">
                            <input type="number" name="mm" placeholder="MM" required>
                            <input type="number" name="yyyy" placeholder="YYYY" required>
                            <input type="number" name="cvv" placeholder="CVV" required>
                        </div>
                        <!-- Hidden inputs for items and quantities -->
                        <input type="hidden" name="items" value='<?php echo json_encode($_POST['items']); ?>'>
                        <input type="hidden" name="quantity" value='<?php echo json_encode($_POST['quantity']); ?>'>
                        <!-- Hidden input for total amount -->
                        <input type="hidden" name="total_amount" value='<?php echo number_format($total, 2); ?>'>
                        <!-- Submit button -->
                        <input type="submit" value="Submit" id="submit" class="submitpayment">
                    </form>
                </div>
            </div>
            <div class="rightside">
                <!-- Display cart summary -->
                <?php if (isset($_POST['items']) && isset($_POST['quantity'])) : ?>
                    <?php
                    $items = $_POST['items'];
                    $quantities = $_POST['quantity'];
                    $subtotal = 0;
                    $shipping = 0;
                    $totalquantity = 0;

                    foreach ($items as $id => $item) {
                        $quantity = $quantities[$id];
                        $totalquantity += $quantity;
                        $item_name = $item['name'];
                        $item_price = $item['price'];
                        $item_image = $item['image'];
                        $item_subtotal = $item_price * $quantity;
                        $subtotal += $item_subtotal;

                        echo '<div class="imgstyle">';
                        echo '<img src="uploaded_img/' . $item_image . '" class="paymentimg">';
                        echo '<div class="textrightimg">';
                        echo '<p>' . $item_name . '</p>';
                        echo '<p>Quantity: ' . $quantity . '</p>';
                        echo '</div>';
                        echo '<div class="textrightprice">';
                        echo '<p>RM ' . number_format($item_subtotal, 2) . '</p>';
                        echo '</div>';
                        echo '</div>';
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
                    $total = $subtotal + $shipping;
                    ?>
                    <!-- Display summary of prices -->
                    <div class="pricetotalstyle">
                        <div class="totalleftprice">
                            <p>Subtotal</p>
                            <p>Shipping</p>
                            <p>Points</p>
                            <p>Membership discount</p>
                            <p class="boldprice">Total</p>
                        </div>
                        <div class="totalrightprice">
                            <p><?php echo 'RM ' . number_format($subtotal, 2); ?></p>
                            <p><?php echo 'RM ' . number_format($shipping, 2); ?></p>
                            <p>RM 0.00</p> <!-- Points amount -->
                            <p>RM 0.00</p> <!-- Membership discount -->
                            <p class="boldprice"><?php echo 'RM ' . number_format($total, 2); ?></p>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- If no items are in cart -->
                    <p>No items in cart.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php"; ?>
</html>
