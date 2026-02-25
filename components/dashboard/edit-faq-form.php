<?php foreach($faqs as $faq){ ?>
<form
    id="editModal-<?= $faq['id'] ?>"
    method="post"
    action="edit-faq.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Edit FAQ
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Update the FAQ question and answer.
        </p>
    </div>

    <input type="hidden" name="id" value="<?= $faq['id'] ?>">

    <div class="form-group">
        <label class="form-label">Question</label>
        <input name="question" class="form-input" value="<?= htmlspecialchars($faq['question']) ?>" placeholder="What are the temple hours?">
    </div>

    <div class="form-group">
        <label class="form-label">Answer</label>
        <textarea name="answer" class="form-textarea" placeholder="The temple is open from 5 AM to 9 PM..."><?= htmlspecialchars($faq['answer']) ?></textarea>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Update FAQ
        </button>
    </div>

</form>
<?php } ?>
