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

<div class="min-h-screen flex flex-col md:flex-row">

  <!-- LEFT SIDE (IMAGE) -->
  <div class="md:w-1/2 w-full h-64 md:h-auto">
    <img src="/mandirsewa/public/images/login_hero.jpg" alt="Login Image" class="w-full h-full object-cover" />
  </div>

  <!-- RIGHT SIDE (LOGIN FORM) -->
  <div class="md:w-1/2 w-full flex items-center justify-center bg-white">
    <div class="w-full max-w-md p-8">

      <h2 class="text-3xl font-bold text-orange-800 mb-6 text-center">
        LOGIN HERE
      </h2>
      <form method="post" class="space-y-4">
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

        <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
          Login
        </button>

      </form>

      <p class="text-center text-sm text-gray-500 mt-4">
        Don't have an account?
        <a href="/mandirsewa/register.php" class="text-red-600 hover:underline">Register</a>
      </p>

    </div>
  </div>

</div>