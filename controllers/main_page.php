<?php
require "db_connection_manager.php";
$query = "";
$gender = $_POST['gender'] ?? false;
$category = $_POST['category'] ?? false;
$counter = $_POST['counter'];
$limit = "limit $counter,9";

if(!$gender && !$category) {
    $query = "select * from products where visible=true $limit ";
    $stmt = $conn->prepare($query);
} else if (!$category) {
    $query = "select * from products where gender=? and visible=true $limit ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $gender);
} else if(!$gender) {
    $query = "select * from products where category=? and visible=true $limit ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $category);
} else {
    $query = "select * from products where gender=? and category=? and visible=true $limit ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $gender, $category);
}


$stmt->execute();
$rows = array();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $rows [] = $row;
}
$stmt->close();
echo json_encode($rows);