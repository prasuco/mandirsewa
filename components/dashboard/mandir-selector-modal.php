<!-- if not current mandir, show a mandir selector modal -->
<?php if ($mandirs && !$current_mandir) { ?>
    <form id="selectMandirModal"
        class="modal bg-white w-full! max-w-2xl!   rounded-lg p-6 space-y-4 ">
        <h3 class="text-base font-semibold text-gray-800">
            Please Select a Mandir
        </h3>

        <div class="mandirs grid grid-cols-2 md:grid-cols-3 max-h-96 overflow-auto  items-center gap-2  ">
            <?php foreach ($mandirs as $mandir) { ?>
                <div class="w-full gap-2 p-2 flex flex-col shadow rounded-md items-center mandir  ">
                    <img class="w-20 h-20 rounded-full" src="/mandirsewa/<?= $mandir['logo'] ?>" alt="<?= $mandir['name'] ?> Logo">
                    <p> <?= $mandir['name'] ?> </p>
                    <a class="btn-primary btn-sm" href="/mandirsewa/dashboard/select-mandir.php?id=<?= $mandir['id'] ?>">
                        Select Mandir
                    </a>
                </div>
            <?php } ?>

        </div>
    </form>

    <script>
        $("#selectMandirModal").modal({
            fadeDuration: 100,
            escapeClose: false,
            clickClose: false,
            showClose: false
        });
    </script>
<?php  } ?>