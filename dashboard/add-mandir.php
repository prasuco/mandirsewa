<?php
session_start();

require_once "../config/db.php";

$uid = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $uploadDir = __DIR__ . '/../uploads/';

    // checking if directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $logo = null;
    if (!empty($_FILES['logo']['name'])) {
        $logo_name = time() . '_' . basename($_FILES['logo']['name']);
        $logo_path = $uploadDir . $logo_name;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path)) {
            $logo = 'uploads/' . $logo_name;
        }
    }

    $sql = "INSERT INTO mandirs
            (name, slug, description, about_content, address_lat, address_long, primary_contact, secondary_contact, website, facebook, youtube, logo, created_by)
            VALUES 
            ('$name', '$slug', '$description', '$about_content', '$address_lat', '$address_long', '$primary_contact', '$secondary_contact', '$website', '$facebook', '$youtube','$logo', '$uid')";

    if (mysqli_query($conn, $sql)) {
        // $sql = "select * from mandirs where `created_by` =  $uid ";
        // $mandirs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
        $_SESSION['message'] = "Mandir Created Successfully";
        header("Location: /mandirsewa/dashboard/");
    } else {
        $_SESSION['message'] = "Failed Creating mandir";
    }
}
