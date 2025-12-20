<?php
$title = "Mandir Page";
include '../components/header.php';
?>


<section class="bg-linear-to-b from-orange-50 to-white">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center gap-6">

      <img
        src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Om_symbol.svg"
        class="w-24 h-24 rounded-2xl bg-white p-4 shadow-md"
        alt="Mandir Logo"
      />

      <div class="flex-1 space-y-2">
        <div class="flex items-center gap-2">
          <h1 class="text-3xl font-semibold">Shri Krishna Mandir</h1>
          <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 font-medium">
            Verified
          </span>
        </div>
        <p class="text-sm text-neutral-700 max-w-2xl">
          A historic Vaishnav mandir serving devotees through daily pooja,
          bhajan-kirtan, and community seva.
        </p>
        <div class="flex gap-6 text-sm text-neutral-600 mt-2">
          <span>📍 Lalitpur</span>
          <span>🕉️ Daily Seva</span>
          <span>👥 Community Trust</span>
        </div>
      </div>

      <div class="flex gap-3 mt-4 md:mt-0">
        <button class="px-5 py-2 rounded-lg bg-orange-500 text-white text-sm shadow">
          Donate
        </button>
        <button class="px-5 py-2 rounded-lg bg-white text-sm shadow">
          Contact
        </button>
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
        Established over a century ago, Shri Krishna Mandir has been a spiritual
        center for generations. The mandir conducts daily rituals, seasonal
        festivals, and charitable activities with full transparency and devotion.
      </p>
    </div>

    <!-- IMAGE GALLERY -->
    <div>
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-4">
        Mandir Images
      </h2>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 1" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 2" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 3" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 4" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 5" />
        <img class="w-full h-36 object-cover rounded-2xl shadow" src="https://picsum.photos/500" alt="Mandir Image 6" />
      </div>
    </div>

    <!-- MAP -->
    <div>
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-3">
        Location
      </h2>
      <div class="h-[260px] rounded-2xl overflow-hidden shadow-md">
        <iframe
          class="w-full h-full rounded-2xl"
          src="https://maps.google.com/maps?q=Lalitpur&t=&z=14&ie=UTF8&iwloc=&output=embed"
          loading="lazy">
        </iframe>
      </div>
    </div>

    <!-- FAQ -->
    <div class="space-y-3">
      <h2 class="text-sm font-semibold uppercase tracking-wide text-neutral-500 mb-4">
        Frequently Asked Questions
      </h2>

      <details class="group bg-white rounded-2xl px-5 py-4 shadow-sm">
        <summary class="flex justify-between cursor-pointer text-sm font-medium">
          Is online donation secure?
          <span class="group-open:rotate-180 transition">⌄</span>
        </summary>
        <p class="mt-2 text-sm text-neutral-600">
          Yes. Donations are processed via verified payment partners.
        </p>
      </details>

      <details class="group bg-white rounded-2xl px-5 py-4 shadow-sm">
        <summary class="flex justify-between cursor-pointer text-sm font-medium">
          Will I receive a receipt?
          <span class="group-open:rotate-180 transition">⌄</span>
        </summary>
        <p class="mt-2 text-sm text-neutral-600">
          A digital receipt is sent immediately after payment.
        </p>
      </details>
    </div>

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
          class="w-full rounded-xl border border-neutral-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-300 focus:outline-none"
        />

        <select class="w-full rounded-xl border border-neutral-200 px-3 py-2 text-sm focus:ring-2 focus:ring-rose-300 focus:outline-none">
          <option>Select Payment</option>
          <option>Khalti</option>
          <option>eSewa</option>
          <option>Bank Transfer</option>
        </select>

        <button
          class="w-full py-2 rounded-xl bg-gradient-to-r from-orange-500 to-rose-500 text-white text-sm font-medium shadow-sm">
          Donate Now
        </button>
      </form>
    </div>

    <!-- CONTACT -->
    <div class="rounded-2xl p-6 bg-white shadow-sm text-sm space-y-2">
      <h3 class="font-semibold text-sm">Contact</h3>
      <p class="text-neutral-600">📞 +977 98XXXXXXXX</p>
      <p class="text-neutral-600">📧 info@krishnamandir.org</p>

      <div class="flex gap-2 pt-2">
        <a class="text-xs px-3 py-1.5 rounded-md bg-blue-600 text-white shadow-sm">
          Facebook
        </a>
        <a class="text-xs px-3 py-1.5 rounded-md bg-red-500 text-white shadow-sm">
          YouTube
        </a>
      </div>
    </div>

  </aside>

</main>

<!-- FOOTER -->
<footer class="bg-white">
  <div class="max-w-7xl mx-auto px-6 py-6 text-xs text-neutral-500 flex justify-between">
    <span>© 2025 Mandir Sewa</span>
    <span>Built for Devotion</span>
  </div>
</footer>

<?php
include "../components/footer.php";
?>