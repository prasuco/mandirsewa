<?php
$title = "Homepage";
include 'components/header.php';
$sql = "select * from mandirs";
$mandirs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>


<style>
  @keyframes marquee-ltr {
    0% {
      transform: translateX(-50%);
    }

    100% {
      transform: translateX(0%);
    }
  }

  .animate-scroll {
    animation: marquee-ltr 30s linear infinite;
  }
</style>

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




<section class="py-20 overflow-hidden bg-white">
  <div class="text-center mb-14">
    <h2 class="text-black uppercase tracking-widest text-base font-semibold">
      Trusted by Thousands of Mandirs
    </h2>
  </div>


  <div class="relative w-full overflow-hidden">

    <div class="absolute left-0 top-0 h-full w-32 bg-linear-to-r from-white to-transparent z-10"></div>
    <div class="absolute right-0 top-0 h-full w-32 bg-linear-to-l from-white to-transparent z-10"></div>

    <div class="flex w-max animate-scroll space-x-24 items-center">

      <!-- more number of elements more full the animation will be -->
      <?php foreach ($mandirs as $mandir) { ?>
        <img src="/mandirsewa/<?= $mandir['logo'] ?>" class="h-24 object-contain grayscale hover:grayscale-0 opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
      <?php } ?>

      <?php foreach (($mandirs) as $mandir) { ?>
        <img src="/mandirsewa/<?= $mandir['logo'] ?>" class="h-24 object-contain grayscale hover:grayscale-0 opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
      <?php } ?>
      <?php foreach (($mandirs) as $mandir) { ?>
        <img src="/mandirsewa/<?= $mandir['logo'] ?>" class="h-24 object-contain grayscale hover:grayscale-0 opacity-70 hover:opacity-100 hover:scale-110 transition duration-300" />
      <?php } ?>
    </div>
  </div>

</section>


<section class="bg-neutral-100 py-24 px-6">
  <div class="max-w-6xl mx-auto text-center">


    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
      Designed for


      <span class="bg-primary text-white px-4 py-[-16px]">Mandirs</span>
      <br />
      not for


      <span class="underline line decoration-wavy decoration-secondary underline-offset-[20px   ] ">
        middlemen
      </span>.
    </h1>


    <div class="mt-20 grid md:grid-cols-2 gap-12 text-left">


      <div class="flex items-start gap-5">
        <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-gray-800 flex items-center justify-center">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <p class="text-lg text-gray-600">
          We don't call them “donors” or transactions. They are your
          <span class="font-semibold text-gray-900">devotees.</span>
        </p>
      </div>


      <div class="flex items-start gap-5">
        <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-gray-800 flex items-center justify-center">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <p class="text-lg text-gray-600">
          You have
          <span class="font-semibold text-gray-900">100% ownership</span>
          of your devotee data. Export anytime. We never contact them.
        </p>
      </div>


      <div class="flex items-start gap-5">
        <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-gray-800 flex items-center justify-center">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <p class="text-lg text-gray-600">
          Mandir committees can
          <span class="font-semibold text-gray-900">create campaigns easily</span>
          for sewa, renovation, festivals, or annadan.
        </p>
      </div>


      <div class="flex items-start gap-5">
        <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-gray-800 flex items-center justify-center">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <p class="text-lg text-gray-600">
          Receive donations
          <span class="font-semibold text-gray-900">directly to your bank account.</span>
          No long delays. No hidden control.
        </p>
      </div>

    </div>
  </div>
</section>

<?php
include "components/footer.php";
?>