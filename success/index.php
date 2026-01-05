<?php
session_start();
require_once '../config/db.php'; // must define $conn




$data = $_GET['data'];

$decoded_string = base64_decode($data);
$json_data = json_decode($decoded_string, true);

$transaction_uuid = $json_data['transaction_uuid'];



$sql = "select * from donations where `transaction_uuid` ='$transaction_uuid' limit 1 ";
$donation = mysqli_query($conn, $sql)->fetch_all(1);
if ($donation) {

    $sql = "UPDATE `donations` set `status` = 'COMPLETED', `payment_metadata` ='$decoded_string', `payment_method`='esewa'  WHERE `transaction_uuid` = '$transaction_uuid'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Payment Success";
        header("Location: /mandirsewa/");
    } else {
        $_SESSION['message'] = "Payment Failed";
        header("Location: /mandirsewa/");
    }
}
