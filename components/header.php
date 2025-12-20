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

    <div class="relative">
        <!-- <header class="absolute mt-2 top-2 z-50"> -->
        <div class="max-w-7xl sticky  top-0 mx-auto px-4">
            <div class="h-16 bg-white   px-6 flex items-center justify-between">

                <div class="flex items-center gap-4">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Om_symbol.svg"
                        class="w-10 h-10 rounded-xl"
                        alt="Mandir Logo" />
                    <span class="font-semibold text-base">Mandir Sewa</span>
                </div>

                <a
                    href="/mandirsewa/register.php"
                    class="text-sm px-4 py-2 rounded-lg bg-primary text-white shadow-sm">
                    Get started
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>
        <!-- </header> -->