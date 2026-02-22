<?php
$title = "Homepage";
include 'components/header.php';
?>

<div class="flex flex-col p-2 max-w-6xl mx-auto justify-around items-center  mt-10">
  <div class="flex-col text-center   items-center space-y-6   ">
    <p
      class="bg-[#1e1f250a] hover:border-gray-300 border border-gray-200 font-medium  text-sm  text-black inline-block px-2 rounded-full  ">
      For Devotess Worldwide

    </p>

    <h1 class="md:text-6xl text-3xl text-center font-bold leading-snug ">
      Support
      <span class=" bg-primary text-white px-4 py-[-16px]">Mandir</span> Digitally
      <br>
      With
      <span class="underline line decoration-wavy decoration-secondary underline-offset-[20px   ] ">
        Devotion
      </span>
    </h1>

    <p class="text-lg text-gray-600 font-[350] text-center max-w-sm md:max-w-lg mx-auto font-sans leading-tight ">
      Mandir sewa is a digital platform that helps devotees offer donations with faith, transparency and ease.
    </p>

    <a href="dashboard" class="btn btn-primary relative">
      Try Now <i class="fa-solid fa-arrow-right"></i>
    </a>
    <img class=" border-2  border-gray-300 p-0.5 bg-secondary rounded-xl" src="/mandirsewa/public/images/image.png" alt="photo">
  </div>



</div>


  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    @keyframes scroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    .animate-scroll {
      animation: scroll 35s linear infinite;
    }
  </style>
</head>

<body class="bg-orange-50">

  <section class="py-20 overflow-hidden bg-white">
    
    
    <div class="text-center mb-14">
      <h2 class="text-gray-500 uppercase tracking-widest text-base font-semibold">
        Trusted by Thousands of Mandirs
      </h2>
    </div>

    
    <div class="relative w-full overflow-hidden">
      
      
      <div class="absolute left-0 top-0 h-full w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
      <div class="absolute right-0 top-0 h-full w-32 bg-gradient-to-l from-white to-transparent z-10"></div>

      <div class="flex w-max animate-scroll space-x-24 items-center">

     

      
        <img src="/mandirsewa/public/images/pasupati.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
        <img src="/mandirsewa/public/images/kali.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
        <img src="/mandirsewa/public/images/sus.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
        <img src="/mandirsewa/public/images/download.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
        <img src="/mandirsewa/public/images/mmm.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
        <img src="/mandirsewa/public/images/img.png" class="h-24 object-contain grayscale opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />

        
        <img src="/mandirsewa/public/images/pasupati.png" class="h-24 object-contain" />
        <img src="/mandirsewa/public/images/kali.png class"class="h-24 object-contain" />
        <img src="/mandirsewa/public/images/sus.png" class="h-24 object-contain" />
        <img src="/mandirsewa/public/images/download.png" class="h-24 object-contain" />
        <img src="/mandirsewa/public/images/mmm.png" class="h-24 object-contain" />
        <img src="/mandirsewa/public/images/img.png" class="h-24 object-contain" />

      </div>
    </div>

  </section>

</body>
</html>


<?php
include "components/footer.php";
?>