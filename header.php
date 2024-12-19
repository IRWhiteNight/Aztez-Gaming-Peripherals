<?php
// Start or resume a session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple HTML Page with Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" type="text/css" href="css/header.css"> 

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header class="header1">
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="index.php"><img class="imgsize" src="img/logoproject-01-01.png"></a></li>
            <li class="nav-item"><a href="#">About</a></li>
            <li class="nav-item"><a href="store.php">Store</a></li>
            <li class="nav-item">
                <a href="#" id="search-icon"><i class="fa fa-search"></i></a>
                <div class="search-box" id="search-box">
                    <input type="text" placeholder="Search...">
                </div>
            </li>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <li class="nav-item"><a href="profile.php"><i class="fa fa-user"></i></a></li>
            <?php else: ?>
                <li class="nav-item"><a href="login.php">Login</a></li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                <div class="cart-notification" id="cart-notification"></div>
            </li>
        </ul>
    </nav>

    <div class="promo">
        <p>AZTEZ Rewards Giveaway: Become a member and stand to win the Razer Nommo V2 Pro. Join Now ></p>
    </div>

    <script>
        document.getElementById('search-icon').addEventListener('click', function(event) {
            event.preventDefault();
            var searchIcon = document.getElementById('search-icon');
            var searchBox = document.getElementById('search-box');
            searchIcon.style.display = 'none';
            searchBox.style.display = 'block';
            searchBox.querySelector('input').focus();
        });

        document.addEventListener('click', function(event) {
            var searchIcon = document.getElementById('search-icon');
            var searchBox = document.getElementById('search-box');
            if (!searchBox.contains(event.target) && !searchIcon.contains(event.target)) {
                searchBox.style.display = 'none';
                searchIcon.style.display = 'block';
            }
        });

        function updateCartNotification() {
            $.ajax({
                type: "GET",
                url: "includes/get_cart_count.php", // Adjust this path if needed
                success: function(response) {
                    var cartNotification = document.getElementById('cart-notification');
                    var count = parseInt(response);
                    if (!isNaN(count)) {
                        if (count > 0) {
                            cartNotification.style.display = 'block';
                            cartNotification.textContent = count;
                        } else {
                            cartNotification.style.display = 'none';
                        }
                    } else {
                        console.error('Invalid response from server.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error fetching cart count.');
                }
            });
        }

        // Call the function initially and whenever necessary
        updateCartNotification();

    </script>
</header>
</body>
</html>
