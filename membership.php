<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/membership.css"> 

</head>
<?php include "header.php"?>
<body class="memberdesignbody">
    <div class="mainmembership">

        <div class="membershipbody">
            <h1 class="greentext">Membership</h1>
            <p>"Unlock Exclusive Benefits Today!"</p>

            <p>By becoming our member you have unlock a legendary benefits to enhace your gaming experience</p>
        <hr>
        </div>

        <div class="cardline">
            <div class="card gold">
                <img src="img/gold-01.png" alt="Card Image" class="card-img">
                <div class="card-content">
                    <h2 class="card-title greentext">Gold</h2>
                    <p class="card-description">20% Discount on All Items</p>
                    <p class="card-description">MYR 200</p>
                    <a href="#" class="card-btn">Purchase</a>
                </div>
            </div>
            <div class="card bronze">
                <img src="img/bronze-01.png" alt="Card Image" class="card-img">
                <div class="card-content">
                    <h2 class="card-title greentext">Bronze</h2>
                    <p class="card-description">15% Discount on All Items</p>
                    <p class="card-description">MYR 150</p>
                    <a href="#" class="card-btn">Purchase</a>
                </div>
            </div>
            <div class="card silver">
                <img src="img/silver-01.png" alt="Card Image" class="card-img">
                <div class="card-content">
                    <h2 class="card-title greentext">Silver</h2>
                    <p class="card-description">10% Discount on All Items</p>
                    <p class="card-description">MYR 100</p>
                    <a href="#" class="card-btn">Purchase</a>
                </div>
            </div>
        </div>

        <div class="payment">
            <div class="paymentdesign">
            <h1 class="greentext">Payment Method</h1>
            <form action="post">
                <h3>Debit Card / Credit Card</h3>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" placeholder="First name on card" class="full-width">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" placeholder="Last name on card" class="full-width">
                </div>
                <div class="form-group">
                    <label for="card-number">Credit Card Details</label>
                    <input type="number" id="card-number" placeholder="Card number" class="full-width">
                </div>
                <div class="form-group ownstyle">
                    <input type="number" placeholder="MM" class="">
                    <input type="number" placeholder="YYYY" class="">
                    <input type="number" placeholder="CVV" class="margin0">
                </div>
                <input type="submit" value="Submit" class="card-btn-submit">
            </form>
            </div>
        </div>

        <div class="bannermembership">
            <img src="img/bannerprofile-01-01-01-01.png" class="imgmembership">
            <div class="ontopmembership">
                <h1>JOIN OUR ARMY</h1>
                <p>Get get up to 50% for member</p>
                <p>*For member only</p>
                <a href="#" class="membershipjoin">Join</a>
            </div>
        </div>
    </div>
</body>
<?php include "footer.html"?>
</html>
