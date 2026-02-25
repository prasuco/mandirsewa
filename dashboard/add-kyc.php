<?php
session_start();
require_once "../config/db.php";
include_once __DIR__ . "/../utils/utils.php";
redirect_if_not_authenticated();

$uid = $_SESSION['id'];

$sql = "SELECT id FROM mandirs WHERE created_by = $uid";
$mandirsResult = mysqli_query($conn, $sql);
$mandirs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$current_mandir = $_SESSION['current_mandir'] ?? null;

if (!$current_mandir) {
    $_SESSION['message'] = "Please select a mandir first";
    header("Location: /mandirsewa/dashboard");
    exit;
}

$kycSql = "SELECT * FROM kyc_verifications WHERE mandir_id = '$current_mandir' LIMIT 1";
$kyc = mysqli_query($conn, $kycSql)->fetch_assoc();

if ($kyc && $kyc['status'] !== 'rejected') {
    $_SESSION['message'] = "KYC already submitted for this mandir";
    header("Location: /mandirsewa/dashboard/profile.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_kyc'])) {
    $document_type = $_POST['document_type'];
    
    if (isset($_FILES['document']) && $_FILES['document']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/kyc/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['document']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['document']['tmp_name'], $targetPath)) {
            $docUrl = 'uploads/kyc/' . $fileName;
            
            if ($kyc && $kyc['status'] === 'rejected') {
                $kycUpdate = "UPDATE kyc_verifications SET document_url = '$docUrl', document_type = '$document_type', status = 'pending', submitted_at = NOW() WHERE mandir_id = '$current_mandir'";
                mysqli_query($conn, $kycUpdate);
            } else {
                $kycInsert = "INSERT INTO kyc_verifications (mandir_id, document_url, document_type, status, submitted_at) 
                              VALUES ('$current_mandir', '$docUrl', '$document_type', 'pending', NOW())";
                mysqli_query($conn, $kycInsert);
            }
            
            $_SESSION['message'] = "KYC documents submitted successfully";
            header("Location: /mandirsewa/dashboard/profile.php");
            exit;
        }
    }
}

header("Location: /mandirsewa/dashboard/profile.php");
