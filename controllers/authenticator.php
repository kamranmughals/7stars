<?php
require_once "db_connection_manager.php";
session_start();
if (isset($_SESSION['email'])) {
    header('location: ../index.php');
    exit();
}



if (isset($_POST['register-btn'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
        $query = "INSERT INTO users set name=?, email=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $name, $email, $password);
        $result = $stmt->execute();
        $id = $stmt->insert_id;

        if ($result) {
            $stmt->close();
            $_SESSION['login'] = ['id' => $id, 'email' => $email, 'name' => $name];
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

} else if(isset($_POST['login-btn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT id, email, password, name FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $validation = true;
    if($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        if(!password_verify($password, $data['password'])) {
            $validation = false;
        } else {
            $_SESSION['login'] = ['id' => $data['id'], 'email' => $email, 'name' => $data['name']];
            $validation = true;
        }
    } else {
        $validation = false;
    }
    echo json_encode($validation);

}

else {
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}

exit();


