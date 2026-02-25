<?php
$title = "Home";
include "../components/dashboard/header.php";


if ($current_mandir) {


    $sql = "select sum(amount_paid) as amount from donations where mandir_id = $current_mandir AND status='COMPLETED' LIMIT 1   ";
    $donations = mysqli_query($conn, $sql)->fetch_assoc();

    $sql = "select count(id) as campaign from campaigns where created_by_mandir = $current_mandir    ";
    $campaigns = mysqli_query($conn, $sql)->fetch_assoc();

    $sql = "select count(id) as announcement from announcements where created_by_mandir = $current_mandir    ";
    $announcements = mysqli_query($conn, $sql)->fetch_assoc();

    $sql = "select count(id) as image from images where mandir_id = $current_mandir    ";
    $images = mysqli_query($conn, $sql)->fetch_assoc();

    $sql = "select count(id) as faq from faqs where created_by_mandir = $current_mandir    ";
    $faqs = mysqli_query($conn, $sql)->fetch_assoc();

    $recentDonationsSql = "SELECT d.*, c.name as campaign_name 
                          FROM donations d 
                          LEFT JOIN campaigns c ON d.campaign_id = c.id 
                          WHERE d.mandir_id = $current_mandir AND d.status='COMPLETED' 
                          ORDER BY d.id DESC 
                          LIMIT 5";
    $recentDonations = mysqli_query($conn, $recentDonationsSql)->fetch_all(MYSQLI_ASSOC);
}
?>
<!-- here comes create mandir form -->
<?php require "../components/dashboard/create-mandir-form.php" ?>

<div class="flex justify-end gap-3 pb-4 border-b border-gray-100">
    <button
        id="createMandir"
        class="btn-primary">
        Create Mandir
    </button>
</div>


<?php if (isset($current_mandir)) {  ?>
    <div class="content ">
        <div class="flex flex-col xl:flex-row gap-2  ">

            <div class=" bg-white shadow rounded-md group min-h-24 relative text-black flex flex-col   w-full p-4  ">

                <div class="absolute right-2 text-primary p-2  top-0 rounded-lg    text-2xl opacity-85  ">

                    <p class="">
                        <i class="fa-solid fa-wallet"></i>
                    </p>

                </div>

                <h2 class="text-md font-normal text-gray-400">
                    Total Donations
                </h2>

                <p class=" text-2xl  font-bold">
                    RS. <?= $donations['amount'] ?? "0" ?>
                </p>



            </div>


            <div class=" bg-white shadow rounded-md group min-h-24 relative text-black flex flex-col   w-full p-4  ">

                <div class="absolute right-2 text-primary p-2  top-0 rounded-lg    text-2xl opacity-85  ">

                    <p class="">
                        <i class="fa-solid fa-calendar"></i>

                    </p>

                </div>

                <h2 class="text-md font-normal text-gray-400">
                    Total Campaigns
                </h2>

                <p class=" text-2xl  font-bold">
                    <?= $campaigns['campaign'] ?>
                </p>



            </div>


            <div class=" bg-white shadow rounded-md group min-h-24 relative text-black flex flex-col   w-full p-4  ">

                <div class="absolute right-2 text-primary p-2  top-0 rounded-lg    text-2xl opacity-85  ">

                    <p class="">
                        <i class="fa-solid fa-bullhorn"></i>

                    </p>

                </div>

                <h2 class="text-md font-normal text-gray-400">
                    Total Announcements
                </h2>

                <p class=" text-2xl  font-bold">
                    <?= $announcements['announcement'] ?>
                </p>

            </div>




        </div>


        <div class="flex flex-col xl:flex-row gap-2 mt-2 ">
            <div class=" bg-white shadow rounded-md group min-h-24 relative text-black flex flex-col   w-full p-4  ">

                <div class="absolute right-2 text-primary p-2  top-0 rounded-lg    text-2xl opacity-85  ">

                    <p class="">
                        <i class="fa-solid fa-images"></i>

                    </p>

                </div>

                <h2 class="text-md font-normal text-gray-400">
                    Total Images
                </h2>

                <p class=" text-2xl  font-bold">
                    <?= $images['image'] ?>
                </p>



            </div>

            <div class=" bg-white shadow rounded-md group min-h-24 relative text-black flex flex-col   w-full p-4  ">

                <div class="absolute right-2 text-primary p-2  top-0 rounded-lg    text-2xl opacity-85  ">

                    <p class="">
                        <i class="fa-solid fa-circle-question"></i>

                    </p>

                </div>

                <h2 class="text-md font-normal text-gray-400">
                    Total FAQs
                </h2>

                <p class=" text-2xl  font-bold">
                    <?= $faqs['faq'] ?>
                </p>



            </div>
        </div>
    </div>

    <?php if (!empty($recentDonations)): ?>
        <div class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Recent Donations</h3>
                <a href="donations.php" class="text-sm text-primary hover:underline">View All</a>
            </div>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="p-3">S.No.</th>
                            <th class="p-3">Donor</th>
                            <th class="p-3">Campaign</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentDonations as $index => $donation): ?>
                            <tr class="border-t border-gray-100 hover:bg-slate-50">
                                <td class="p-3 font-bold"><?= $index + 1 ?></td>
                                <td class="p-3"><?= $donation['donor_name'] ?? 'Anonymous' ?></td>
                                <td class="p-3"><?= $donation['campaign_name'] ?? 'General' ?></td>
                                <td class="p-3 font-semibold text-green-600">Rs. <?= number_format($donation['amount_paid']) ?></td>
                                <td class="p-3 text-gray-500"><?= date('M d, Y', strtotime($donation['created_at'])) ?></td>
                                <td class="p-3">
                                    <a href="/mandirsewa/generateReceipt.php?id=<?= $donation['id'] ?>" target="_blank" class="text-primary hover:underline">
                                        <i class="fa-solid fa-receipt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

<?php } ?>

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