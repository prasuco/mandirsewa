<?php
session_start();
require_once "../config/db.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM faqs WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "FAQ Deleted Successfully";
    } else {
        $_SESSION['message'] = "FAQ Could Not Be Deleted";
    }
}

header("Location: /mandirsewa/dashboard/faqs.php");
