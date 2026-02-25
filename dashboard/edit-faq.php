<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $sql = "UPDATE faqs SET 
            question = '$question',
            answer = '$answer'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "FAQ Updated Successfully";
        header("Location: /mandirsewa/dashboard/faqs.php");
    } else {
        $_SESSION['message'] = "FAQ Could Not Be Updated";
        header("Location: /mandirsewa/dashboard/faqs.php");
    }
} else {
    header("Location: /mandirsewa/dashboard/faqs.php");
}
