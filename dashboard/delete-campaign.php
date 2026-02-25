<?php
session_start();
require_once "../config/db.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM campaigns WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Campaign Deleted Successfully";
    } else {
        $_SESSION['message'] = "Campaign Could Not Be Deleted";
    }
}

header("Location: /mandirsewa/dashboard/campaigns.php");
