<?php
require "controllers/db_connection_manager.php";
// any valid date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified right now
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
// HTTP/1.0
header("Pragma: no-cache");
session_start();
if(!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
};
/*-----------------------Products in user's cart-------------------------*/
$userId = $_SESSION['login']['id'];
$query = "select products.*, cart.quantity from products inner join cart on products.id=product_id and cart.user_id=$userId";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
if(!$result || $result->num_rows < 1) {
    header('location: index.php');
    exit();
}


$order = [];
$content = "";
$shipping = 200;
$totalPrice = $shipping;
while($row = $result->fetch_assoc()) {
    $content .= '<li class="fw-normal">'.$row['description'].' X '.$row['quantity'].'<span>'.number_format($row['price']*$row['quantity'], 0).' PKR</span></li>';
    $totalPrice += ($row['price'] * $row['quantity']);
    $order [] = ['id' => $row['id'], 'quantity' => $row['quantity']];
}
$_SESSION['order']['order'] = $order;
$_SESSION['order']['total-price'] = $totalPrice;
$content .= '<li class="fw-normal">Subtotal <span>'.number_format($totalPrice-$shipping, 0).' PKR</span></li><li class="total-price text-capitalize">Shipping charges <span>'.number_format($shipping, 0). ' PKR</span></li><li class="total-price">Total <span>'.number_format($totalPrice, 0). ' PKR</span></li>';
$stmt->close();
/*-----------------------end: Products in user's cart-------------------------*/


/*-----------------------Order details from older order (if available)-------------------------*/
$query = "select * from orders where user_id=$userId order by id desc";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$result = $result->fetch_row();
$firstName = $lastName = $zipCode = $city = $street = $phone = "";
$email = $_SESSION['login']['email'];
if($result) {
    $firstName = $result[2];
    $lastName = $result[3];
    $zipCode = $result[6];
    $city = $result[7];
    $street = $result[5];
    $email = $result[4];
    $phone = $result [8];
}
$stmt->close();
/*-----------------------end: Order details from older order (if available)-------------------------*/
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179966867-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-179966867-1');
</script>

    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>7Stars</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<style>
    #myDIV {
        padding: 50px 0;
        text-align: center;
        background-color: #f8f8f0;
        margin-top: 20px;
        display: none;
    }

    #myDIV2 {
        padding: 50px 0;
        text-align: center;
        background-color: #f8f8f0;
        margin-top: 20px;
        display: none;
    }
</style>

<body>


<?php require "controllers/header.php"; ?>

<!-- Header End -->

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form action="controllers/order_control.php" method="post" class="checkout-form">
            <div class="row">
                <div class="col-lg-6">
                    <!--Extra div only for design--><div class="checkout-content"></div>
                    <h4>Billing Details</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="fir">First Name<span>*</span></label>
                            <input name="firstName" value="<?php echo $firstName; ?>" type="text" id="fir" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="last">Last Name<span>*</span></label>
                            <input name="lastName" value="<?php echo $lastName; ?>" type="text" id="last" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="street">Street Address<span>*</span></label>
                            <input name="address" value="<?php echo $street; ?>" type="text" id="street" class="street-first" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="zip">Postcode / ZIP (optional)</label>
                            <input name="zip" value="<?php echo $zipCode; ?>" type="text" id="zip" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="town">Town / City<span>*</span></label>
                            <input name="city" value="<?php echo $city; ?>" type="text" id="town" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email Address<span>*</span></label>
                            <input name="email" value="<?php echo $email; ?>" type="email" id="email" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Phone<span>*</span></label>
                            <input name="phone" value="<?php echo $phone; ?>" type="tel" id="phone" required>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <input hidden type="text" placeholder="Enter Your Coupon Code">
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                <?php echo $content; ?>
                            </ul>

                            <div class="order-btn">
                                <button type="submit" name="order-btn" id="order-btn" class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Footer Section Begin -->
<?php require "controllers/footer.php"; ?>

<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery.dd.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="processOrder.js"></script>
<script src="js/notifications.js"></script>
</body>

</html>