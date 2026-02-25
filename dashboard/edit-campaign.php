<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $target_amount = $_POST['target_amount'];
    $type = $_POST['type'];

    $sql = "UPDATE campaigns SET 
            name = '$name',
            description = '$description',
            content = '$content',
            target_amount = '$target_amount',
            type = '$type'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Campaign Updated Successfully";
        header("Location: /mandirsewa/dashboard/campaigns.php");
    } else {
        $_SESSION['message'] = "Campaign Could Not Be Updated";
        header("Location: /mandirsewa/dashboard/campaigns.php");
    }
} else {
    header("Location: /mandirsewa/dashboard/campaigns.php");
}
