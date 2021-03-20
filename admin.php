<?php require "controllers/admin_control.php";
if(!isset($_GET['admin_code']) || $_GET['admin_code'] !== "3CvbmpGg4y9kkHdGVYKSL2bNqQpeEH")

{
    
    header('location: index.php');
    exit();
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminPage.css" type="text/css">
    <style>

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(https://smallenvelop.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <button type="button" class="btn btn-primary" style="margin-top: 20px;" onclick="myOrderFunction()">Orders</button>
        <button type="button" class="btn btn-success" style="margin-top: 20px;" onclick="myProductFunction()">Products</button>
        <button type="button" class="btn btn-info" style="margin-top: 20px;" onclick="myUserFunction()">Users</button>
    </div>
    <div id="Orders">
     <h3> All Orders </h3>

     <table>
        <tr>
            <th>Order id</th>
            <th>Client details</th>
            <th>Order Details</th>
            <th>Total price</th>
            <th>Order date and time</th>
            <th>Order status</th>
            <th>Confirm changes</th>

        </tr>
        <?php
        $query = "select * from orders inner join junction_orders_products on id=order_id 
            inner join products on product_id=products.id order by date_time";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_orders = [];
        if($result) {
            while($row = $result->fetch_assoc()) {
                if(!isset($user_orders[$row['order_id']])) {
                    $user_orders [$row['order_id']] = array_slice($row, 1, 12);
                }

                $user_orders[$row['order_id']]['products'] [$row['product_id']] = array_slice($row, 13, sizeof($row));
            }
        }

        foreach ($user_orders as $order) {
            $clientDetails = '<strong>Client ID: </strong>' . $order['user_id'].
                                '<br><strong>Client Name: </strong>' . $order['first_name'] ." ". $order['last_name'].
                                '<br><strong>Email: </strong>' . $order['email'].
                                '<br><strong>Address: </strong>' . $order['address'].
                                '<br><strong>City: </strong>' . $order['city'].
                                '<br><strong>Phone: </strong>' . $order['phone'].
                                '<br><strong>Zip: </strong>' . $order['zip'];
           $orderDetails="";
           foreach ($order['products'] as $product){
               $orderDetails .= '<h5><strong>Product Id: </strong>' . $product['product_id'] . '</h5>'.
                   '<ul>'.
                   '<li><strong>Description: </strong>' . $product['description']. '</li>'.
                   '<li><strong>Category / Gender: </strong>' . $product['category']. " / " .$product['gender'] . '</li>'.
                   '<li><strong>Quantity: </strong>' . $product['quantity']. '</li>'.
                   '<li><strong>Price: </strong>' . $product['price']. '</li>'.
                   '<li><strong>Total Price: </strong>' . $product['price'] * $product['quantity']. '</li>'.
                   '</ul>';


           }

            echo "<tr>";
            echo "<td>" .$order['order_id']. "</td>";
            echo "<td> " .$clientDetails. "</td>";
            echo "<td>" .$orderDetails. "</td>";
            echo "<td>" .number_format($order['total_price'], 0). " Rs.</td>";
            echo "<td>" .$order['date_time']. "</td>";
            $placed = $confirmed = $shipped = $delivered = "";
            if($order['status'] === "placed") {
                $placed = "selected";
            } else if($order['status'] === "confirmed") {
                $confirmed = "selected";
            } else if($order['status'] === "shipped") {
                $shipped = "selected";
            } else if($order['status'] === "delivered") {
                $delivered = "selected";
            }


            echo "<td><select name='' id='status-selector'><option $placed value='placed'>Placed</option><option $confirmed value='confirmed'>Confirm</option><option $shipped value='shipped'>Shipped</option><option $delivered value='delivered'>Delivered</option></select></td>";
            echo "<td><button id='confirm-status-btn'>Confirm changes</button></td>";
            echo "</tr>";
        }

        ?>
    </table>
    </div>

    <div id="Products">
        <!--product section-->
        <h3>All Products</h3>

        <button id="AddProduct" type="button" class="btn btn-info"
            style="margin-top: 20px; margin-bottom:20px ; margin-left: 1000px ;">Add Product</button>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">

                <span class="close">&times;</span>
                <h4>Add New Product</h4>

                <div style="width: 100px;">
                    <div class="fotodiv"
                        style="width: 100px; height: 100px; background-color: lightblue;margin-bottom: 20px;">
                        Uploaded Image Preview
                    </div>
                    <form action="controllers/admin_control.php" method="post" enctype="multipart/form-data">
                        File: <input type="file" name="file" required>
                        Description: <input type="text" name="description" required>
                        Price: <input type="number" min="0"  name="price" required>
                        OldPrice: <input type="number" min="0"  name="old-price" required>

                        Notes: <input type="text" name="notes" required>
                        Category: <select name="category" required>
                            <option selected value="Shameer-a-Khadar">Shameer-a-Khadar</option>
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
                        </select>
                        Gender: <select name="gender" required>
                            <option selected value="women">women</option>
                            <option value="men">men</option>
                        </select>
                        <button type="submit" name="product-add">Add product</button>
                    </form>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Notes</th>
                <th>Category</th>
                <th>Gender</th>
                <th>Visible</th>
                <th>Action</th>
            </tr>
            <?php loadFromDB($conn, "products");   ?>
        </table>

    </div>
    <!--product section end here -->


    <div id="Users">    <!--User Section -->
       
        <h3>All Users</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php loadFromDB($conn, "users");  ?>
        </table>
    </div>    <!--User Section End here --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/adminPageFunctions.js"></script>
    <script>
    let confirmBtns = document.querySelectorAll('#confirm-btn');
    let confirmStatusBtn = document.querySelectorAll('#confirm-status-btn');

    confirmStatusBtn.forEach(item => {
        item.addEventListener('click', statusChangeConfirm);
    })

    confirmBtns.forEach(item => {
        item.addEventListener('click', confirmVisibility);
    })

    function confirmVisibility() {

        let rowId = this.parentElement.parentElement.children[0].innerHTML;
        let selector = this.parentElement.parentElement.children[7].firstChild;
        let rowValue = selector.options[selector.selectedIndex].value;
        let formData = new FormData();
        formData.append('confirm-btn', rowId);
        formData.append('visible', rowValue);
        let loadingDiv = document.createElement('div');
        loadingDiv.className = "se-pre-con";
        document.body.append(loadingDiv);
        fetch("controllers/status_controller.php", {
                method: 'post',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if(data) {
                        alert("Product has been updated");
                        setTimeout(() => {document.body.removeChild(loadingDiv);}, 1000)

                    } else {
                        alert("Error while updating!");
                    }
                }).catch(err => console.log(err));

    }

    function statusChangeConfirm() {
        console.log("changed");
        let rowId = this.parentElement.parentElement.children[0].innerHTML;
        let selector = this.parentElement.parentElement.children[5].firstChild;
        let rowValue = selector.options[selector.selectedIndex].value;
        let formData = new FormData();
        formData.append('status-change-btn', rowId);
        formData.append('status-value', rowValue);
        let loadingDiv = document.createElement('div');
        loadingDiv.className = "se-pre-con";
        document.body.append(loadingDiv);
        fetch("controllers/status_controller.php", {
            method: 'post',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if(data) {
                    alert("Order has been updated");
                    setTimeout(() => {document.body.removeChild(loadingDiv);}, 1000)

                } else {
                    alert("Error while updating!");
                }
            }).catch(err => console.log(err));

    }






    </script>
</body>

</html>