<?php
$title = "Mandir Profile";
include "../components/dashboard/header.php";


$sql = "SELECT * FROM mandirs WHERE id = '$current_mandir' LIMIT 1 ";

$mandir = mysqli_query($conn, $sql)->fetch_assoc();


?>

<link href="/mandirsewa/public/css/quill.snow.css" rel="stylesheet" />

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
                placeholder="shiva-mandir">
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