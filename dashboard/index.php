<?php
$title = "Home";
include "../components/dashboard/header.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $about_content = mysqli_real_escape_string($conn, $_POST['about_content']);
    $address_lat = mysqli_real_escape_string($conn, $_POST['address_lat']);
    $address_long = mysqli_real_escape_string($conn, $_POST['address_long']);
    $primary_contact = mysqli_real_escape_string($conn, $_POST['primary_contact']);
    $secondary_contact = mysqli_real_escape_string($conn, $_POST['secondary_contact']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $youtube = mysqli_real_escape_string($conn, $_POST['youtube']);

    $uploadDir = __DIR__ . '/../uploads/';

    // checking if directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $logo = null;
    if (!empty($_FILES['logo']['name'])) {
        $logo_name = time() . '_' . basename($_FILES['logo']['name']);
        $logo_path = $uploadDir . $logo_name;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path)) {
            $logo = 'uploads/' . $logo_name;
        }
    }

    $sql = "INSERT INTO mandirs
            (name, slug, description, about_content, address_lat, address_long, primary_contact, secondary_contact, website, facebook, youtube, logo, created_by)
            VALUES 
            ('$name', '$slug', '$description', '$about_content', '$address_lat', '$address_long', '$primary_contact', '$secondary_contact', '$website', '$facebook', '$youtube','$logo', '$uid')";

    if (mysqli_query($conn, $sql)) {
        $sql = "select * from mandirs where `created_by` =  $uid ";
        $mandirs = mysqli_query($conn, $sql)->fetch_all();

        $_SESSION['message'] = "Mandir Created Successfully";
    } else {
        $_SESSION['message'] = "Failed Creating mandir";
    }
}



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

            <button
                id="createMandir"
                class="btn-primary">
                Create Mandir
            </button>

        </div>
    </div>

    <!-- Modal -->
    <form
        id="createMandirForm"
        method="post"
        enctype="multipart/form-data"
        class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

        <!-- Header -->
        <div>
            <h3 class="text-base font-semibold text-gray-800">
                Create a new mandir
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Basic information used to create your mandir profile.
            </p>
        </div>

        <!-- BASIC INFO -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="form-group">
                <label class="form-label">Mandir name</label>
                <input name="name" class="form-input" placeholder="Shiva Mandir">
            </div>

            <div class="form-group">
                <label class="form-label">Mandir slug</label>
                <input name="slug" class="form-input" placeholder="shiva-mandir">
            </div>

        </div>

        <div class="form-group">
            <label class="form-label">Short description</label>
            <input name="description" class="form-input"
                placeholder="A peaceful Hindu temple in the hills">
        </div>

        <div class="form-group">
            <label class="form-label">About mandir</label>
            <textarea name="about_content" class="form-textarea"
                placeholder="History, significance, rituals..."></textarea>
        </div>

        <!-- LOCATION -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                Location
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Latitude</label>
                    <input name="address_lat" class="form-input" placeholder="27.7172">
                </div>
                <div class="form-group">
                    <label class="form-label">Longitude</label>
                    <input name="address_long" class="form-input" placeholder="85.3240">
                </div>
            </div>
        </div>

        <!-- CONTACT -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                Contact
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Primary contact</label>
                    <input name="primary_contact" class="form-input" placeholder="+977 98XXXXXXXX">
                </div>

                <div class="form-group">
                    <label class="form-label">Secondary contact</label>
                    <input name="secondary_contact" class="form-input" placeholder="Optional">
                </div>
            </div>
        </div>

        <!-- SOCIAL -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                Online presence
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <input name="website" class="form-input" placeholder="Website">
                <input name="facebook" class="form-input" placeholder="Facebook">
                <input name="youtube" class="form-input" placeholder="YouTube">
            </div>
        </div>

        <!-- MEDIA -->
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                Media
            </h4>

            <div class="grid grid-cols-1 gap-4">
                <div class="form-group">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-input">
                </div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">
                Create Mandir
            </button>
        </div>

    </form>

<?php } ?>

<!-- if not current mandir, show a mandir selector modal -->
<?php if ($mandirs && !$current_mandir) { ?>
    <form id="selectMandirModal"
        class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">
        <h3 class="text-base font-semibold text-gray-800">
            Please Select a Mandir
        </h3>

        <div class="mandirs flex flex-row items-center gap-2">

            <?php foreach ($mandirs as $mandir) { ?>
                <div class="w-full gap-2 p-2 flex flex-col shadow rounded-md items-center mandir  ">
                    <img class="w-20 h-20 rounded-full" src="/mandirsewa/<?= $mandir['logo'] ?>" alt="">
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