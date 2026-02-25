<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "UPDATE announcements SET 
            title = '$title',
            description = '$description',
            start_date = '$start_date',
            end_date = '$end_date'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Announcement Updated Successfully";
        header("Location: /mandirsewa/dashboard/announcements.php");
    } else {
        $_SESSION['message'] = "Announcement Could Not Be Updated";
        header("Location: /mandirsewa/dashboard/announcements.php");
    }
} else {
    header("Location: /mandirsewa/dashboard/announcements.php");
}
