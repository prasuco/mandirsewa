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
<div class="min-h-screen flex flex-col md:flex-row">

    <!-- LEFT SIDE (IMAGE) -->
    <div class="md:w-1/2 w-full h-64 md:h-auto">
        <img src="/mandirsewa/public/images/login_hero.jpg" alt="Login Image" class="w-full h-full object-cover" />
    </div>

    <!-- RIGHT SIDE (LOGIN FORM) -->
    <div class="md:w-1/2 w-full flex items-center justify-center bg-white">
        <div class="w-full max-w-md p-8">

            <h2 class="text-3xl font-bold text-orange-800 mb-6 text-center">
                REGISTER YOUR MANDIR ORGANIZATION
            </h2>
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-gray-600 mb-1">Name</label>
                    <input name="name" type="name" placeholder="Enter your name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Email</label>
                    <input name="email" type="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input name="password" type="password" placeholder="Enter your password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block text-gray-600 mb-1"> confirm Password</label>
                    <input name="confirm_password" type="password" placeholder="confirm password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                    submit
                </button>

            </form>
            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account?
                <a href="/mandirsewa/login.php" class="text-red-600 hover:underline">login</a>
            </p>




        </div>
    </div>

</div>

<?php
include "components/footer.php";
?>