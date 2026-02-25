<?php
$title = "Home";
include "../components/dashboard/header.php";


$sql = "select * from campaigns where created_by_mandir = $current_mandir";

$campaigns = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$donationsByCampaign = [];
if (!empty($campaigns)) {
    $campaignIds = array_column($campaigns, 'id');
    $campaignIdsStr = implode(',', $campaignIds);
    $donationsSql = "SELECT campaign_id, SUM(amount_paid) as total_donations FROM donations WHERE campaign_id IN ($campaignIdsStr) AND status='COMPLETED' GROUP BY campaign_id";
    $donationsResult = mysqli_query($conn, $donationsSql);
    while ($row = mysqli_fetch_assoc($donationsResult)) {
        $donationsByCampaign[$row['campaign_id']] = $row['total_donations'];
    }
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<!-- here comes create mandir form -->
<?php require "../components/dashboard/create-campaign-form.php" ?>
<?php require "../components/dashboard/edit-campaign-form.php" ?>
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
                    <p class="text-sm leading-none font-normal">Id</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Campaign Name</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Target Amount</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Raised</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Progress</p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">Type</p>
                </th>
                <th class="p-4">
                    <p>Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($campaigns as $campaign): 
                $raised = $donationsByCampaign[$campaign['id']] ?? 0;
                $target = $campaign['target_amount'] ?? 0;
                $progress = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
            ?>
                <tr class="hover:bg-slate-50">
                    <td class="p-4">
                        <p class="text-sm font-bold"><?= $campaign['id'] ?></p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm"><?= $campaign['name'] ?></p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">Rs. <?= number_format($campaign['target_amount']) ?></p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">Rs. <?= number_format($raised) ?></p>
                    </td>
                    <td class="p-4">
                        <div class="w-24">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span><?= $progress ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full" style="width: <?= $progress ?>%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <p class="text-sm capitalize"><?= $campaign['type'] ?></p>
                    </td>
                    <td class="p-4">
                        <button type="button" 
                            onclick="openEditCampaignModal(
                                <?= $campaign['id'] ?>,
                                '<?= addslashes($campaign['name']) ?>',
                                '<?= addslashes($campaign['description'] ?? '') ?>',
                                '<?= addslashes($campaign['content'] ?? '') ?>',
                                '<?= $campaign['target_amount'] ?>',
                                '<?= $campaign['type'] ?>'
                            )"
                            class="text text-blue-600 hover:text-blue--sm font-semibold700 mr-3">
                            Edit
                        </button>
                        <a href="delete-campaign.php?id=<?= $campaign['id'] ?>" onclick="return confirm('Delete this campaign?')" class="text-sm font-semibold text-red-600 hover:text-red-700">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

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