<form
    id="editFAQForm"
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

    <input type="hidden" name="id" id="editFaqId">

    <div class="form-group">
        <label class="form-label">Question</label>
        <input name="question" id="editQuestion" class="form-input" placeholder="What are the temple hours?">
    </div>

    <div class="form-group">
        <label class="form-label">Answer</label>
        <textarea name="answer" id="editAnswer" class="form-textarea" placeholder="The temple is open from 5 AM to 9 PM..."></textarea>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Update FAQ
        </button>
    </div>

</form>

<script>
    function openEditFAQModal(id, question, answer) {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#editFaqId").val(id);
        $("#editQuestion").val(question);
        $("#editAnswer").val(answer);

        $("#editFAQForm").modal({
            fadeDuration: 100,
        });
    }
</script>
