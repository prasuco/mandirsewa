<form
    id="editAnnouncementForm"
    method="post"
    action="edit-announcement.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-lg! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit Announcement
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update the announcement details.
        </p>
    </div>

    <input type="hidden" name="id" id="editAnnouncementId">

    <div class="form-group">
        <label class="form-label">Title <span class="required">*</span></label>
        <input name="title" id="editTitle" class="form-input" placeholder="Special Puja Announcement" required>
    </div>

    <div class="form-group">
        <label class="form-label">Description <span class="required">*</span></label>
        <textarea name="description" id="editDescription" class="form-textarea" placeholder="Details about the announcement..." required></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="form-group">
            <label class="form-label">Start Date <span class="required">*</span></label>
            <input type="datetime-local" name="start_date" id="editStartDate" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label">End Date <span class="required">*</span></label>
            <input type="datetime-local" name="end_date" id="editEndDate" class="form-input" required>
        </div>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Update Announcement
        </button>
    </div>

</form>

<script>
    function openEditAnnouncementModal(id, title, description, startDate, endDate) {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#editAnnouncementId").val(id);
        $("#editTitle").val(title);
        $("#editDescription").val(description);
        
        const formatDateTimeLocal = (dateStr) => {
            const date = new Date(dateStr);
            return date.toISOString().slice(0, 16);
        };
        
        $("#editStartDate").val(formatDateTimeLocal(startDate));
        $("#editEndDate").val(formatDateTimeLocal(endDate));

        $("#editAnnouncementForm").modal({
            fadeDuration: 100,
        });
    }
</script>
