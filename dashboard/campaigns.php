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