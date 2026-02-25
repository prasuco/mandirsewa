<?php
require_once "config/db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Donation not found");
}

$sql = "SELECT d.*, m.name as mandir_name, m.logo as mandir_logo, c.name as campaign_name
        FROM donations d
        JOIN mandirs m ON d.mandir_id = m.id
        LEFT JOIN campaigns c ON d.campaign_id = c.id
        WHERE d.id = $id";

$result = mysqli_query($conn, $sql);
$donation = mysqli_fetch_assoc($result);

if (!$donation) {
    die("Donation not found");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt - <?= $donation['id'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Noto Sans Devanagari', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .receipt {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .receipt-header {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .receipt-body {
            padding: 30px;
        }

        .receipt-footer {
            background: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 20px 0;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .receipt {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-pray text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold mb-2">Donation Receipt</h1>
            <p class="opacity-90">Thank you for your generous contribution</p>
        </div>

        <div class="receipt-body">
            <div class="text-center mb-6">
                <img src="/mandirsewa/<?= $donation['mandir_logo'] ?>" alt="Mandir Logo" class="w-16 h-16 mx-auto rounded-full object-cover mb-3">
                <h2 class="text-xl font-bold text-gray-800"><?= $donation['mandir_name'] ?></h2>

            </div>

            <div class="divider"></div>

            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Receipt No.</span>
                    <span class="font-semibold text-gray-800">#<?= str_pad($donation['id'], 6, '0', STR_PAD_LEFT) ?></span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Date</span>
                    <span class="font-semibold text-gray-800"><?= date('M d, Y H:i', ($donation['created_at'])) ?></span>
                </div>

                <?php if ($donation['campaign_name']): ?>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Campaign</span>
                        <span class="font-semibold text-gray-800"><?= $donation['campaign_name'] ?></span>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Payment Method</span>
                    <span class="font-semibold text-gray-800 uppercase"><?= $donation['payment_method'] ?? 'Online' ?></span>
                </div>

                <?php if (isset($donation['donor_name'])) { ?>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Donor Name</span>
                        <span class="font-semibold text-gray-800"><?= $donation['donor_name']  ?? "N/A" ?></span>
                    </div>
                <?php } ?>


            </div>

            <div class="divider"></div>

            <div class="bg-green-50 rounded-lg p-4 text-center">
                <p class="text-gray-500 text-sm mb-1">Amount Donated</p>
                <p class="text-3xl font-bold text-green-600">Rs. <?= number_format($donation['amount_paid']) ?></p>
            </div>

            <div class="divider"></div>

            <div class="text-center">
                <div class="inline-flex items-center gap-2 text-green-600">
                    <i class="fas fa-check-circle"></i>
                    <span class="font-semibold">Payment Verified</span>
                </div>
                <p class="text-xs text-gray-400 mt-2">This is a computer-generated receipt and does not require a signature.</p>
            </div>
        </div>

        <div class="receipt-footer">
            <a href="/" class="no-print btn-primary inline-flex items-center gap-2">
                <i class="fas fa-home"></i>
                Go to Homepage
            </a>
            <p class="text-xs text-gray-400 mt-3">
                Generated by Mandir Sewa
            </p>
        </div>
    </div>
</body>

</html>