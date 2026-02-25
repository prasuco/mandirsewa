<?php
$title = "Mandir Profile";
include "../components/dashboard/header.php";


$sql = "SELECT * FROM mandirs WHERE id = '$current_mandir' LIMIT 1 ";

$mandir = mysqli_query($conn, $sql)->fetch_assoc();

$kycSql = "SELECT * FROM kyc_verifications WHERE mandir_id = '$current_mandir' ORDER BY id DESC LIMIT 1";
$kyc = mysqli_query($conn, $kycSql)->fetch_assoc();

?>

<link href="/mandirsewa/public/css/quill.snow.css" rel="stylesheet" />

<!-- KYC Status Banner -->
<?php 
$kycStatusClass = 'bg-gray-50 border-gray-200';
$kycIconClass = 'bg-gray-100 text-gray-600';
$kycTitle = 'Verification Not Started';
$kycDesc = 'Submit KYC documents to verify your mandir';

if ($mandir['is_verified']) {
    $kycStatusClass = 'bg-green-50 border-green-200';
    $kycIconClass = 'bg-green-100 text-green-600';
    $kycTitle = 'Mandir Verified';
    $kycDesc = 'Your mandir is verified and visible to public';
} elseif ($kyc && $kyc['status'] === 'pending') {
    $kycStatusClass = 'bg-amber-50 border-amber-200';
    $kycIconClass = 'bg-amber-100 text-amber-600';
    $kycTitle = 'Verification Pending';
    $kycDesc = 'Your KYC is under review. Submitted on ' . date('M d, Y', strtotime($kyc['submitted_at']));
} elseif ($kyc && $kyc['status'] === 'rejected') {
    $kycStatusClass = 'bg-red-50 border-red-200';
    $kycIconClass = 'bg-red-100 text-red-600';
    $kycTitle = 'Verification Rejected';
    $kycDesc = 'Your KYC was rejected. Please submit new documents.';
}
?>
<div class="mb-6 p-4 rounded-xl <?= $kycStatusClass ?>">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 <?= $kycIconClass ?> rounded-full flex items-center justify-center">
                <i class="fas <?= $mandir['is_verified'] ? 'fa-check-circle' : 'fa-clock' ?>"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-800"><?= $kycTitle ?></p>
                <p class="text-sm text-gray-600"><?= $kycDesc ?></p>
            </div>
        </div>
        
        <?php if (!$mandir['is_verified'] && (!$kyc || $kyc['status'] === 'rejected')): ?>
            <button type="button" onclick="$('#kycModal').modal({fadeDuration: 100})" class="btn-primary text-sm">
                <?= $kyc && $kyc['status'] === 'rejected' ? 'Resubmit KYC' : 'Submit KYC' ?>
            </button>
        <?php elseif ($kyc && $kyc['status'] === 'pending'): ?>
            <span class="text-sm text-amber-600">Under Review</span>
        <?php endif; ?>
    </div>
</div>

<!-- KYC Modal -->
<div id="kycModal" class="modal bg-white rounded-xl p-6 max-w-lg!">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Submit KYC Documents</h3>
    
    <form method="post" action="add-kyc.php" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="form-label">Document Type</label>
            <select name="document_type" class="form-input" required>
                <option value="">Select document type</option>
                <option value="registration">Temple Registration Certificate</option>
                <option value="pan">PAN/VAT Certificate</option>
                <option value="identity">Owner Identity Document</option>
                <option value="other">Other Legal Document</option>
            </select>
        </div>
        
        <div>
            <label class="form-label">Upload Document</label>
            <input type="file" name="document" accept="image/*,.pdf" class="form-input" required>
            <p class="text-xs text-gray-500 mt-1">Upload clear image or PDF of your document</p>
        </div>
        
        <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="submit" name="submit_kyc" class="btn-primary">Submit for Verification</button>
        </div>
    </form>
</div>

<form

    id="editMandirForm"
    method="post"
    action="update-mandir.php"
    enctype="multipart/form-data"
    class="w-full! rounded-lg space-y-4">

    <!-- Hidden ID -->
    <input type="hidden" name="mandir_id" value="<?= $mandir['id'] ?>">

    <!-- Header -->
    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit mandir
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update mandir details and online presence.
        </p>
    </div>

    <!-- BASIC INFO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="form-group">
            <label class="form-label">Mandir name</label>
            <input
                name="name"
                class="form-input"
                value="<?= htmlspecialchars($mandir['name']) ?>"
                placeholder="Shiva Mandir">
        </div>

        <div class="form-group">
            <label class="form-label">Mandir slug</label>
            <input
                name="slug"
                class="form-input"
                value="<?= htmlspecialchars($mandir['slug']) ?>"
                placeholder="shiva-mandir"
                disabled>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Short description</label>
        <input
            name="description"
            class="form-input"
            value="<?= htmlspecialchars($mandir['description']) ?>"
            placeholder="A peaceful Hindu temple in the hills">
    </div>

    <div class="form-group">
        <label class="form-label">About mandir</label>
        <div
            id="about_content"

            class="form-textarea"
            placeholder="History, significance, rituals...">
            <?= $mandir['about_content'] ?>
        </div>
    </div>

    <!-- LOCATION -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">Location</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="form-label">Latitude</label>
                <input
                    name="address_lat"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['address_lat']) ?>"
                    placeholder="27.7172">
            </div>

            <div class="form-group">
                <label class="form-label">Longitude</label>
                <input
                    name="address_long"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['address_long']) ?>"
                    placeholder="85.3240">
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">Contact</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="form-label">Primary contact</label>
                <input
                    name="primary_contact"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['primary_contact']) ?>"
                    placeholder="+977 98XXXXXXXX">
            </div>

            <div class="form-group">
                <label class="form-label">Secondary contact</label>
                <input
                    name="secondary_contact"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['secondary_contact']) ?>"
                    placeholder="Optional">
            </div>
        </div>
    </div>

    <!-- ONLINE PRESENCE -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">Online presence</h4>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="form-group">
                <label class="form-label">Website</label>
                <input
                    name="website"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['website']) ?>"
                    placeholder="Website">

            </div>


            <div class="form-group">

                <label class="form-label">Facebook</label>
                <input
                    name="facebook"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['facebook']) ?>"
                    placeholder="Facebook">
            </div>
            <div class="form-group">
                <label class="form-label">Youtube</label>
                <input
                    name="youtube"
                    class="form-input"
                    value="<?= htmlspecialchars($mandir['youtube']) ?>"
                    placeholder="YouTube">
            </div>
        </div>
    </div>

    <!-- MEDIA -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">Media</h4>

        <div class="space-y-2">
            <?php if (!empty($mandir['logo'])): ?>
                <img
                    src="/mandirsewa/<?= $mandir['logo'] ?>"
                    alt="Current Logo"
                    class="h-16 rounded border">
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Change logo (optional)</label>
                <input
                    type="file"
                    name="logo"
                    accept="image/png, image/jpeg"
                    class="form-input">
            </div>
        </div>
    </div>

    <input type="text" name="about_content" id="form_about_content" value="<?= $mandir['about_content'] ?>" hidden>

    <!-- ACTIONS -->
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" id="submit_button" class="btn-primary">
            Update Mandir
        </button>
    </div>

</form>


<script src="/mandirsewa/public/js/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    const quill = new Quill('#about_content', {
        theme: 'snow'
    });


    quill.on('editor-change', (e) => {
        let html_content = quill.getSemanticHTML()

        $("#form_about_content").attr('value', html_content)
    })
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>