<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $image_name = $_POST['image_name'];

    $sql = "UPDATE images SET image_name = '$image_name' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Image Updated Successfully";
        header("Location: /mandirsewa/dashboard/gallery.php");
    } else {
        $_SESSION['message'] = "Image Could Not Be Updated";
        header("Location: /mandirsewa/dashboard/gallery.php");
    }
} else {
    header("Location: /mandirsewa/dashboard/gallery.php");
}
