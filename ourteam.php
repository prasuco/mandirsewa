<?php
$title = "About";
include 'components/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Team</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Our Team Section -->
  <section class="py-12">
    <div class="max-w-6xl mx-auto px-4 text-center">
      
      <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Team</h2>
      <p class="text-gray-600 mb-10">
        Meet the people behind our website
      </p>

      <!-- Team Members -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <!-- Team Member 1 -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <img 
            src="/mandirsewa/public/images/sunis.png" 
            alt="Your Name"
            class="w-32 h-32 mx-auto rounded-full object-cover mb-4"
          />
          <h3 class="text-xl font-semibold text-gray-800">Sunischya Khatiwada</h3>
          <p class="text-gray-500">Frontend Developer</p>
        </div>

        <!-- Team Member 2 -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <img 
            src="/mandirsewa/public/images/prab.png" 
            alt="Purushottam Subedi"
            class="w-32 h-32 mx-auto rounded-full object-cover mb-4"
          />
          <h3 class="text-xl font-semibold text-gray-800">Purushottam Subedi</h3>
          <p class="text-gray-500">Backend Developer</p>
        </div>

        <!-- Team Member 3 -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <img 
            src="/mandirsewa/public/images/jivan.png" 
            alt="Jivan Niraula"
            class="w-32 h-32 mx-auto rounded-full object-cover mb-4"
          />
          <h3 class="text-xl font-semibold text-gray-800">Jivan Niraula</h3>
          <p class="text-gray-500">Supervisor</p>
        </div>

      </div>
    </div>
  </section>

</body>
</html>
<?php
include "components/footer.php";
?>