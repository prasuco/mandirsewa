<?php
session_start();

$mandirId = $_GET['id'];



if (!$mandirId) {
    die(404);
}

$_SESSION['current_mandir'] = $mandirId;


header("Location: /mandirsewa/dashboard");
