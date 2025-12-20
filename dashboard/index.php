<?php
$title = "Home";
include "../components/dashboard/header.php"


?>



<?php if (!$mandirs) { ?>

    <form id="login-form" class="modal">

    </form>

    <a href="#login-form" rel="modal:open">Login</a>
<?php } ?>
</div>
<?php include "../components/dashboard/footer.php" ?>