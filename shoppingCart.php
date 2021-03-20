<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
require_once "controllers/db_connection_manager.php";

session_start();
$userId = $_SESSION['login']['id'];
if(!isset($userId)) {
    header('location: login.php');
    exit();
}


if(isset($_GET['id']) && isset($_GET['del']) && $_GET['del'] == true) {
    $productId = $_GET['id'];
    $deleteProduct = $_GET['del'];
    $query = "delete from cart where user_id=? and product_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $stmt->close();
}
$query = "select products.*, cart.quantity from products inner join cart on products.id=product_id and cart.user_id=$userId;";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
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

<body onunload="">

<?php require "controllers/header.php"; ?>


    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>

                            <?php
                            if($result) {
                                $totalPrice = 0;
                            ?>
                            <tbody>
                            <?php
                            while($row = $result->fetch_assoc()):
                                $productId = $row['id'];
                                $productDescription = $row['description'];
                                $productPrice = $row['price'];
                                $productQuantity = $row['quantity'];
                                $productTotalPrice = $productPrice * $productQuantity;
                                $totalPrice += $productTotalPrice;
                                ?>
                                <tr>
                                    <td class="cart-pic first-row"><a href="productView.php?id=<?php echo $productId ?>"><img src="<?php echo substr($row['image'],3, strlen($row['image'])) ?>" alt=""></a></td>
                                    <td class="cart-title first-row">
                                        <h5><?php echo $productDescription; ?></h5>
                                    </td>
                                    <td class="p-price first-row"><?php echo number_format($productPrice, 0) . " PKR"; ?></td>
                                    <td class="cart-title first-row">
                                        <h5 style="text-align: center;"><?php echo $productQuantity; ?></h5>
                                    </td>
                                    <td class="total-price first-row"><?php echo number_format($productTotalPrice, 0) . " PKR"; ?></td>
                                    <td class="close-td first-row"><a href="<?php echo "shoppingCart.php?id=".$productId. "&del=true"; ?>"><i class="ti-close"></i></a></td>
                                </tr>

                            <?php endwhile; }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span><?php echo number_format($totalPrice, 0) ." PKR";?></span></li>
                                    <li class="cart-total">Total <span><?php echo number_format($totalPrice, 0) . " PKR"?></span></li>
                                </ul>
                                <a href="checkout.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="js/notifications.js"></script>
</body>

</html>