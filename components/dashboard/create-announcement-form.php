<form
    id="createAnnouncementForm"
    method="post"
    action="add-announcement.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-lg! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Create Announcement
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Create an announcement that will be shown on your mandir page.
        </p>
    </div>

    <div class="form-group">
        <label class="form-label">Title <span class="required">*</span></label>
        <input name="title" class="form-input" placeholder="Special Puja Announcement" required>
    </div>

    <div class="form-group">
        <label class="form-label">Description <span class="required">*</span></label>
        <textarea name="description" class="form-textarea" placeholder="Details about the announcement..." required></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Image (Optional)</label>
        <input type="file" name="image" accept="image/png, image/jpeg, image/webp" class="form-input">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="form-group">
            <label class="form-label">Start Date <span class="required">*</span></label>
            <input type="datetime-local" name="start_date" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label">End Date <span class="required">*</span></label>
            <input type="datetime-local" name="end_date" class="form-input" required>
        </div>
    </div>

    <input name="created_by_mandir" value="<?= $current_mandir ?>" hidden>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Create Announcement
        </button>
    </div>

</form>
