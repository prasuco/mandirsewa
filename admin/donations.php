<?php
$title = "All Donations";
include 'header.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 30;
$offset = ($page - 1) * $limit;

$mandir_filter = $_GET['mandir_id'] ?? '';

$mandirsSql = "SELECT id, name FROM mandirs ORDER BY name";
$allMandirs = mysqli_query($conn, $mandirsSql)->fetch_all(MYSQLI_ASSOC);

$whereClause = "WHERE d.status = 'COMPLETED'";
if ($mandir_filter) {
    $whereClause .= " AND d.mandir_id = '$mandir_filter'";
}

$countSql = "SELECT COUNT(*) as total FROM donations d $whereClause";
$totalResult = mysqli_query($conn, $countSql);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalDonations = $totalRow['total'] ?? 0;
$totalPages = ceil($totalDonations / $limit);

$sql = "SELECT d.*, m.name as mandir_name, m.is_verified, m.id as mandir_id, c.name as campaign_name 
        FROM donations d 
        LEFT JOIN mandirs m ON d.mandir_id = m.id
        LEFT JOIN campaigns c ON d.campaign_id = c.id
        $whereClause
        ORDER BY d.id DESC 
        LIMIT $limit OFFSET $offset";

$donations = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$totalAmountSql = "SELECT SUM(amount_paid) as total FROM donations d $whereClause";
$totalAmountResult = mysqli_query($conn, $totalAmountSql);
$totalAmountRow = mysqli_fetch_assoc($totalAmountResult);
$totalAmount = $totalAmountRow['total'] ?? 0;
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">All Donations</h1>
        
        <form method="GET" class="flex gap-2 items-center">
            <select name="mandir_id" class="px-3 py-1.5 rounded-lg text-sm border border-gray-300" onchange="this.form.submit()">
                <option value="">All Mandirs</option>
                <?php foreach ($allMandirs as $m): ?>
                    <option value="<?= $m['id'] ?>" <?= $mandir_filter == $m['id'] ? 'selected' : '' ?>><?= $m['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Donations</p>
            <p class="text-2xl font-bold text-gray-900"><?= number_format($totalDonations) ?></p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Amount</p>
            <p class="text-2xl font-bold text-green-600">Rs. <?= number_format($totalAmount) ?></p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Verified Mandirs</p>
            <?php
            $verifiedSql = "SELECT COUNT(DISTINCT mandir_id) as total FROM donations d JOIN mandirs m ON d.mandir_id = m.id WHERE d.status='COMPLETED' AND m.is_verified = 1";
            $verifiedResult = mysqli_query($conn, $verifiedSql);
            $verifiedRow = mysqli_fetch_assoc($verifiedResult);
            ?>
            <p class="text-2xl font-bold text-blue-600"><?= $verifiedRow['total'] ?? 0 ?></p>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Mandir</th>
                    <th class="px-4 py-3">Campaign</th>
                    <th class="px-4 py-3">Donor</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (count($donations) > 0): ?>
                    <?php foreach ($donations as $donation): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">#<?= $donation['id'] ?></td>
                            <td class="px-4 py-3">
                                <?php if ($donation['mandir_name']): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="<?= $donation['is_verified'] ? 'text-gray-900' : 'text-red-600' ?>">
                                            <?= $donation['mandir_name'] ?>
                                        </span>
                                        <?php if (!$donation['is_verified']): ?>
                                            <span class="text-xs bg-red-100 text-red-700 px-1.5 py-0.5 rounded">Unverified</span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <?= $donation['campaign_name'] ?? 'General' ?>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm"><?= $donation['name'] ?? 'Anonymous' ?></p>
                                <p class="text-xs text-gray-500"><?= $donation['email'] ?? '' ?></p>
                            </td>
                            <td class="px-4 py-3 font-semibold text-green-600">
                                Rs. <?= number_format($donation['amount_paid']) ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <?= $donation['status'] ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <?= date('M d, Y H:i', strtotime($donation['created_at'])) ?>
                            </td>
                            <td class="px-4 py-3">
                                <a href="/mandirsewa/generateReceipt.php?id=<?= $donation['id'] ?>" target="_blank" class="text-blue-600 hover:underline text-sm">
                                    Receipt
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                            No donations yet
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <?php $filterParam = $mandir_filter ? "&mandir_id=$mandir_filter" : ''; ?>
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Showing <?= ($offset + 1) ?> to <?= min($offset + $limit, $totalDonations) ?> of <?= $totalDonations ?>
            </p>
            <div class="flex gap-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?><?= $filterParam ?>" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">Previous</a>
                <?php endif; ?>
                
                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                    <a href="?page=<?= $i ?><?= $filterParam ?>" class="px-3 py-1.5 border <?= $i == $page ? 'bg-primary text-white border-primary' : 'border-gray-300 hover:bg-gray-50' ?> rounded-lg text-sm">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?><?= $filterParam ?>" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">Next</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
