<?php
require "db_connection_manager.php";
session_start();
$userId = $_SESSION['login']['id'];
$cartQuantity = 0;
$totalPrice = 0;
if(isset($userId)) {
    $query = "select * from cart where user_id=$userId";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $cartQuantity = $stmt->num_rows;
    $stmt->close();
    if($cartQuantity > 0) {
        $query = "select sum(products.price * cart.quantity) as total_price from cart inner join products on cart.product_id = products.id where cart.user_id=$userId";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_row();
        $totalPrice = $result[0];
        $totalPrice = number_format($totalPrice, 0);
        echo json_encode(['quantity' => $cartQuantity, 'total-price' => $totalPrice]);
        $stmt->close();
    }
} else {
    echo json_encode(false);
}
exit();


