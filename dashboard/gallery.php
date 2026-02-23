<?php
$title = "Gallery";
include "../components/dashboard/header.php";

$sql = "SELECT * FROM images WHERE mandir_id = $current_mandir ORDER BY id DESC";
$images = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>

<?php require "../components/dashboard/create-image-form.php" ?>

<div class="flex items-center justify-between px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        Gallery
    </h2>
    <button id="uploadImage" class="btn-primary">
        Upload Image
    </button>
</div>

<?php if (count($images) > 0): ?>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4">
        <?php foreach ($images as $image): ?>
            <div class="relative group bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                <img src="/mandirsewa/<?= $image['url'] ?>" alt="<?= $image['image_name'] ?>" class="w-full h-40 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                    <a href="/mandirsewa/<?= $image['url'] ?>" target="_blank" class="bg-white text-gray-800 px-3 py-1.5 rounded text-sm font-medium hover:bg-gray-100">
                        View
                    </a>
                    <a href="delete-image.php?id=<?= $image['id'] ?>" onclick="return confirm('Delete this image?')" class="bg-rose-500 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-rose-600">
                        Delete
                    </a>
                </div>
                <div class="p-2">
                    <p class="text-xs text-gray-600 truncate"><?= $image['image_name'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="min-h-[40vh] flex items-center justify-center px-4">
        <div class="max-w-lg w-full text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                <i class="fas fa-images text-gray-400 text-lg"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                No images yet
            </h2>
            <p class="text-sm text-gray-500 mb-6">
                Upload images to showcase your mandir's gallery.
            </p>
        </div>
    </div>
<?php endif; ?>

<script>
    $("#uploadImage").click(() => {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')
        $("#uploadImageForm").modal({
            fadeDuration: 100,
        });
    })
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>
