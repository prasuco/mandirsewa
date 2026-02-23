<?php
session_start();
require_once "../config/db.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $current_mandir = $_SESSION['current_mandir'] ?? null;

    $sql = "SELECT * FROM images WHERE id = $id AND mandir_id = $current_mandir LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $image = mysqli_fetch_assoc($result);
        $file_path = __DIR__ . '/../' . $image['url'];

        $sql = "DELETE FROM images WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $_SESSION['message'] = "Image deleted successfully";
        } else {
            $_SESSION['message'] = "Failed to delete image";
        }
    } else {
        $_SESSION['message'] = "Image not found";
    }
}

header("Location: /mandirsewa/dashboard/gallery.php");
