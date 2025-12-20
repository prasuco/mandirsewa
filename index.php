<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shyam Mandir</title>

  <!-- Tailwind CSS v4 -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { font-feature-settings: "liga" 1, "kern" 1; }
  </style>
</head>

<body class="bg-neutral-50 text-neutral-900 antialiased">

<!-- ───────────────── HEADER ───────────────── -->
<header class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
  <div class="flex items-center gap-3">
    <div class="w-10 h-10 rounded-full bg-neutral-200"></div>
    <span class="font-semibold tracking-tight">Mandir Sewa</span>
  </div>

  <nav class="text-sm text-neutral-600 flex gap-6">
    <a href="#" class="hover:text-neutral-900">Explore</a>
    <a href="#" class="hover:text-neutral-900">Donate</a>
    <a href="#" class="hover:text-neutral-900">Login</a>
  </nav>
</header>

<!-- ───────────────── HERO / IDENTITY ───────────────── -->
<section class="max-w-6xl mx-auto px-6 pt-20 pb-16">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <!-- Text -->
    <div>
      <p class="text-sm text-neutral-500 mb-4">Verified Mandir</p>

      <h1 class="text-4xl md:text-5xl font-semibold tracking-tight leading-tight">
        Shyam Mandir
      </h1>

      <p class="mt-6 text-neutral-600 max-w-xl leading-relaxed">
        A sacred place of devotion, daily seva, and community service.
        Offering transparent and secure digital donations.
      </p>

      <div class="mt-8 flex gap-4">
        <button class="px-6 py-3 rounded-xl bg-neutral-900 text-white text-sm">
          Donate Now
        </button>
        <button class="px-6 py-3 rounded-xl border border-neutral-300 text-sm">
          About Mandir
        </button>
      </div>
    </div>

    <!-- Visual Placeholder -->
    <div class="h-64 md:h-80 rounded-2xl bg-neutral-200"></div>
  </div>
</section>

<!-- ───────────────── TRUST / META ───────────────── -->
<section class="max-w-6xl mx-auto px-6 pb-20">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

    <div class="p-6 rounded-2xl bg-white border">
      <p class="text-sm text-neutral-500">Devotees</p>
      <p class="text-2xl font-semibold mt-2">12,482</p>
    </div>

    <div class="p-6 rounded-2xl bg-white border">
      <p class="text-sm text-neutral-500">Campaigns</p>
      <p class="text-2xl font-semibold mt-2">8</p>
    </div>

    <div class="p-6 rounded-2xl bg-white border">
      <p class="text-sm text-neutral-500">Total Donations</p>
      <p class="text-2xl font-semibold mt-2">₹5.6L</p>
    </div>

    <div class="p-6 rounded-2xl bg-white border">
      <p class="text-sm text-neutral-500">Status</p>
      <p class="text-2xl font-semibold mt-2">Verified</p>
    </div>

  </div>
</section>

<!-- ───────────────── ABOUT (mandirs.about_content) ───────────────── -->
<section class="max-w-3xl mx-auto px-6 pb-24">
  <h2 class="text-2xl font-semibold tracking-tight mb-6">
    About the Mandir
  </h2>

  <p class="text-neutral-600 leading-relaxed">
    Shyam Mandir has served devotees for generations through daily pooja,
    annadan seva, and festival celebrations. All donations are utilized
    transparently for religious and community welfare activities.
  </p>
</section>

<!-- ───────────────── CAMPAIGNS (campaigns table) ───────────────── -->
<section class="max-w-6xl mx-auto px-6 pb-24">
  <h2 class="text-2xl font-semibold tracking-tight mb-8">
    Active Campaigns
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="p-6 rounded-2xl bg-white border">
      <h3 class="font-medium">Mandir Renovation</h3>
      <p class="text-sm text-neutral-500 mt-2">Target ₹10,00,000</p>
      <button class="mt-6 text-sm underline">Donate</button>
    </div>

    <div class="p-6 rounded-2xl bg-white border">
      <h3 class="font-medium">Daily Annadan Seva</h3>
      <p class="text-sm text-neutral-500 mt-2">Target ₹3,00,000</p>
      <button class="mt-6 text-sm underline">Donate</button>
    </div>

    <div class="p-6 rounded-2xl bg-white border">
      <h3 class="font-medium">Festival Mahotsav</h3>
      <p class="text-sm text-neutral-500 mt-2">Target ₹5,00,000</p>
      <button class="mt-6 text-sm underline">Donate</button>
    </div>

  </div>
</section>

<!-- ───────────────── ANNOUNCEMENTS ───────────────── -->
<section class="max-w-3xl mx-auto px-6 pb-24">
  <h2 class="text-2xl font-semibold tracking-tight mb-6">
    Announcements
  </h2>

  <div class="space-y-4">
    <div class="p-5 rounded-xl bg-white border">
      <p class="font-medium">Mahashivratri Celebration</p>
      <p class="text-sm text-neutral-500 mt-1">
        Special pooja and bhandara on March 8
      </p>
    </div>

    <div class="p-5 rounded-xl bg-white border">
      <p class="font-medium">Temple Timings Update</p>
      <p class="text-sm text-neutral-500 mt-1">
        Morning aarti at 5:30 AM
      </p>
    </div>
  </div>
</section>

<!-- ───────────────── FAQs ───────────────── -->
<section class="max-w-3xl mx-auto px-6 pb-24">
  <h2 class="text-2xl font-semibold tracking-tight mb-6">
    Frequently Asked Questions
  </h2>

  <div class="space-y-4">
    <div class="p-5 rounded-xl bg-white border">
      <p class="font-medium">Is online donation safe?</p>
      <p class="text-sm text-neutral-600 mt-2">
        Yes. All donations are processed securely and transparently.
      </p>
    </div>

    <div class="p-5 rounded-xl bg-white border">
      <p class="font-medium">Do I receive a receipt?</p>
      <p class="text-sm text-neutral-600 mt-2">
        A digital receipt is provided after successful donation.
      </p>
    </div>
  </div>
</section>

<!-- ───────────────── FOOTER ───────────────── -->
<footer class="border-t bg-white">
  <div class="max-w-6xl mx-auto px-6 py-10 flex justify-between text-sm text-neutral-500">
    <p>© 2025 Mandir Sewa</p>
    <p>Digital Devotion, Transparently</p>
  </div>
</footer>

</body>
</html>
