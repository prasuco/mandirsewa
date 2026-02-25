<?php
$title = "Admin Dashboard";
include 'header.php';

$sql = "SELECT COUNT(*) as total FROM mandirs";
$totalMandirs = mysqli_query($conn, $sql)->fetch_assoc();

$sql = "SELECT COUNT(*) as total FROM mandirs WHERE is_verified = 1";
$verifiedMandirs = mysqli_query($conn, $sql)->fetch_assoc();

$sql = "SELECT COUNT(*) as total FROM mandirs WHERE is_verified = 0";
$pendingMandirs = mysqli_query($conn, $sql)->fetch_assoc();

$sql = "SELECT COUNT(*) as total FROM donations WHERE status = 'COMPLETED'";
$totalDonations = mysqli_query($conn, $sql)->fetch_assoc();

$sql = "SELECT SUM(amount_paid) as total FROM donations WHERE status = 'COMPLETED'";
$totalAmount = mysqli_query($conn, $sql)->fetch_assoc();

$sql = "SELECT COUNT(*) as total FROM kyc_verifications WHERE status = 'pending'";
$pendingKYC = mysqli_query($conn, $sql)->fetch_assoc();
?>

<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-temple text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Mandirs</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $totalMandirs['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Verified</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $verifiedMandirs['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending Verification</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $pendingMandirs['total'] ?? 0 ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-donate text-rose-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Donations</p>
                    <p class="text-2xl font-bold text-gray-900">Rs. <?= number_format($totalAmount['total'] ?? 0) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="mandirs.php?filter=pending" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">Pending Verifications</h3>
                    <p class="text-sm text-gray-500"><?= $pendingMandirs['total'] ?? 0 ?> mandirs waiting for approval</p>
                </div>
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-arrow-right text-amber-600"></i>
                </div>
            </div>
        </a>

        <a href="donations.php" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">View All Donations</h3>
                    <p class="text-sm text-gray-500"><?= $totalDonations['total'] ?? 0 ?> total donations</p>
                </div>
                <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-arrow-right text-rose-600"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>
