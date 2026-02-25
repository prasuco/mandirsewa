<?php
$title = "Announcements";
include "../components/dashboard/header.php";

$sql = "SELECT * FROM announcements WHERE created_by_mandir = $current_mandir ORDER BY id DESC";
$announcements = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>

<?php require "../components/dashboard/create-announcement-form.php" ?>
<?php require "../components/dashboard/edit-announcement-form.php" ?>

<div class="flex items-center justify-between px-4 py-3">
    <h2 class="text-xl font-semibold text-gray-800">
        Announcements
    </h2>
    <button id="createAnnouncement" class="btn-primary">
        Create Announcement
    </button>
</div>

<?php if (count($announcements) > 0): ?>
    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-clip-border">
        <table class="w-full text-left table-auto min-w-max text-slate-800">
            <thead>
                <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">Id</p>
                    </th>
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">Title</p>
                    </th>
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">Description</p>
                    </th>
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">Start Date</p>
                    </th>
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">End Date</p>
                    </th>
                    <th class="p-4">
                        <p class="text-sm leading-none font-normal">Status</p>
                    </th>
                    <th class="p-4">
                        <p>Actions</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($announcements as $announcement): 
                    $now = time();
                    $start = strtotime($announcement['start_date']);
                    $end = strtotime($announcement['end_date']);
                    $is_active = ($now >= $start && $now <= $end);
                ?>
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <p class="text-sm font-bold"><?= $announcement['id'] ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm"><?= $announcement['title'] ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm truncate max-w-[200px]"><?= $announcement['description'] ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm"><?= date('M d, Y', strtotime($announcement['start_date'])) ?></p>
                        </td>
                        <td class="p-4">
                            <p class="text-sm"><?= date('M d, Y', strtotime($announcement['end_date'])) ?></p>
                        </td>
                        <td class="p-4">
                            <?php if ($is_active): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    Active
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    Inactive
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4">
                            <button type="button" 
                                onclick="openEditAnnouncementModal(
                                    <?= $announcement['id'] ?>,
                                    '<?= addslashes($announcement['title']) ?>',
                                    '<?= addslashes($announcement['description']) ?>',
                                    '<?= $announcement['start_date'] ?>',
                                    '<?= $announcement['end_date'] ?>'
                                )"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700 mr-3">
                                Edit
                            </button>
                            <a href="delete-announcement.php?id=<?= $announcement['id'] ?>" onclick="return confirm('Delete this announcement?')" class="text-sm font-semibold text-rose-500 hover:text-rose-600">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="min-h-[40vh] flex items-center justify-center px-4">
        <div class="max-w-lg w-full text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                <i class="fas fa-bullhorn text-gray-400 text-lg"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                No announcements yet
            </h2>
            <p class="text-sm text-gray-500 mb-6">
                Create announcements to display important messages on your mandir page.
            </p>
        </div>
    </div>
<?php endif; ?>

<script>
    $("#createAnnouncement").click(() => {
        $('#sidebar').css('z-index', 'unset')
        $('#topbar').css('z-index', 'unset')
        $("#createAnnouncementForm").modal({
            fadeDuration: 100,
        });
    })
</script>
</div>
<?php include "../components/dashboard/footer.php" ?>
