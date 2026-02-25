<?php
$title = "Mandir Verifications";
include 'header.php';

$filter = $_GET['filter'] ?? 'all';

if ($filter === 'pending') {
    $sql = "SELECT m.*, u.name as owner_name, u.email as owner_email, 
            k.status as kyc_status, k.document_url, k.document_type, k.submitted_at
            FROM mandirs m 
            JOIN users u ON m.created_by = u.id
            LEFT JOIN kyc_verifications k ON m.id = k.mandir_id AND k.status = 'pending'
            WHERE m.is_verified = 0 
            ORDER BY m.created_at DESC";
} elseif ($filter === 'recent') {
    $sql = "SELECT m.*, u.name as owner_name, u.email as owner_email, 
            k.status as kyc_status, k.document_url, k.document_type, k.submitted_at
            FROM mandirs m 
            JOIN users u ON m.created_by = u.id
            LEFT JOIN kyc_verifications k ON m.id = k.mandir_id
            WHERE k.status = 'pending' AND k.submitted_at >= DATE_SUB(NOW(), INTERVAL 3 DAY)
            ORDER BY k.submitted_at DESC";
} elseif ($filter === 'verified') {
    $sql = "SELECT m.*, u.name as owner_name, u.email as owner_email,
            k.status as kyc_status, k.document_url, k.document_type, k.submitted_at
            FROM mandirs m 
            JOIN users u ON m.created_by = u.id
            LEFT JOIN kyc_verifications k ON m.id = k.mandir_id
            WHERE m.is_verified = 1
            ORDER BY m.created_at DESC";
} else {
    $sql = "SELECT m.*, u.name as owner_name, u.email as owner_email,
            k.status as kyc_status, k.document_url, k.document_type, k.submitted_at
            FROM mandirs m 
            JOIN users u ON m.created_by = u.id
            LEFT JOIN kyc_verifications k ON m.id = k.mandir_id
            ORDER BY m.created_at DESC";
}

$mandirs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Mandir Verifications</h1>
        
        <div class="flex gap-2">
            <a href="?filter=all" class="px-3 py-1.5 rounded-lg text-sm <?= $filter === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                All
            </a>
            <a href="?filter=recent" class="px-3 py-1.5 rounded-lg text-sm <?= $filter === 'recent' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                Recently Submitted
            </a>
            <a href="?filter=pending" class="px-3 py-1.5 rounded-lg text-sm <?= $filter === 'pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                Pending
            </a>
            <a href="?filter=verified" class="px-3 py-1.5 rounded-lg text-sm <?= $filter === 'verified' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                Verified
            </a>
        </div>
    </div>

    <?php if (count($mandirs) > 0): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3">Mandir</th>
                        <th class="px-4 py-3">Owner</th>
                        <th class="px-4 py-3">KYC Status</th>
                        <th class="px-4 py-3">Verified</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($mandirs as $mandir): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="/mandirsewa/<?= $mandir['logo'] ?? 'public/images/logo.webp' ?>" class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <p class="font-medium text-gray-900"><?= $mandir['name'] ?></p>
                                        <p class="text-sm text-gray-500"><?= $mandir['slug'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm"><?= $mandir['owner_name'] ?></p>
                                <p class="text-xs text-gray-500"><?= $mandir['owner_email'] ?></p>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($mandir['kyc_status'] === 'pending'): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                        KYC Pending
                                    </span>
                                <?php elseif ($mandir['kyc_status'] === 'verified'): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        KYC Verified
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        No KYC
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($mandir['is_verified']): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Verified
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        Unverified
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 flex-col">
                                    <?php if ($mandir['document_url']): ?>
                                        <a href="/mandirsewa/<?= $mandir['document_url'] ?>" target="_blank" class="text-sm text-blue-600 hover:underline">
                                            View Doc
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($mandir['kyc_status'] === 'pending'): ?>
                                        <a href="verify-mandir.php?id=<?= $mandir['id'] ?>&action=reject_kyc" 
                                           onclick="return confirm('Reject this KYC?')"
                                           class="text-sm text-red-600 hover:underline">
                                            Reject KYC
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if (!$mandir['is_verified']): ?>
                                        <a href="verify-mandir.php?id=<?= $mandir['id'] ?>&action=verify" 
                                           onclick="return confirm('Verify this mandir?')"
                                           class="text-sm text-green-600 hover:underline">
                                            Verify
                                        </a>
                                    <?php else: ?>
                                        <a href="verify-mandir.php?id=<?= $mandir['id'] ?>&action=unverify"
                                           onclick="return confirm('Unverify this mandir?')"
                                           class="text-sm text-red-600 hover:underline">
                                            Unverify
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-temple text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No mandirs found</h3>
            <p class="text-gray-500">There are no mandirs to verify.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
