<form
    id="editCampaignForm"
    method="post"
    action="edit-campaign.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit Campaign/Event
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update the campaign/event information.
        </p>
    </div>

    <input type="hidden" name="id" id="editCampaignId">

    <div class="grid grid-cols-4 md:grid-cols-6  gap-4 ">
        <div class="form-group col-span-full md:col-span-4">
            <label class="form-label">Campaign/Event Name</label>
            <input name="name" id="editName" class="form-input" placeholder="Mandir Blood donation Drive">
        </div>

        <div class="form-group col-span-full md:col-span-2">
            <label class="form-label">Type </label>
            <select id="editTypeSelector" name="type" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-rose-400">
                <option value="campaign">Campaign</option>
                <option value="event">Event</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Short description</label>
        <input name="description" id="editDescription" class="form-input"
            placeholder="A peaceful Hindu temple in the hills">
    </div>

    <div class="form-group">
        <label class="form-label">Campaign Details</label>
        <textarea name="content" id="editContent" class="form-textarea"
            placeholder="History, significance, rituals..."></textarea>
    </div>

    <div id="editAmountWrapper">
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Target Amount
        </h4>

        <div class="form-group">
            <label class="form-label">Amount</label>
            <input id="editTargetAmount" name="target_amount" class="form-input" placeholder="Rs. 222">
        </div>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Update Campaign
        </button>
    </div>

</form>

<script>
    const editTypeSelector = $("#editTypeSelector");
    const editAmountWrapper = $("#editAmountWrapper");

    editTypeSelector.change((d) => {
        let type = d.target.value;
        if (type == 'event') {
            editAmountWrapper.hide()
        } else {
            editAmountWrapper.show()
        }
    });

    function openEditCampaignModal(id, name, description, content, targetAmount, type) {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#editCampaignId").val(id);
        $("#editName").val(name);
        $("#editDescription").val(description);
        $("#editContent").val(content);
        $("#editTargetAmount").val(targetAmount);
        $("#editTypeSelector").val(type);

        if (type == 'event') {
            editAmountWrapper.hide()
        } else {
            editAmountWrapper.show()
        }

        $("#editCampaignForm").modal({
            fadeDuration: 100,
        });
    }
</script>
