<?php
require_once "db_connection_manager.php";

if(isset($_POST['status-change-btn'])) {
    $rowId = $_POST['status-change-btn'];
    $rowValue = $_POST['status-value'];
    $query = "update orders set status='$rowValue' where id=$rowId";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    echo $result;
    exit();
}

if(isset($_POST['confirm-btn'])) {
    $rowId = $_POST['confirm-btn'];
    $rowValue = $_POST['visible'];
    $query = "update products set visible=$rowValue where id=$rowId";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    $stmt->close();
    echo $result;
    exit();
}


