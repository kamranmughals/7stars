<?php
session_start();
if (isset($_GET["success"])) {
    $success = $_GET['success'];
    if ($success) {
        echo "<script>alert('Your order has been submitted successfully!');
        window.location.href.replace(window.location.search,'');
        </script>";
    } else {
        echo "<script>alert('There was an error processing your order. Please try again!')
        </script>";
    }
    
}

// any valid date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified right now
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
// HTTP/1.0
header("Pragma: no-cache");
$categoryTitle = "Our";
$CATEGORIES = ["men" => [
                            '<option value="Shameer-a-Khadar">Shameer-a-Khadar</option>',
                            '<option value="Jublie Lawrence Pur">Jublie Lawrence Pur</option>',
                            '<option value="Fancy Khadar">Fancy Khadar</option>',
                            '<option value="High Fashion">High Fashion</option>',
                            '<option value="Versache">vershache</option>',
                            '<option value="Taksan">Taksan</option>',
                            '<option value="Zayarat">Zayarat</option>',
                            '<option value="Rollax">Rollax</option>',
                            '<option value="Zafaran Winter">Zafaran Winter</option>',
                            '<option value="1200 Diaum">1200 Diram</option>',
                            '<option value="Special karandi">Special Karandi</option>',
                            '<option value="Karadi Khadar">Karandi Khadar</option>',
                            '<option value="Grace Bokhara">Grace BoKhara</option>',
                            '<option value="Rashid Khadar Brand">Rashid Khadar Brand</option>',
                            '<option value="Shasawar">Shasawar</option>',
                            '<option value="Cash Carry">Cash Carry</option>',
                            '<option value="Kamalia Khadar">Kamalia Khadar</option>',
                            '<option value="New-Way">New-Way</option>',
                            '<option value="Simack">Simack</option>',
                            '<option value="German Naps">German Naps</option>',
                            '<option value="Charming">Charming</option>',
                            '<option value="Lashkara">Lashkara</option>',
                            '<option value="Golden-Life">Golden-Life</option>',
                            '<option value="Golden-Plus">Golden-Plus</option>',
                            '<option value="Jalwa">Jalwa</option>',
                            '<option value="Dubai Collection">Dubai Collection</option>',
                            '<option value="Lawrence Pur">Lawrence Pur</option>',
                            '<option value="Shohana Wool">Shohana Wool</option>',
                            '<option value="Zartaaz Winter">Zartaaz Winter</option>',
                            '<option value="Sanitor">Sanitor</option>',
                            '<option value="Mariyo">Mariyo</option>',
                            '<option value="Jeeva Textile">Jeeva Textile</option>',
                            '<option value="HB Tex">HB Tex</option>'],
    "women" => [
        '<option value="Lawn">Lawn</option>',
        '<option value="Bridal">Bridal</option>'
    ]
    ];

if (isset($_GET['gender'])) {
    $categoryTitle = $_GET['gender'];
}

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
    <meta name="description" content="cloth house">
    <meta name="keywords" content="clothhouse, cloth house, 7stars, sevenstars,  kotla, fashion, botique, ladies, gents,  unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buy traditional Pakistani cloth for ladies and gents Online - Pakistan</title>
    <link rel="icon" href="icons/circle-cropped (7).png">
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
<body>
<?php
$page_name = "index";
require "controllers/header.php"; ?>
<!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="assets/men/banner.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>silk , men</span>
                            <h1>Gents Collection</h1>
                            <p>"Gents Collection are one of the most impressive collections so far. Buy Your Favourite Staff Here."</p>
                            <a href="#p" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>20%</span></h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="assets/women/banner.jpeg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>silk, women</span>
                            <h1>Weddings' collection</h1>
                            <p>Make your wedding day special with a glamorous wedding wear collection Check out our wedding wear collection.</p>
                            <a href="#p" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>20%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-banner">
                        <img src="assets/men/men.png" alt="">
                        <div class="inner-text">
                            <div class="select-button">
                                <a href="index.php?gender=men" class="primary-btn view-card">Men's</a>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-banner">
                        <img src="assets/women/women.jpeg" alt="">
                        <div class="inner-text">
                            <div class="select-button">
                                <a href="index.php?gender=women" id="women-button" class="primary-btn view-card" >Women's</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->
    </div class ="category">
<div class="container">
            <?php
                echo '<h2 class="collection-header">'.ucfirst($categoryTitle).' Collections</h2>';
            ?>
            <div class="row">
            <div class="col-md-4 col-sm-12 selection-col">
                    <select id="category-select" class="form-control">
                         <div class="inner-text">
                             <option value="" selected>Sort By Category</option>
                             <?php
                                if ($categoryTitle == "men") {
                                    for ($i = 0; $i < sizeof($CATEGORIES["men"]); $i++) {
                                        echo $CATEGORIES["men"][$i];
                                    }
                                }

                                else if($categoryTitle == "women") {
                                    for ($i = 0; $i < sizeof($CATEGORIES["women"]); $i++) {
                                        echo $CATEGORIES["women"][$i];
                                    }
                                } else {
                                    for ($i = 0; $i < sizeof($CATEGORIES["men"]); $i++) {
                                        echo $CATEGORIES["men"][$i];
                                    }
                                    for ($i = 0; $i < sizeof($CATEGORIES["women"]); $i++) {
                                        echo $CATEGORIES["women"][$i];
                                    }
                                }
                            ?>
                    </select>
                    </div>
                </div>
                
                <div id="product-box" class="row">

                </div>

                <div class="row d-flex justify-content-center" style="margin-bottom: 100px">
                    <button id="load-more-button" class="button-load">
                        <i class="fa fa-spinner"></i><span> Load more</span>
                    </button>
                </div>
                        </div>
                    </div>
                </div>
                </div>
