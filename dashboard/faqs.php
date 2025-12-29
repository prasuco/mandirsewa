<?php
$title = "Home";
include "../components/dashboard/header.php";


$sql = "select * from faqs where created_by_mandir = $current_mandir";

$faqs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<!-- here comes create faq form -->
<?php require "../components/dashboard/create-faq-form.php" ?>
<!-- Header -->
<div class="flex items-center justify-between   px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        FAQs
    </h2>
    <button
        id="createFAQ"
        class="btn-primary">
        Create FAQ
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
                        Question
                    </p>
                </th>
                <th class="p-4">
                    <p class="text-sm leading-none font-normal">
                        Answer
                    </p>
                </th>

                <th class="p-4">
                    <p>Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($faqs as $faq) {  ?>
                <tr class="hover:bg-slate-50">
                    <td class="p-4">
                        <p class="text-sm font-bold">
                            <?= $faq['id'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $faq['question'] ?>
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm">
                            <?= $faq['answer'] ?>
                        </p>
                    </td>

                    <td class="p-4">
                        <a href="" class="text-sm font-semibold ">
                            Edit
                        </a>
                        <a href="" class="text-sm font-semibold ">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php }  ?>

        </tbody>
    </table>

</div>





<script>
    $("#createFAQ").click(() => {
        console.log("here")
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')

        $("#createFAQForm").modal({
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