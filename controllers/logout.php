<?php
session_start();
session_destroy();
unset($_POST);
unset($_GET);
unset($_SESSION);
header('location: ../index.php');
exit();