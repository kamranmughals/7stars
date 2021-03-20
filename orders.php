<?php
require "controllers/db_connection_manager.php";
session_start();

if(!isset($_SESSION['login']['id'])) {
    header('location: login.php');
    exit();
}
$userId = $_SESSION['login']['id'];
$user_orders = [];
$query = "select * from orders inner join junction_orders_products on id=order_id 
            inner join products on product_id=products.id where orders.user_id=$userId";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    if(!isset($user_orders[$row['order_id']])) {
        $user_orders [$row['order_id']] = array_slice($row, 1, 12);
    }

    $user_orders[$row['order_id']]['products'] [$row['product_id']] = array_slice($row, 13, sizeof($row));

}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
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

</head>

<style>

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #e7ab3c
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #e7ab3c;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }


</style>
<body>
<?php require "controllers/header.php"; ?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span> My Orders </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5 mb-5">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <?php
        if(empty($user_orders) ){ echo '<p>You have no orders.</p>';}
        foreach ($user_orders as $order): ?>
        <div class="card-body">
            <h6>Order ID: <?php echo $order['order_id'] ?></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Date:</strong> <br> <?php echo $order['date_time'] ?> </div>
                    <div class="col"> <strong>Address:</strong> <br> <?php echo $order['address'] ?> | <i class="fa fa-phone"></i>
                        <?php echo $order['phone'] ?> </div>
                    <div class="col"> <strong>Email:</strong> <br> <?php echo $order['email'] ?> </div>
                    <div class="col"> <strong>Total Price:</strong> <br> <?php echo number_format($order['total_price'], 0) . " PKR" ?> </div>

                </div>
            </article>
            <div class="track">
                <?php
                $confirmed = $shipped = $delivered = "";
                if($order['status'] === "confirmed") {
                    $confirmed = "active";

                } else if($order['status'] === "shipped") {
                    $confirmed = $shipped = "active";

                } else if($order['status'] === "delivered") {
                    $confirmed = $shipped = $delivered = "active";
                } ?>
                <div class="step <?php echo $confirmed ?? "" ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="step <?php echo $shipped ?? "" ?>"> <span class="icon"> <i class="fa fa-truck fa-flip-horizontal"></i> </span> <span class="text"> Shipped </span> </div>
                <div class="step <?php echo $delivered ?? "" ?>"> <span class="icon"> <i class="fa fa-gift"></i> </span> <span class="text">Delivered</span> </div>
            </div>
            <hr>
            <ul class="row">
                <?php foreach ($order['products'] as $product): ?>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="<?php echo substr($product['image'], 3); ?>"
                                                class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title"><?php echo $product['description'] . "<br> X" . $product['quantity']; ?>  </p> <span class="text-muted">
                            <?php echo number_format(($product['quantity'] * $product['price']), 0). " PKR"  ?></span>
                        </figcaption>
                    </figure>
                </li>
                <?php endforeach; ?>

            </ul>
            <hr>
        </div>
        <?php endforeach; ?>
    </article>
</div>
<!-- Footer Section Begin -->
<?php require "controllers/footer.php"; ?>
<!-- Header End -->
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
<script src="js/content_provider.js"></script>
<script src="js/notifications.js"></script>
</body>


</html>
