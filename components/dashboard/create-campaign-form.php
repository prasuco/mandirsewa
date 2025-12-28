<form
    id="createCampaignForm"
    method="post"
    action="add-campaign.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <!-- Header -->
    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Create a New Campaign/Event
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Please provide the basic information that is used to create a campaign/event.
        </p>
    </div>

    <!-- BASIC INFO -->


    <div class="grid grid-cols-4 md:grid-cols-6  gap-4 ">
        <div class="form-group col-span-full md:col-span-4">
            <label class="form-label">Campaign/Event Name</label>
            <input name="name" class="form-input" placeholder="Mandir Blood donation Drive">
        </div>

        <div class="form-group col-span-full md:col-span-2">
            <label class="form-label">Type </label>
            <select name="type" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-rose-400">

                <option selected value="event">Event</option>
                <option value="campaign">Campaign</option>
            </select>
        </div>
    </div>




    <div class="form-group">
        <label class="form-label">Short description</label>
        <input name="description" class="form-input"
            placeholder="A peaceful Hindu temple in the hills">
    </div>

    <div class="form-group">
        <label class="form-label">Campaign Details</label>
        <textarea name="content" class="form-textarea"
            placeholder="History, significance, rituals..."></textarea>
    </div>

    <!-- LOCATION -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Target Amount
        </h4>


        <div class="form-group">
            <label class="form-label">Amount</label>
            <input name="target_amount" class="form-input" placeholder="Rs. 222">
        </div>


    </div>

    <input name="created_by_mandir" value="<?= $current_mandir ?>" hidden>


    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Create Campaign
        </button>
    </div>



</form>