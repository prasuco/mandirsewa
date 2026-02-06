<?php
session_start();
require_once '../config/db.php'; // must define $conn

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
    exit;
}

$amount_paid = $_POST['amount_paid'] ?? '';
$mandir_id   = $_POST['mandir_id'] ?? '';
$campaign_id = $_POST['campaign_id'] ?? '';

if ($amount_paid === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Amount required'
    ]);
    exit;
}

// basic escaping (since no prepared statements)
$amount_paid = mysqli_real_escape_string($conn, $amount_paid);
$mandir_id   = mysqli_real_escape_string($conn, $mandir_id);
$campaign_id = mysqli_real_escape_string($conn, $campaign_id);

$transaction_uuid = time() . '-' . $amount_paid;

if (empty($mandir_id)) {

    $sql = "
        INSERT INTO donations
        (transaction_uuid, amount_paid, payment_method, status, campaign_id)
        VALUES
        ('$transaction_uuid', '$amount_paid', 'esewa', 'INIT', '$campaign_id')
    ";
} else {

    $sql = "
        INSERT INTO donations
        (transaction_uuid, amount_paid, payment_method, status, mandir_id)
        VALUES
        ('$transaction_uuid', '$amount_paid', 'esewa', 'INIT', '$mandir_id')
    ";
}

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'success' => true,
        'transaction_uuid' => $transaction_uuid,
        'donation_id' => mysqli_insert_id($conn)
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database error',
        'error' => mysqli_error($conn)
    ]);
}

mysqli_close($conn);
