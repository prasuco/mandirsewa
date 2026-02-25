<?php
session_start();
include_once __DIR__ . "/../utils/utils.php";
redirect_if_not_authenticated();
redirect_if_not_admin();

require_once __DIR__ . "/../config/db.php";

$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($id && $action) {
    $adminId = $_SESSION['id'];
    
    if ($action === 'verify') {
        $sql = "UPDATE mandirs SET is_verified = 1 WHERE id = $id";
        mysqli_query($conn, $sql);
        
        $kycSql = "UPDATE kyc_verifications SET status = 'verified', verified_at = NOW(), verified_by = $adminId WHERE mandir_id = $id";
        mysqli_query($conn, $kycSql);
        
        $_SESSION['message'] = "Mandir verified successfully";
    } elseif ($action === 'unverify') {
        $sql = "UPDATE mandirs SET is_verified = 0 WHERE id = $id";
        mysqli_query($conn, $sql);
        $_SESSION['message'] = "Mandir unverified successfully";
    } elseif ($action === 'reject_kyc') {
        $kycSql = "UPDATE kyc_verifications SET status = 'rejected', verified_at = NOW(), verified_by = $adminId WHERE mandir_id = $id";
        mysqli_query($conn, $kycSql);
        $_SESSION['message'] = "KYC rejected";
    }
}

header("Location: /mandirsewa/admin/mandirs.php");
