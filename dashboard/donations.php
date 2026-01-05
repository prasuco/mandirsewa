<?php
$title = "Home";
include "../components/dashboard/header.php";


$sql = "select * from donations where mandir_id = $current_mandir";

$donations = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);


?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>


<!-- Header -->
<div class="flex items-center justify-between   px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        Recent Donations
    </h2>

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
                        Payment Method
                    </p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Amount
                    </p>
                </th>

                <th class="p-4">
                    <p>Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($donations as $donation) {  ?>
                <tr class="hover:bg-slate-50">
                    <td class="p-4">
                        <p class="text-sm font-bold">
                            <?= $donation['id'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $donation['payment_method'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $donation['amount_paid'] ?>
                        </p>
                    </td>

                    <td class="p-4">
                        <a href="" class="text-sm btn btn-primary font-semibold ">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </td>
                </tr>
            <?php }  ?>

        </tbody>
    </table>

</div>





<script>
    // $('table').dataTable({
    //     paginate: true,
    //     scrollY: 300
    // });
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>