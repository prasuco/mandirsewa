<?php foreach($campaigns as $campaign){ ?>
<form
    id="editModal-<?= $campaign['id'] ?>"
    method="post"
    action="edit-campaign.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <!-- Title -->
    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit <?= ucfirst($campaign['type']) ?>
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update the campaign/event information.
        </p>
    </div>

    <input type="hidden" name="id" value="<?= $campaign['id'] ?>">
    <input name="created_by_mandir" value="<?= $current_mandir ?>" hidden>

    <!-- Name + Type -->
    <div class="grid grid-cols-4 md:grid-cols-6 gap-4">
        <div class="form-group col-span-full md:col-span-4">
            <label class="form-label">Campaign/Event Name</label>
            <input name="name" class="form-input" value="<?= htmlspecialchars($campaign['name']) ?>">
        </div>

        <div class="form-group col-span-full md:col-span-2">
            <label class="form-label">Type</label>
            <select name="type" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-rose-400 editTypeSelector">
                <option value="campaign" <?= $campaign['type'] === 'campaign' ? 'selected' : '' ?>>Campaign</option>
                <option value="event" <?= $campaign['type'] === 'event' ? 'selected' : '' ?>>Event</option>
            </select>
        </div>
    </div>

    <!-- Short description -->
    <div class="form-group">
        <label class="form-label">Short description</label>
        <input name="description" class="form-input" value="<?= htmlspecialchars($campaign['description'] ?? '') ?>">
    </div>

    <!-- Campaign details -->
    <div class="form-group">
        <label class="form-label">Campaign Details</label>
        <textarea name="content" class="form-textarea"><?= htmlspecialchars($campaign['content'] ?? '') ?></textarea>
    </div>

    <!-- Amount wrapper -->
    <div class="amountWrapper" <?= $campaign['type'] === 'event' ? 'style="display:none"' : '' ?>>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Target Amount
        </h4>
        <div class="form-group">
            <label class="form-label">Amount</label>
            <input name="target_amount" class="form-input" value="<?= $campaign['target_amount'] ?>">
        </div>
    </div>

    <!-- Submit -->
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">Update <?= ucfirst($campaign['type']) ?></button>
    </div>
</form>
<?php } ?>
<script>
$(".editTypeSelector").each(function(){
    const select = $(this);
    const wrapper = select.closest("form").find(".amountWrapper");

    select.change(function(){
        if(select.val() === 'event'){
            wrapper.hide();
        } else {
            wrapper.show();
        }
    });
});
</script>