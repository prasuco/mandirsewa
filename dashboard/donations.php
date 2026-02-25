<?php
$title = "Home";
include "../components/dashboard/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

$countSql = "SELECT COUNT(*) as total FROM donations WHERE mandir_id = $current_mandir AND status='COMPLETED'";
$totalResult = mysqli_query($conn, $countSql);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalDonations = $totalRow['total'] ?? 0;
$totalPages = ceil($totalDonations / $limit);

$sql = "SELECT d.*, c.name as campaign_name 
        FROM donations d 
        LEFT JOIN campaigns c ON d.campaign_id = c.id 
        WHERE d.mandir_id = $current_mandir AND d.status='COMPLETED' 
        ORDER BY d.id DESC 
        LIMIT $limit OFFSET $offset";

$donations = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$mandirSql = "SELECT name FROM mandirs WHERE id = $current_mandir";
$mandirResult = mysqli_query($conn, $mandirSql);
$mandir = mysqli_fetch_assoc($mandirResult);

$totalAmountSql = "SELECT SUM(amount_paid) as total FROM donations WHERE mandir_id = $current_mandir AND status='COMPLETED'";
$totalAmountResult = mysqli_query($conn, $totalAmountSql);
$totalAmountRow = mysqli_fetch_assoc($totalAmountResult);
$totalAmount = $totalAmountRow['total'] ?? 0;
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<div class="flex items-center justify-between px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        Recent Donations
    </h2>
    <div class="text-sm text-gray-600">
        Total: <span class="font-semibold">Rs. <?= number_format($totalAmount) ?></span>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-4">
    <div class="grid grid-cols-3 gap-4 text-center">
        <div>
            <p class="text-sm text-gray-500">Total Donations</p>
            <p class="text-xl font-bold text-gray-800"><?= number_format($totalDonations) ?></p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Amount</p>
            <p class="text-xl font-bold text-green-600">Rs. <?= number_format($totalAmount) ?></p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Current Page</p>
            <p class="text-xl font-bold text-gray-800"><?= $page ?> of <?= $totalPages ?></p>
        </div>
    </div>
</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-clip-border">
    <table class="w-full text-left table-auto min-w-max text-slate-800">
        <thead>
            <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Id</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Donor Name</p>
                </th>

                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Campaign</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Amount</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Date</p>
                </th>
                <th class="p-4">
                    <p>Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($donations) > 0) { ?>
                <?php foreach ($donations as $donation) { ?>
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <p class="text-sm font-bold"><?= $donation['id'] ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm"><?= $donation['donor_name'] ?? 'Anonymous' ?></p>
                        </td>

                        <td class="p-4">
                            <p class="text-sm"><?= $donation['campaign_name'] ?? 'General' ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm font-semibold text-green-600">Rs. <?= number_format($donation['amount_paid']) ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm"><?= date('M d, Y H:i', ($donation['created_at'])) ?></p>
                        </td>
                        <td class="p-4">
                            <a href="/mandirsewa/generateReceipt.php?id=<?= $donation['id'] ?>" target="_blank" class="text-sm btn btn-primary font-semibold">
                                <i class="fa-solid fa-receipt"></i> Receipt
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500">
                        No donations yet
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php if ($totalPages > 1): ?>
    <div class="flex items-center justify-between px-4 py-4">
        <div class="text-sm text-gray-600">
            Showing <?= ($offset + 1) ?> to <?= min($offset + $limit, $totalDonations) ?> of <?= $totalDonations ?> donations
        </div>
        <div class="flex gap-2">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">Previous</a>
            <?php endif; ?>

            <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                <a href="?page=<?= $i ?>" class="px-3 py-1 border <?= $i == $page ? 'bg-primary text-white border-primary' : 'border-gray-300 hover:bg-gray-50' ?> rounded text-sm">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50">Next</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

</div>
<?php include "../components/dashboard/footer.php" ?>