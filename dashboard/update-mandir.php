<?php
session_start();

require_once "../config/db.php";

$uid = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    // Mandir ID (required)
    $mandir_id = (int) $_POST['mandir_id'];

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $about_content = mysqli_real_escape_string($conn, $_POST['about_content']);
    $address_lat = mysqli_real_escape_string($conn, $_POST['address_lat']);
    $address_long = mysqli_real_escape_string($conn, $_POST['address_long']);
    $primary_contact = mysqli_real_escape_string($conn, $_POST['primary_contact']);
    $secondary_contact = mysqli_real_escape_string($conn, $_POST['secondary_contact']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $youtube = mysqli_real_escape_string($conn, $_POST['youtube']);

    // Upload directory
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Get existing logo
    $existingLogo = null;
    $result = mysqli_query(
        $conn,
        "SELECT logo FROM mandirs WHERE id = $mandir_id AND created_by = $uid"
    );

    if ($result && mysqli_num_rows($result) === 1) {
        $existingLogo = mysqli_fetch_assoc($result)['logo'];
    } else {
        $_SESSION['message'] = "Mandir not found or unauthorized access";
        header("Location: /mandirsewa/dashboard/");
        exit;
    }

    // Handle logo upload (optional)
    $logo = $existingLogo;

    if (!empty($_FILES['logo']['name'])) {
        $logo_name = time() . '_' . basename($_FILES['logo']['name']);
        $logo_path = $uploadDir . $logo_name;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path)) {

            // Delete old logo if exists
            if ($existingLogo && file_exists(__DIR__ . '/../' . $existingLogo)) {
                unlink(__DIR__ . '/../' . $existingLogo);
            }

            $logo = 'uploads/' . $logo_name;
        }
    }

    // Update query
    $sql = "
        UPDATE mandirs SET
            name = '$name',
            slug = '$slug',
            description = '$description',
            about_content = '$about_content',
            address_lat = '$address_lat',
            address_long = '$address_long',
            primary_contact = '$primary_contact',
            secondary_contact = '$secondary_contact',
            website = '$website',
            facebook = '$facebook',
            youtube = '$youtube',
            logo = " . ($logo ? "'$logo'" : "NULL") . "
        WHERE id = $mandir_id AND created_by = $uid
    ";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Mandir updated successfully";
        header("Location: /mandirsewa/dashboard/profile.php");
        exit;
    } else {
        $_SESSION['message'] = "Failed updating mandir";
    }
}
