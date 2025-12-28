<?php
$title = "Home";
include "../components/dashboard/header.php";

?>

<?php if (!$mandirs) { ?>
    <div class="min-h-[60vh] flex items-center justify-center px-4">
        <div class="max-w-lg w-full text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-rose-50">
                <i class="fas fa-warning text-rose-400 text-lg"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                No mandir found
            </h2>

            <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                You don't have any mandirs created yet.
                Create one to start managing donations, announcements and content.
            </p>

        </div>
    </div>



<?php } ?>

<!-- here comes create mandir form -->
<?php require "../components/dashboard/create-mandir-form.php" ?>



<div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
    <button
        id="createMandir"
        class="btn-primary">
        Create Mandir
    </button>

    <a
        href="/mandirsewa/m/redirect_to_mandir.php?id=<?= $current_mandir ?>"
        target="_blank"
        class="btn-secondary">
        View Mandir
    </a>
</div>




<script>
    $("#createMandir").click(() => {
        console.log("here")
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#createMandirForm").modal({
            fadeDuration: 100,
        });
    })
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>