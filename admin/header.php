<?php
session_start();
include_once __DIR__ . "/../utils/utils.php";
redirect_if_not_authenticated();
redirect_if_not_admin();

require_once __DIR__ . "/../config/db.php";

$request_url = $_SERVER['REQUEST_URI'];
$uid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> | MandirSewa Admin</title>
    <link rel="stylesheet" href="/mandirsewa/public/css/app.css?<?= time() ?>">
    <link rel="stylesheet" href="/mandirsewa/public/css/fontawesome.all.min.css" />
    <script src="/mandirsewa/public/js/jquery.min.js"></script>
    <script src="/mandirsewa/public/js/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="/mandirsewa/public/css/jquery.modal.min.css" />
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- TOP BAR -->
    <header class="sticky top-0 z-40 bg-white border-b border-gray-200">
        <div class="h-14 px-4 sm:px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="font-medium text-sm font-bold text-primary">MandirSewa Admin</span>
            </div>

            <div class="relative gap-2 flex items-center">
                <span class="text-sm text-gray-500 mr-2"><?= $_SESSION['email'] ?></span>
                <a href="/mandirsewa/logout.php" class="text-sm text-red-600 hover:underline">Logout</a>
            </div>
        </div>
    </header>

    <!-- LAYOUT -->
    <div class="sm:flex min-h-[calc(100vh-3.5rem)]">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-gray-200 px-4 py-6 sm:sticky sm:top-14 sm:h-[calc(100vh-3.5rem)] overflow-y-auto">
            <nav class="space-y-1 text-sm">
                <a href="/mandirsewa/admin" class="block px-3 py-2 rounded-md <?= get_active_class($request_url, "/mandirsewa/admin/index.php") ?> font-medium">Dashboard</a>
                <a href="/mandirsewa/admin/mandirs.php" class="block px-3 py-2 rounded-md <?= get_active_class($request_url, "/mandirsewa/admin/mandirs.php") ?>">Mandir Verifications</a>
                <a href="/mandirsewa/admin/donations.php" class="block px-3 py-2 rounded-md <?= get_active_class($request_url, "/mandirsewa/admin/donations.php") ?>">Donations</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 px-4 sm:px-8 py-6">
            <div class="mx-auto">
                <div class="bg-gray-100/70 p-6 min-h-100">
