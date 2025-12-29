<?php
session_start();
require_once "../config/db.php";
$uid = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] = "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $target_amount = $_POST['target_amount'];
    $type = $_POST['type'];
    $created_by_mandir = $_POST['created_by_mandir'];

    $sql = "INSERT INTO `campaigns`(`name`, `description`, `content`, `target_amount`, `type`, `created_by_mandir`) 
    VALUES ('$name','$description','$content','$target_amount','$type','$created_by_mandir')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Campaign Created Successfully";
        header("Location: /mandirsewa/dashboard/campaigns.php");
    } else {
        $_SESSION['message'] = "Campaign Couldnot be created";
    }
}
