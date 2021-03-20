<?php
require_once "db_connection_manager.php";



if(isset($_POST['product-add'])) {
    addProduct($conn);
}



function addProduct(mysqli $conn) {
    $image = $_FILES['file']['tmp_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $oldPrice = $_POST['old-price'];
    $notes = $_POST['notes'];
    $category = $_POST['category'];
    $gender = $_POST['gender'];
    
    $query = "INSERT INTO products SET image=?, description=?, price=?, oldPrice=?, notes=?, category=?, gender=?";
    $stmt = $conn->prepare($query);
    $image_id = $stmt->insert_id;
    $image_url = "../assets/".$image_id.$_FILES['file']['name'];
    
    $stmt->bind_param("ssddsss", $image_id, $description, $price, $oldPrice, $notes, $category, $gender);
    
    $stmt->execute();
    $image_id = $stmt->insert_id;
    $image_url = "../assets/".$image_id.".jpg";
    $stmt->close();
    
    //update image's route in BBDD
    $query = "UPDATE products SET image=? where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $image_url, $image_id);
    $stmt->execute();
    $stmt->close();
    move_uploaded_file($image, $image_url);
    
    header("location: ../admin.php?admin_code=3CvbmpGg4y9kkHdGVYKSL2bNqQpeEH");
    exit();
    
}



function loadFromDB(mysqli $conn, $table) {
    $query = "select * from $table";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        echo "<tr>";
        foreach ($row as $key=>$data) {
            if($table === "users" && $key === 3) {
                continue;
            }
            if($key === 7 && $table === "products") {

                    echo "<td><select>";
                    if($data) {
                        echo "<option value='0'>hidden</option>";
                        echo "<option selected value='1'>show</option>";
                    } else {
                        echo "<option selected value='0'>hidden</option>";
                        echo "<option value='1'>show</option>";
                    }

                    echo "</select></td>";

            } else {
                echo "<td>$data</td>";
            }

        }
        if($table === "products") {
            echo "<td><button id='confirm-btn'>Confirm</button></td></tr>";
        }

    }

}
