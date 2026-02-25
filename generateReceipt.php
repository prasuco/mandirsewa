<?php
require_once "config/db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Donation not found");
}

$sql = "SELECT d.*, m.description as mandir_description , m.name as mandir_name, m.logo as mandir_logo, c.name as campaign_name
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
    <title>Donation Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans Devanagari', 'Courier New', monospace;
            background: #f0f0f0;
            padding: 20px;
        }
        
        .receipt-container {
            max-width: 320px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .receipt-header {
            background: #fff;
            padding: 15px;
            text-align: center;
            border-bottom: 1px dashed #333;
        }
        
        .mandir-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 8px;
            border: 2px solid #e11d48;
        }
        
        .receipt-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        
        .receipt-subtitle {
            font-size: 11px;
            color: #666;
        }
        
        .receipt-body {
            padding: 15px;
            border-bottom: 1px dashed #333;
        }
        
        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 12px;
        }
        
        .receipt-row.label {
            color: #666;
        }
        
        .receipt-row.value {
            font-weight: bold;
        }
        
        .divider {
            border-bottom: 1px dashed #ccc;
            margin: 8px 0;
        }
        
        .total-section {
            background: #f9f9f9;
            padding: 10px;
            text-align: center;
            margin: 10px 0;
            border: 1px solid #e11d48;
        }
        
        .total-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
        }
        
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #e11d48;
        }
        
        .receipt-footer {
            padding: 15px;
            text-align: center;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #22c55e;
            color: white;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 2px;
            margin-bottom: 10px;
        }
        
        .footer-text {
            font-size: 9px;
            color: #999;
            line-height: 1.4;
        }
        
        .action-buttons {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-primary {
            background: #e11d48;
            color: white;
        }
        
        .btn-secondary {
            background: #666;
            color: white;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .receipt-container {
                box-shadow: none;
                border: 1px solid #333;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <?php if ($donation['mandir_logo']): ?>
            <img src="/mandirsewa/<?= $donation['mandir_logo'] ?>" alt="Logo" class="mandir-logo">
            <?php else: ?>
            <div class="mandir-logo" style="display:flex;align-items:center;justify-content:center;background:#e11d48;color:white;font-size:24px;">
                <i class="fas fa-pray"></i>
            </div>
            <?php endif; ?>
            <div class="receipt-title"><?= $donation['mandir_name'] ?></div>
            <div class="receipt-subtitle"><?= $donation['mandir_description'] ?></div>
        </div>
        
        <div class="receipt-body">
            <div class="receipt-row label">
                <span>Receipt No.</span>
                <span class="value">#<?= str_pad($donation['id'], 6, '0', STR_PAD_LEFT) ?></span>
            </div>
            <div class="divider"></div>
            
            <div class="receipt-row label">
                <span>Date</span>
                <span class="value"><?= date('d/m/Y', strtotime($donation['created_at'])) ?></span>
            </div>
            <div class="receipt-row label">
                <span>Time</span>
                <span class="value"><?= date('h:i A', strtotime($donation['created_at'])) ?></span>
            </div>
            <div class="divider"></div>
            
            <?php if ($donation['campaign_name']): ?>
            <div class="receipt-row label">
                <span>Campaign</span>
                <span class="value"><?= $donation['campaign_name'] ?></span>
            </div>
            <?php endif; ?>
            
            <div class="receipt-row label">
                <span>Payment Mode</span>
                <span class="value"><?= strtoupper($donation['payment_method'] ?? 'ONLINE') ?></span>
            </div>
            
            <?php if (isset($donation['donor_name'])): ?>
            <div class="divider"></div>
            <div class="receipt-row label">
                <span>Donor Name</span>
                <span class="value"><?= $donation['donor_name'] ?></span>
            </div>
            <?php endif; ?>
            
            
            
            <div class="total-section">
                <div class="total-label">Amount Received</div>
                <div class="total-amount">Rs. <?= number_format($donation['amount_paid']) ?></div>
            </div>
        </div>
        
        <div class="receipt-footer">
            <div class="status-badge">
                <i class="fas fa-check"></i> PAID
            </div>
            <div class="footer-text">
                Thank you for your generous donation.<br>
                May God bless you and your family.
            </div>
            <div class="footer-text" style="margin-top:8px;">
                Powered by Mandir Sewa
            </div>
        </div>
    </div>
    
    <div class="no-print" style="text-align:center;margin-top:20px;">
        <div class="action-buttons">
            <a href="/mandirsewa" class="btn btn-primary">
                <i class="fas fa-home"></i> Go to Homepage
            </a>
            <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>
</body>
</html>
