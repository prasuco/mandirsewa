<?php

$title = "Login";
include  'components/header.php';
include  'utils/utils.php';
redirect_if_authenticated();




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from users where email = '" . $email . "' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['message'] = "Logged in Successfully";
            header("Location: /mandirsewa/dashboard");
        } else {
            $_SESSION['message'] = "password doesnot match";
        }
    }
}

?>

<form action="" method="post">
    EMAIL : <input type="email" name="email">
    Password : <input type="text" name="password">

    <button type="submit">
        Login
    </button>
</form>
<?php
include "components/footer.php";
?>