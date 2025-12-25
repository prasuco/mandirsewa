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


<!-- if not current mandir, show a mandir selector modal -->
<?php if ($mandirs && !$current_mandir) { ?>
    <form id="selectMandirModal"
        class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">
        <h3 class="text-base font-semibold text-gray-800">
            Please Select a Mandir
        </h3>

        <div class="mandirs grid grid-cols-2 items-center gap-2">
            <?php foreach ($mandirs as $mandir) { ?>
                <div class="w-full gap-2 p-2 flex flex-col shadow rounded-md items-center mandir  ">
                    <img class="w-20 h-20 rounded-full" src="/mandirsewa/<?= $mandir['logo'] ?>" alt="<?= $mandir['name'] ?> Logo">
                    <p> <?= $mandir['name'] ?> </p>
                    <a class="btn-primary" href="/mandirsewa/dashboard/select-mandir.php?id=<?= $mandir['id'] ?>">
                        Select Mandir
                    </a>
                </div>
            <?php } ?>


        </div>
    </form>
<?php  } ?>


<script>
    $("#createMandir").click(() => {
        console.log("here")
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#createMandirForm").modal({
            fadeDuration: 100,
        });
    })


    $("#selectMandirModal").modal({
        fadeDuration: 100,
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>