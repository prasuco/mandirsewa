<?php
$title = "Home";
include "../components/dashboard/header.php";


$sql = "select * from campaigns where created_by_mandir = $uid";

$campaigns = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<!-- here comes create mandir form -->
<?php require "../components/dashboard/create-campaign-form.php" ?>
<!-- Header -->
<div class="flex items-center justify-between   px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        Campaigns
    </h2>
    <button
        id="createCampaign"
        class="btn-primary">
        Create Campaign
    </button>
</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-clip-border">
    <table class="w-full text-left table-auto min-w-max text-slate-800">
        <thead>
            <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Id
                    </p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Campaign Name
                    </p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Target Amount
                    </p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Type
                    </p>
                </th>

                <th class="p-4">
                    <p>Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($campaigns as $campaign) {  ?>
                <tr class="hover:bg-slate-50">
                    <td class="p-4">
                        <p class="text-sm font-bold">
                            <?= $campaign['id'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $campaign['name'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $campaign['target_amount'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm capitalize">
                            <?= $campaign['type'] ?>
                        </p>
                    </td>

                    <td class="p-4">
                        <a href="" class="text-sm font-semibold ">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php }  ?>

        </tbody>
    </table>

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

    // $('table').dataTable({
    //     paginate: true,
    //     scrollY: 300
    // });
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>