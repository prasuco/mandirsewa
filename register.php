<?php
$title = "Register your account";
require_once  'components/header.php';
require_once  'utils/utils.php';
redirect_if_authenticated();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // checking whether user email exists or not.
    $sql = "SELECT email FROM users WHERE email = '" . $email . "' LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {

        $_SESSION['message'] = "Email already exists";
        echo "Email Already Exists";
    } else {

        if ($password === $confirm_password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT  INTO users(name,  email, password) VALUES('$name', '$email', '$password')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                // echo "Account Created Successfully";
                $_SESSION['message'] = "Account Created Successfully";

                header("Location: /mandirsewa/login.php");
            }
        } else {
            $_SESSION['message'] = "Confirm password doesnot match";
        }
    }
}





?>

<h1 class="text-3xl bg-blue-300">
    Register page
</h1>

<form action="" method="post">

    name: <input name="name" />
    email: <input name="email" />
    password: <input name="password" />
    confirm_password: <input name="confirm_password" />
    <input type="submit">
</form>

<?php
include "components/footer.php";
?>