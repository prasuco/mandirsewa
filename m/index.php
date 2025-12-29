<?php
$title = "Mandir Page";
include '../components/header.php';

$mandir_slug = $_GET['mandir'];

$sql = "SELECT * FROM mandirs WHERE slug = '$mandir_slug' LIMIT 1 ";

$mandir = mysqli_query($conn, $sql)->fetch_assoc();

if (!$mandir) {
  die(404);
}

$mandir_id = $mandir['id'];

$sql = "SELECT * FROM `campaigns` WHERE `created_by_mandir`  = $mandir_id";
$campaigns = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `faqs` WHERE `created_by_mandir`  = $mandir_id";
$faqs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

print_r($mandir);
print_r($campaigns);
print_r($faqs);

?>


<section class="">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center gap-6">
      <img
        src="/mandirsewa/<?= $mandir['logo'] ?? "default_mandir_logo.webp" ?>"
        class="w-24 h-24 rounded-2xl bg-white p-4 shadow-md"
        alt="Mandir Logo" />

      <div class="flex-1 space-y-2">
        <div class="flex items-center gap-2">
          <h1 class="text-3xl font-semibold"> <?= $mandir['name'] ?> </h1>
          <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 font-medium">
            Verified
          </span>
        </div>
        <p class="text-sm text-neutral-700 max-w-2xl">
          <?= $mandir['description'] ?>
        </p>
        <div class="flex gap-6 text-sm text-neutral-600 mt-2">
          <span>📍 Lalitpur</span>
          <span>🕉️ Daily Seva</span>
          <span>👥 Community Trust</span>
        </div>
      </div>

      <div class="flex gap-3 mt-4 md:mt-0">
        <a class="text-xs px-3 py-1.5 rounded-md bg-blue-600 text-white shadow-sm">
          Facebook
        </a>
        <a class="text-xs px-3 py-1.5 rounded-md bg-red-500 text-white shadow-sm">
          <i class="fa-solid fa-globe"></i> YouTube
        </a>
      </div>

    </div>
  </div>
</section>

<!-- MAIN CONTENT GRID -->
<main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

  <!-- LEFT CONTENT -->
  <section class="lg:col-span-2 space-y-16">

    <!-- ABOUT -->
    <div class="space-y-3">
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500">
        About the Mandir
      </h2>
      <p class="text-sm leading-relaxed text-neutral-700">
        <?= $mandir['about_content'] ?>
      </p>
    </div>

    <!-- IMAGE GALLERY -->
    <div>
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-4">
        Mandir Images
      </h2>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 1" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 2" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 3" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 4" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 5" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500?t=<?= rand(0, 1000) ?>" alt="Mandir Image 6" />
      </div>
    </div>

    <!-- MAP -->
    <div>
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-3">
        Location
      </h2>
      <div class="h-65 rounded-2xl overflow-hidden shadow-md">
        <iframe
          class="w-full h-full rounded-2xl"
          src="https://maps.google.com/maps?q=<?= $mandir['address_lat'] ?>,<?= $mandir['address_long'] ?>&ie=UTF8&iwloc=&output=embed"
          loading="lazy">
        </iframe>
      </div>
    </div>



    <?php if (count($faqs) > 0) { ?>

      <div class="space-y-3">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-4">
          Frequently Asked Questions
        </h2>

        <?php foreach ($faqs as $faq) { ?>

          <details class="group bg-white rounded-2xl px-5 py-4 shadow-sm">
            <summary class="flex justify-between cursor-pointer text-sm font-medium">
              <?= $faq['question'] ?>
              <span class="group-open:rotate-180 transition">⌄</span>
            </summary>
            <p class="mt-2 text-sm text-neutral-600">
              <?= $faq['answer'] ?>
            </p>
          </details>
        <?php } ?>

      </div>


    <?php } ?>

  </section>

  <!-- RIGHT SIDEBAR -->
  <aside class="space-y-6 ">

    <!-- DONATION CARD -->
    <div class="rounded-2xl p-6 shadow-md bg-white">
      <h3 class="font-semibold text-sm">Support the Mandir</h3>
      <p class="text-xs text-neutral-600 mt-1">
        Your contribution supports daily seva and upkeep.
      </p>

      <form class="mt-4 space-y-3">
        <input
          type="number"
          placeholder="Amount (NPR)"
          class="w-full rounded-xl border border-neutral-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-300 focus:outline-none" />

        <select class="w-full rounded-xl border border-neutral-200 px-3 py-2 text-sm focus:ring-2 focus:ring-rose-300 focus:outline-none">
          <option>Select Payment</option>
          <option>Khalti</option>
          <option>eSewa</option>
          <option>Bank Transfer</option>
        </select>

        <button
          class="w-full py-2 rounded-xl bg-linear-to-r from-orange-500 to-rose-500 text-white text-sm font-medium shadow-sm">
          Donate Now
        </button>
      </form> 
    </div>

    <!-- CONTACT -->
    <div class="rounded-2xl p-6 bg-white shadow-sm text-sm space-y-2">
      <h3 class="font-semibold text-sm">Contact</h3>
      <p class="text-neutral-600">📞 +977 98XXXXXXXX</p>
      <p class="text-neutral-600">📧 info@krishnamandir.org</p>

    </div>

  </aside>

</main>
<?php include "../components/footer.php"; ?>