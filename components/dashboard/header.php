<?php
session_start();
include_once __DIR__ . "/../../utils/utils.php";
redirect_if_not_authenticated();

require_once __DIR__ . "/../../config/db.php";

$request_url = $_SERVER['REQUEST_URI'];

$uid = $_SESSION['id'];
$sql = "select * from mandirs where `created_by` = $uid ";

$mandirs;
try {
    $mandirs = mysqli_query($conn, $sql);
    $mandirs = mysqli_fetch_all($mandirs, MYSQLI_ASSOC);
} catch (\Throwable $th) {
    // $mandirs = NULL;
    $_SESSION['message'] = "Failed Mysql Query, '$sql ";
}




$current_mandir =   $_SESSION['current_mandir'] ?? NULL;

// 





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title; ?> | Dashboard
    </title>
    <link rel="stylesheet" href="/mandirsewa/public/css/app.css?<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />
</head>

<body class="bg-gray-50 text-gray-800 ">


    <!-- TOP BAR -->
    <header class="sticky top-0 z-40 bg-white border-b border-gray-200">
        <div class="h-14 px-4 sm:px-6 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <button id="sidebarToggle" class="text-gray-600 hover:text-gray-900">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <span class="font-medium text-sm">Mandir Sewa</span>
            </div>

            <div class="relative">
                <button id="userMenuButton">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="fa-solid fa-user text-xs text-gray-600"></i>
                    </div>
                </button>

                <div id="userMenu"
                    class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-sm text-sm">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-50">Profile</a>
                    <a href="/mandirsewa/logout.php" class="block px-4 py-2 hover:bg-gray-50">Logout</a>
                </div>
            </div>

        </div>
    </header>

    <!-- LAYOUT -->

    <div class="relative sm:flex min-h-[calc(100vh-3.5rem)]">

        <!-- Overlay (mobile only) -->
        <div id="sidebarOverlay"
            class="fixed inset-0 bg-black/30 z-10 hidden sm:hidden">
        </div>

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="fixed sm:sticky top-14 left-0 z-50
         w-64 h-screen bg-white border-r border-gray-200
         px-4 py-6
         transform -translate-x-full sm:translate-x-0
         transition-transform duration-200
         sm:shrink-0
         sm:h-[calc(100vh-3.5rem)] overflow-y-auto">

            <!-- Mandir Switcher -->
            <div class="mb-6">
                <label class="text-xs text-gray-500 block mb-1">Current Mandir</label>


                <select id="mandirSelector"
                    class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-rose-400">
                    <option value="">Select A Mandir</option>
                    <?php foreach ($mandirs as $mandir) { ?>
                        <option
                            <?= ($mandir['id'] == $current_mandir) ? 'selected' : '' ?>
                            value="<?= $mandir['id'] ?>"><?= $mandir['name'] ?> </option>
                    <?php } ?>
                </select>

                <script>
                    $('#mandirSelector').change((value) => {
                        const mandirId = value.target.value

                        if (mandirId) {
                            window.location.href = `/mandirsewa/dashboard/select-mandir.php?id=${mandirId}`;
                        }

                    })
                </script>


            </div>

            <!-- Navigation -->
            <nav class="space-y-1 text-sm">
                <a href="#" class="block px-3 py-2 rounded-md bg-gray-100 font-medium">Home</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-100">Campaigns</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-100">Donations</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-100">FAQs</a>
            </nav>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1   break-all  px-4 sm:px-8 py-6">
            <div class=" mx-auto">
                <!-- <h1 class="text-lg font-semibold mb-4">
                    <?= $title ?? 'Dashboard' ?>
                </h1> -->
                <div class="bg-white border border-gray-200 rounded-md p-6 min-h-100">