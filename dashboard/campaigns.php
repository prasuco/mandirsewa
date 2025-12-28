<?php
$title = "Home";
include "../components/dashboard/header.php";




?>


<!-- here comes create mandir form -->
<?php require "../components/dashboard/create-campaign-form.php" ?>



<div class="flex justify-end gap-3 pt-4  ">
    <button
        id="createCampaign"
        class="btn-primary">
        Create Campaign
    </button>

</div>


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
<?php  } ?>


<script>
    $("#createCampaign").click(() => {
        console.log("here")
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#createCampaignForm").modal({
            fadeDuration: 100,
        });
    })
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>