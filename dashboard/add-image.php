<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mandir_id = $_POST['mandir_id'];
    $image_name = mysqli_real_escape_string($conn, $_POST['image_name']);

    $uploadDir = __DIR__ . '/../uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (!empty($_FILES['image']['name'])) {
        $file_name = time() . '_' . basename($_FILES['image']['name']);
        $file_path = $uploadDir . $file_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
            $url = 'uploads/' . $file_name;

            $sql = "INSERT INTO images (image_name, url, mandir_id) VALUES ('$image_name', '$url', '$mandir_id')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Image uploaded successfully";
            } else {
                $_SESSION['message'] = "Failed to save image";
            }
        } else {
            $_SESSION['message'] = "Failed to upload image";
        }
    } else {
        $_SESSION['message'] = "Please select an image";
    }

    header("Location: /mandirsewa/dashboard/gallery.php");
}
