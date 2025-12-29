<form
    id="createFAQForm"
    method="post"
    action="add-faq.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <!-- Header -->
    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Create a New FAQ
        </h3>
    </div>

    <div class="form-group">
        <label class="form-label">Question</label>
        <input name="question" class="form-input"
            placeholder="What is the time of your mandirs opening?">
    </div>

    <div class="form-group">
        <label class="form-label">Answer</label>
        <textarea name="answer" class="form-textarea"
            placeholder="Desired answer here"></textarea>
    </div>




    <input name="created_by_mandir" value="<?= $current_mandir ?>" hidden>


    <div class="flex justify-end gap-3  border-gray-100">
        <button type="submit" class="btn-primary">
            Create Campaign
        </button>
    </div>

</form>