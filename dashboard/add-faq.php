<?php
session_start();
require_once "../config/db.php";
$uid = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] = "POST") {

    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $created_by_mandir = $_POST['created_by_mandir'];


    $sql = "INSERT INTO `faqs`(`question`, `answer`,`created_by_mandir`) 
    VALUES ('$question', '$answer','$created_by_mandir')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "FAQ Created Successfully";
        header("Location: /mandirsewa/dashboard/faqs.php");
    } else {
        $_SESSION['message'] = "FAQ Couldnot be created";
    }
}
