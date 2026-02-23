<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $created_by_mandir = $_POST['created_by_mandir'];

    $uploadDir = __DIR__ . '/../uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_path = $uploadDir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = 'uploads/' . $image_name;
        }
    }

    $sql = "INSERT INTO announcements (title, description, image, start_date, end_date, created_by_mandir, created_at) 
            VALUES ('$title', '$description', '$image', '$start_date', '$end_date', '$created_by_mandir', NOW())";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Announcement created successfully";
    } else {
        $_SESSION['message'] = "Failed to create announcement";
    }

    header("Location: /mandirsewa/dashboard/announcements.php");
}
