<?php
require_once "../config/db.php";


$mandir_id = $_GET['id'];

$sql = "SELECT * FROM mandirs WHERE id = '$mandir_id' LIMIT 1 ";

$mandir = mysqli_query($conn, $sql)->fetch_assoc();

if (!$mandir) {
    die(404);
}

$mandir_slug = $mandir['slug'];

header("Location: /mandirsewa/m?mandir=" . $mandir_slug);
