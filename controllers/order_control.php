<?php
require "db_connection_manager.php";
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['order'])) {
    header('location: ../login.php');
    exit();
}
$userId = $_SESSION['login']['id'];
$order = $_SESSION['order']['order'];
$totalPrice = $_SESSION['order']['total-price'];
unset($_SESSION['order']);
if(isset($_POST['order-btn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $conn;
    $query = "insert into orders set user_id=?, first_name=?, last_name=?, email=?, address=?, zip=?, city=?, phone=?, total_price=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssssssd", $userId, $firstName, $lastName, $email, $address, $zip, $city, $phone, $totalPrice);
    $result = $stmt->execute();
    if($result) {
        $orderId = $stmt->insert_id;
        $query = "";
        foreach ($order as $ord) {
            $id = mysqli_real_escape_string($conn, $ord['id']);
            $quantity = mysqli_real_escape_string($conn, $ord['quantity']);
            $query .= "insert into junction_orders_products (order_id, product_id, quantity) values ($orderId, $id, $quantity);";
        }
        if($conn->multi_query($query)) {
            $conn->close();
            require "db_connection_manager.php";
            $query = "delete from cart where user_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userId);
            $result = $stmt->execute();
            $stmt->close();
            echo "<script>alert('Your order has been successfully submitted!');
            window.location.href = '../index.php';
                    </script>";
            header('location: ../index.php');
        } else {
            $query = "delete * from orders where id=$orderId";
            $conn->query($query);
            echo "<script>alert('There was an error while processing your order. Please try again!');
             window.location.href = '../index.php';
                    </script>";
            header('location: ../index.php');
        }
    }
    $conn->close();
    $stmt->close();
} else {
    header('location: ../index.php');
}

exit();
