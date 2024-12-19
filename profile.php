<?php
include_once "includes/session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css"> 
</head>
<?php include "header.php"?>
<body class="designprofilebody">
    <div class="mainprofile">
        <div class="profilebody">
            <img src="img/1668641182136.jpg" class="imgbg">
            <div class="profileadjust">
            <form method="post" enctype="multipart/form-data" action="includes/upload_image.php">
                    <label for="profile_image">
                        <img src="uploaded_img/<?php echo isset($user_image) ? $user_image : '../img/default.jpg'; ?>" class="profileimg">
                    </label>
                    <input type="file" id="profile_image" name="profile_image" style="display: none;" onchange="this.form.submit()">
                </form>
                <div class="profilecomponent">
                    <p><?php echo $username; ?></p>
                    <div class="titleprofile">
                        <p><?php echo $membership_type; ?></p>
                    </div>
                </div>
            </div>
            <form method="post" action="controller/logout_controller.php">
                <button type="submit" class="logoutbutton">
                    <p>Logout</p>
                    <i style="font-size:24px" class="fa">&#xf011;</i>
                </button>
            </form>
        </div>
        <div class="samesame">
            <div class="member">
                <h1>Manage Your Profile</h1>
                <h2>You can manage your profile to do the following:</h2>
                <div class="line">
                    <div class="membership">
                        <i class="fa fa-angle-double-right icon1"></i>
                        <div class="line">
                            <p>Update your personal details</p>
                        </div>                
                    </div>
                    <div class="membership" style="margin-left: 50px;">
                        <i class="fa fa-angle-double-right icon1"></i>
                        <div>
                            <div class="line">
                                <p>Change email and password</p>
                            </div>  
                        </div>                
                    </div>
                    <div class="membership" style="margin-left: 50px;">
                        <i class="fa fa-angle-double-right icon1"></i>
                        <div>
                            <div class="line">
                                <p>Manage the details for address</p>
                            </div>  
                        </div>                
                    </div>
                </div>
            </div>
            <div class="joinbutton">
                <a href="#" class="join">Update</a>
            </div>
        </div>
        <hr>
        <div class="samesame">
            <div class="member">
                <h1>Brand Membership</h1>
                <h2>Become a member to maximize your experience!</h2>
                <div class="line">
                    <div class="membership">
                        <i class="material-icons icon">computer</i>
                        <div>
                            <p>Discount up to 50%</p>
                            <p>Become a member to get the Victory</p>
                        </div>                
                    </div>
                    <div class="membership" style="margin-left: 50px;">
                        <i class="material-icons icon">cloud</i>
                        <div>
                            <p>Discount up to 50%</p>
                            <p>Become a member to get the Victory</p>
                        </div>                
                    </div>
                </div>
            </div>
            <div class="joinbutton">
                <a href="membership.php" class="join">JOIN</a>
            </div>
        </div>
        <hr>
        <div class="memberlast">
            <h1>Your Item Orders</h1>
            <div class="ordercart-card">
                <img src="img/mouse-01.png" alt="Razer Mouse">
                <div class="ordercart-card-content">
                    <h3>Razer Mouse x1</h3>
                    <p>Total Price: RM1000</p>
                    <div class="ordercart-card-content-tracking">
                    </div>
                </div>
                <div class="orderstatus">
                    <div class="status-box" id="statusBox"><div class="loading-spinner"></div>Preparing...</div>
                </div>
            </div>
            <div class="ordercart-card">
                <img src="img/mouse-01.png" alt="Razer Mouse">
                <div class="ordercart-card-content">
                    <h3>Razer Mouse</h3>
                    <p>Total Price: RM1000</p>
                    <div class="ordercart-card-content-tracking">
                        <h5>Tracking Number :RXAHBSDAN123</h5>
                    </div>
                </div>
                <div class="orderstatus">
                    <div class="ship-box">Shipping...</div>
                </div>
            </div>
            <div class="ordercart-card">
                <img src="img/mouse-01.png" alt="Razer Mouse">
                <div class="ordercart-card-content">
                    <h3>Razer Mouse</h3>
                    <p>Total Price: RM1000</p>
                    <div class="ordercart-card-content-tracking">
                        <h5>Tracking Number :RXAHBSDAN123</h5>
                    </div>
                </div>
                <div class="orderstatus">
                    <div>delivered</div>
                </div>
            </div>
        </div>
        <div><hr></div>
    </div>
    <div class="bannerprofile">
        <img src="img/bannerprofile-01-01-01-01.png" class="imgbg1">
        <div class="ontop">
            <h1 class="icon">JOIN OUR ARMY</h1>
            <p>Get up to 50% for member</p>
            <p>*For member only</p>
            <a href="membership.php" class="profilejoin">Join</a>
        </div>
    </div>
    <script></script>
</body>
<?php include "footer.html"?>
</html>
