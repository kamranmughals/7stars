<div class="header-top">
    <div class="container">
        <div class="ht-left">
            <div class="mail-service">
                <i class="fa fa-envelope"></i>
info@7stars.pk
</div>
            <div class="phone-service">
                <i class="fa fa-phone"></i>
+92 3466824422
</div>
        </div>
        <div class="ht-right">
            <?php
                if(isset($_SESSION['login'])):
            ?>
               <a href="index.php" class="login-panel"><i class="fa fa-user-circle"></i>Welcome <?php echo $_SESSION['login']['name'];?></a>
               <a href="controllers/logout.php" class="login-panel"><i class="fa fa-sign-out"></i>Logout</a>
            <?php else: ?>
                <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <a href="register.php"  class="login-panel"><i class="fa fa-user"></i>Register</a>
            <?php endif; ?>
            <div class="top-social">
                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
              
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="inner-header">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="logo d-md-block d-flex justify-content-center">
                    <a href="./index.php">
                        <img src="icons/circle-cropped (7).png" alt="7stars">
                        <span class="logo-text">7stars</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 d-md-flex justify-content-md-center">
                <ul class="nav-right">
                    <li class="cart-icon">
                        <a href="shoppingCart.php">
                            <i class="icon_bag_alt"></i>
                            <span id="cartQuantity"></span>
                        </a>
                    </li>
                    <li id="cartPrice" class="cart-price"></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="nav-item">
    <div class="container">

        <nav class="nav-menu mobile-menu" >
            <ul>

                <?php
                if($page_name === "index" ) {
                    $home_page =  'class="active"';
                } else if ($page_name === "contact") {
                    $contact_page = 'class="active"';
                } else if ($page_name === "about") {
                    $about_page = 'class="active"';
                } else if ($page_name === "orders") {
                    $order_page = 'class="active"';
                }
                echo '<li '.$home_page .'><a href="index.php">Home</a></li>';
                //show orders with restricted access
                echo '<li '.$order_page.'><a href="./orders.php">Orders</a></li>';

                echo '<li '.$contact_page.'><a href="./contact.php">Contact</a></li><li '.$about_page.'><a href="./about.php">About Us</a></li>';
                ?>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
</div>