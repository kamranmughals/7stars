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

//if the user was logged in and add to cart was pressed
if(isset($_POST['product-add']) || isset($_POST['product-buy'])) {
    if(!isset($_SESSION['login'])) {
        header('location: login.php');
        exit();
    }
    $userId = $_SESSION['login']['id'];
    $productId = $_GET['id'];
    $quantity = $_POST['product-quantity'];
    $query2 = "select * from cart where user_id=? and product_id=?";
    $stmt = $conn->prepare($query2);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    $stmt->close();
    if(empty($result)) {
        $query2 = "insert into cart set user_id=?, product_id=?, quantity=?";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param("iii", $userId, $productId, $quantity);
        $stmt->execute();
    } else {
        if($result['quantity'] != $quantity) {
            $query2 = "update cart set quantity=? where user_id=? and product_id=?";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("iii", $quantity,$userId, $productId);
            $stmt->execute();
        }

    }
    if(isset($_POST['product-buy'])) {
        header('location: shoppingCart.php');
        exit();
    }
    $stmt->close();
    unset($_POST);
}


 $id = $_GET['id'];
 $query = "select description, image, price, category, gender, visible, notes from products where id=?";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("i", $id);
 $result = $stmt->execute();
 if(!$result) {
     header('location: index.php');
     exit();
 }


 $result = $stmt->get_result()->fetch_array();
 if(empty($result)) {
     header('location: index.php');
     exit();
 }
 $image = substr($result[1], 3, strlen($result[1]));
 $description = ucfirst($result[0]);
 $price = number_format($result[2], 0);
 $category = $result[3];
 $notes = $result[6];
 $gender = $result[4];
 $visible = $result[5];
 $stmt->close();


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
    <link rel="stylesheet" href="css/zoomove.css">

</head>
<style>
    .button {
        background-color: #e7ab3c;
        margin-top: 50px;
        border: none;
        width: 200px;
        color: white;
        padding: 10px 21px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .button2 {
        background-color: #e7ab3c;
        margin-top: 70px;
        border: none;
        width: 40px;
        color: white;
        padding: 8px 3px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .main-container {
        margin-bottom: 150px;
    }


    .counter {
        width: 60px;
        height: 40px;
        text-align: center;
        border: none;
        border-top: 1px solid #e7ab3c;
        border-bottom: 1px solid #e7ab3c;
    }
    .up_count {

        margin-bottom: 7px;
        margin-left: -5px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .down_count {
        margin-bottom: 5px;
        margin-right: -4px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    p.products-category {
        color: #b2b2b2;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;

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
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <span> Product details </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hero Section Begin -->
<div class="main-container container mt-5">
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <figure class="zoo-item" data-zoo-scale="2" data-zoo-image="<?php echo $image;?>"></figure>
        </div>
        <div class="col-lg-7 col-sm-12">
            <h4><?php echo $description; ?></h4>
            <p><?php echo $notes; ?></p>
            <p class="products-category"><?php echo $category. " - " . $gender; ?></p>
            <h5><?php echo $price. " PKR"; ?></h5><br>
            <form action="productView.php?id=<?php echo strval($id); ?>" method="post">
                <div class='main'>
                    <button type="button" class='down_count button2' title='Down'><i class='icon-minus'>-</i></button>
                    <input type="text" class="counter" name="product-quantity" readonly="readonly"  value="1">
                    <button type="button" class='up_count button2' title='Up'>+<i class='icon-minus'></i></button>
                </div><br>

                <?php if($visible): ?>
                <input type="submit" value="Add to Cart" name="product-add" class="button">
                <input type="submit" value="Buy Now" name="product-buy" class="button">
                <?php else: echo "<h4 style='font-style: italic; color: red'>Out of stock</h4>";endif;?>


            </form>
        </div>
    </div>

</div>

<!-- Hero Section End -->






    <!-- Footer Section Begin -->
    <?php require "controllers/footer.php"; ?>

<!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="js/zoomove.js"></script>
    <script>$('.zoo-item').ZooMove({
        cursor: 'true',
        scale: '1.1',
    });</script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/notifications.js"></script>
    <script src="js/main.js"></script>
<script>

    $(document).ready(function(){
        $('button').click(function(e){
            var button_classes, value = +$('.counter').val();
            button_classes = $(e.currentTarget).prop('class');
            if(button_classes.indexOf('up_count') !== -1){
                value = (value) + 1;
            } else {
                value = (value) - 1;
            }
            value = value < 1 ? 1 : value;
            $('.counter').val(value);
        });
        $('.counter').click(function(){
            $(this).focus().select();
        });
    });
</script>


</body>

</html>