<form
    id="uploadImageForm"
    method="post"
    action="add-image.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-md! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Upload Image
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Add images to your mandir's gallery.
        </p>
    </div>

    <div class="form-group">
        <label class="form-label">Image Name</label>
        <input name="image_name" class="form-input" placeholder="Main entrance">
    </div>

    <div class="form-group">
        <label class="form-label">Select Image</label>
        <input type="file" name="image" accept="image/png, image/jpeg, image/webp" class="form-input">
    </div>

    <input name="mandir_id" value="<?= $current_mandir ?>" hidden>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Upload
        </button>
    </div>

</form>
