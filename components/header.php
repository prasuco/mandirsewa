<?php
session_start();
require_once __DIR__ . "/../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title; ?> | MandirSewa
    </title>
    <link rel="stylesheet" href="/mandirsewa/public/css/app.css?<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <div class="bg-linear-to-b from-orange-50 to-white">
        <div class="max-w-7xl sticky  top-4 mx-auto mb-2 px-4">
            <div class="h-16 bg-white shadow rounded-2xl  px-6 flex items-center justify-between">

                <div class="flex items-center gap-4">
                    <img
                        src="/mandirsewa/public/images/logo.webp"
                        class="w-14 h-14 rounded-xl"
                        alt="Mandir Logo" />
                    <!-- <span class="font-semibold text-base">Mandir Sewa</span> -->
                </div>

                <a
                    href="/mandirsewa/register.php"
                    class="text-sm px-4 py-2 rounded-lg bg-primary text-white shadow-sm">
                    Get started
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>