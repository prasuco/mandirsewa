<?php
session_start();

$mandirId = $_GET['id'];
// fallback; if no goto is provided
if (isset($_GET['goto'])) {
    $goto = $_GET['goto'];
} else {
    $goto = "/mandirsewa/dashboard";
}


if (!$mandirId) {
    die(404);
}

$_SESSION['current_mandir'] = $mandirId;


header("Location: $goto");
