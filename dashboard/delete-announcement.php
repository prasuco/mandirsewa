<?php
session_start();
require_once "../config/db.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $current_mandir = $_SESSION['current_mandir'] ?? null;

    $sql = "SELECT * FROM announcements WHERE id = $id AND created_by_mandir = $current_mandir LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $announcement = mysqli_fetch_assoc($result);
        
        if ($announcement['image']) {
            $file_path = __DIR__ . '/../' . $announcement['image'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $sql = "DELETE FROM announcements WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Announcement deleted successfully";
        } else {
            $_SESSION['message'] = "Failed to delete announcement";
        }
    } else {
        $_SESSION['message'] = "Announcement not found";
    }
}

header("Location: /mandirsewa/dashboard/announcements.php");
