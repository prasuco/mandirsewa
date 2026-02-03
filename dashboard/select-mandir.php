<?php
session_start();

$mandirId = $_GET['id'];
$goto = $_GET['goto'];


if (!$mandirId) {
    die(404);
}

$_SESSION['current_mandir'] = $mandirId;


header("Location: $goto");
