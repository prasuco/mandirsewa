<form
    id="editImageForm"
    method="post"
    action="edit-image.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-lg! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit Image
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update the image name.
        </p>
    </div>

    <input type="hidden" name="id" id="editImageId">

    <div class="form-group">
        <label class="form-label">Image Name</label>
        <input name="image_name" id="editImageName" class="form-input" placeholder="Enter image name">
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Update Image
        </button>
    </div>

</form>

<script>
    function openEditImageModal(id, imageName) {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#editImageId").val(id);
        $("#editImageName").val(imageName);

        $("#editImageForm").modal({
            fadeDuration: 100,
        });
    }
</script>