<!-- Category sectiion ended-->
<!--
<div id="p"></div>
        <section class="product-shop">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 selection-col">
                        <select id="category-select" class="form-control">
                            <option value="" selected>Sort By Category</option>
                            <option value="Shameer-a-Khadar">Shameer-a-Khadar</option>
                            <option value="Jublie Lawrence Pur">Jublie Lawrence Pur</option>
                            <option value="Fancy Khadar">Fancy Khadar</option>
                            <option value="High Fashion">High Fashion</option>
                            <option value="Versache">vershache</option>
                            <option value="Taksan">Taksan</option>
                            <option value="Zayarat">Zayarat</option>
                            <option value="Rollax">Rollax</option>
                            <option value="Zafaran Winter">Zafaran Winter</option>
                            <option value="1200 Diaum">1200 Diram</option>
                            <option value="Special karandi">Special Karandi</option>
                            <option value="Karadi Khadar">Karandi Khadar</option>
                            <option value="Grace Bokhara">Grace BoKhara</option>
                            <option value="Rashid Khadar Brand">Rashid Khadar Brand</option>
                            <option value="Shasawar">Shasawar</option>
                            <option value="Cash Carry">Cash Carry</option>
                            <option value="Kamalia Khadar">Kamalia Khadar</option>
                            <option value="New-Way">New-Way</option>
                            <option value="Simack">Simack</option>
                            <option value="German Naps">German Naps</option>
                            <option value="Charming">Charming</option>
                            <option value="Lashkara">Lashkara</option>
                            <option value="Golden-Life">Golden-Life</option>
                            <option value="Golden-Plus">Golden-Plus</option>
                            <option value="Jalwa">Jalwa</option>
                            <option value="Dubai Collection">Dubai Collection</option>
                            <option value="Lawrence Pur">Lawrence Pur</option>
                            <option value="Shohana Wool">Shohana Wool</option>
                            <option value="Zartaaz Winter">Zartaaz Winter</option>
                            <option value="Sanitor">Sanitor</option>
                            <option value="Mariyo">Mariyo</option>
                            <option value="Jeeva Textile">Jeeva Textile</option>
                            <option value="HB Tex">HB Tex</option>
                            <option value="Lawn">Lawn</option>
                            <option value="Lilan">Lilan</option>
                            <option value="Cotton">Cotton</option>
                            <option value="Viscose">Viscose</option>
                            <option value="Silk">Silk</option>
                            <option value="Fancy">Fancy</option>
                            <option value="Palachi">Palachi</option>
                            <option value="Karandi">Karandi</option>
                            <option value="Bridal">Bridal</option>
                            <option value="Kotail">Kotail</option>
                            <option value="Staple Brosiha">Staple Brosiha</option>
                            <option value="Banarsi">Banarsi</option>
                            <option value="Multan Collection">Multan Collection</option>
                            <option value="Mareena">Mareena</option>
                        


        <section class="product-shop">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"></div>
                            <div class="select-option">
                                <select id="category-selection" class="form-control" >
                                    <option>Sort By Category</option>
                            <option value="Shameer-a-Khadar">Shameer-a-Khadar</option>
                            <option value="Jublie Larence Pur">Jublie Larence Pur</option>
                            <option value="Fancy Khadar">Fancy Khadar</option>
                            <option value="High Fashion">High Fashion</option>
                            <option value="Versache">vershache</option>
                            <option value="Taksan">Taksan</option>
                            <option value="Zayarat">Zayarat</option>
                            <option value="Rollax">Rollax</option>
                            <option value="Zafaran Winter">Zafaran Winter</option>
                            <option value="1200 Diaum">1200 Diram</option>
                            <option value="Special karandi">Special Karandi</option>
                            <option value="Karadi Khadar">Karandi Khadar</option>
                            <option value="Grace Bokhara">Grace BoKhara</option>
                            <option value="Rashid Khadar Brand">Rashid Khadar Brand</option>
                            <option value="Shasawar">Shasawar</option>
                            <option value="Cash Carry">Cash Carry</option>
                            <option value="Kamalia Khadar">Kamalia Khadar</option>
                            <option value="New-Way">New-Way</option>
                            <option value="Simack">Simack</option>
                            <option value="German Naps">German Naps</option>
                            <option value="Charming">Charming</option>
                            <option value="Lashkara">Lashkara</option>
                            <option value="Golden-Life">Golden-Life</option>
                            <option value="Golden-Plus">Golden-Plus</option>
                            <option value="Jalwa">Jalwa</option>
                            <option value="Dubai Collection">Dubai Collection</option>
                            <option value="Larence Pur">Larence Pur</option>
                            <option value="Shohana Wool">Shohana Wool</option>
                            <option value="Zartaaz Winter">Zartaaz Winter</option>
                            <option value="Sanitor">Sanitor</option>
                            <option value="Mariyo">Mariyo</option>
                            <option value="Jeeva Textile">Jeeva Textile</option>
                            <option value="HB Tex">HB Tex</option>
                                </select>
                            </div>

                </div>
                <div class="row">
                    <div class="product-list">
                        <div id="product-box" class="row"></div>
                    </div>
                    <div class="select-button">
                        <button id="load-more-button" class="primary-btn view-card">Loading More</button>
                    </div>

                </div>

            </div>
        </section> -->
        <!-- Product Shop Section End -->



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