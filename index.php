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

</div>


<?php
include "components/footer.php";
?>