<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

  <div class="min-h-screen flex flex-col md:flex-row">

    <!-- LEFT SIDE (IMAGE) -->
    <div class="md:w-1/2 w-full h-64 md:h-auto">
      <img src="/mandirsewa/login_hero.jpg" alt="Login Image" class="w-full h-full object-cover" />
    </div>

    <!-- RIGHT SIDE (LOGIN FORM) -->
    <div class="md:w-1/2 w-full flex items-center justify-center bg-white">
      <div class="w-full max-w-md p-8">

        <h2 class="text-3xl font-bold text-orange-800 mb-6 text-center">
          WELCOME TO MANDIR SEWA
        </h2>

        <form class="space-y-4">

          <div>
            <label class="block text-gray-600 mb-1">Email</label>
            <input type="email" placeholder="Enter your email"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

          <div>
            <label class="block text-gray-600 mb-1">Password</label>
            <input type="password" placeholder="Enter your password"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

          <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
            Login
          </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
          Don’t have an account?
          <a href="#" class="text-red-600 hover:underline">Sign up</a>
        </p>

      </div>
    </div>

  </div>

</body>

</html>