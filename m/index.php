<?php
$title = "Mandir Page";
include '../components/header.php';

$mandir_slug = $_GET['mandir'];

$sql = "SELECT * FROM mandirs WHERE slug = '$mandir_slug' LIMIT 1";
$mandir = mysqli_query($conn, $sql)->fetch_assoc();

if (!$mandir) die(404);

$mandir_id = $mandir['id'];

$sql = "SELECT * FROM `campaigns` WHERE `created_by_mandir` = $mandir_id AND `type` = 'campaign'";
$campaigns = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

foreach ($campaigns as &$campaign) {
  $cid = $campaign['id'];
  $sql_raised = "SELECT COALESCE(SUM(amount_paid), 0) as raised FROM `donations` WHERE `campaign_id` = $cid";
  $result = mysqli_query($conn, $sql_raised)->fetch_assoc();
  $campaign['raised'] = $result['raised'] ?? 0;
  $campaign['percent'] = ($campaign['target_amount'] > 0)
    ? min(100, round(($campaign['raised'] / $campaign['target_amount']) * 100))
    : 0;
}
unset($campaign);

$sql = "SELECT * FROM `faqs` WHERE `created_by_mandir` = $mandir_id";
$faqs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `campaigns` WHERE `created_by_mandir` = $mandir_id AND `type` = 'event'";
$events = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `images` WHERE `mandir_id` = $mandir_id";
$mandir_images = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$now = date('Y-m-d H:i:s');
$sql = "SELECT * FROM `announcements` WHERE `created_by_mandir` = $mandir_id AND start_date <= '$now' AND end_date >= '$now' ORDER BY id DESC";
$active_announcements = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
?>


<!-- ======== MODALS ======== -->

<?php foreach ($active_announcements as $announcement): ?>
  <div id="announcementModal<?= $announcement['id'] ?>" class="modal bg-white max-w-lg!">
    <?php if ($announcement['image']): ?>
      <img src="/mandirsewa/<?= $announcement['image'] ?>" alt="<?= $announcement['title'] ?>" class="w-full h-48 object-cover">
    <?php endif; ?>
    <div class="p-6 space-y-3">
      <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary uppercase tracking-wide">
        <i class="fas fa-bullhorn"></i> Announcement
      </span>
      <h3 class="text-xl font-bold text-gray-900"><?= $announcement['title'] ?></h3>
      <p class="text-sm text-gray-600 leading-relaxed"><?= $announcement['description'] ?></p>
      <p class="text-xs text-gray-400 pt-3 border-t border-gray-100">
        <i class="fas fa-calendar-alt mr-1"></i> Valid until <?= date('M d, Y', strtotime($announcement['end_date'])) ?>
      </p>
    </div>
  </div>
<?php endforeach; ?>

<script>
  <?php foreach ($active_announcements as $announcement): ?>
    $('#announcementModal<?= $announcement['id'] ?>').modal({
      closeExisting: false,
      fadeDuration: 100
    });
  <?php endforeach; ?>
</script>

<?php foreach ($campaigns as $campaign): ?>
  <div id="campaignModal<?= $campaign['id'] ?>" class="modal bg-white max-w-lg!">
    <div class="p-6 space-y-4">
      <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary uppercase tracking-wide">
        <i class="fas fa-hand-holding-heart"></i> Campaign
      </span>
      <h3 class="text-xl font-bold text-gray-900"><?= $campaign['name'] ?></h3>
      <p class="text-sm text-gray-600 leading-relaxed"><?= $campaign['description'] ?></p>
      <?php if ($campaign['content']): ?>
        <div class="text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"><?= $campaign['content'] ?></div>
      <?php endif; ?>
      <?php if ($campaign['target_amount']): ?>
        <div class="bg-gray-50 rounded-xl p-4 space-y-2">
          <div class="flex justify-between items-baseline">
            <span class="text-sm font-semibold text-gray-900">NPR <?= number_format($campaign['raised']) ?> <span class="text-xs font-normal text-gray-400">raised</span></span>
            <span class="text-sm font-bold text-primary"><?= $campaign['percent'] ?>%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-primary h-2 rounded-full" style="width: <?= $campaign['percent'] ?>%"></div>
          </div>
          <p class="text-xs text-gray-400">Goal: NPR <?= number_format($campaign['target_amount']) ?></p>
        </div>
      <?php endif; ?>
      <div class="space-y-3 pt-1">
        <input type="number" id="campaign_amount_<?= $campaign['id'] ?>" placeholder="Enter amount (NPR)" class="w-full form-input" />
        <button onclick="donateToCampaign(<?= $campaign['id'] ?>)" class="w-full btn-primary">Donate Now</button>
        <p class="text-xs text-gray-400 text-center"><i class="fas fa-shield-alt mr-1"></i>Secure payment via eSewa</p>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($events as $event): ?>
  <div id="eventModal<?= $event['id'] ?>" class="modal bg-white max-w-lg!">
    <div class="p-6 space-y-4">
      <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-secondary uppercase tracking-wide">
        <i class="fas fa-calendar-alt"></i> Upcoming Event
      </span>
      <h3 class="text-xl font-bold text-gray-900"><?= $event['name'] ?></h3>
      <p class="text-sm text-gray-600 leading-relaxed"><?= $event['description'] ?></p>
      <?php if ($event['content']): ?>
        <div class="text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4"><?= $event['content'] ?></div>
      <?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>


<!-- ======== HERO ======== -->
<section class="bg-gray-50 border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-6 py-16 text-center space-y-6">
    <div class="relative inline-flex">
      <img
        src="/mandirsewa/<?= $mandir['logo'] ?? 'default_mandir_logo.webp' ?>"
        class="w-28 h-28 rounded-full border-4 border-white shadow-md"
        alt="<?= $mandir['name'] ?>" />
      <span class="absolute bottom-1 right-1 text-green-500 bg-white rounded-full text-lg leading-none shadow-sm">
        <i class="fas fa-check-circle"></i>
      </span>
    </div>

    <div>
      <h1 class="text-4xl font-bold text-gray-900"><?= $mandir['name'] ?></h1>
      <p class="mt-3 text-gray-500 max-w-2xl mx-auto leading-relaxed"><?= $mandir['description'] ?></p>
    </div>

    <div class="flex items-center justify-center gap-2 flex-wrap">
      <?php if ($mandir['facebook']): ?>
        <a href="<?= $mandir['facebook'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
          <i class="fab fa-facebook-f mr-2"></i>Facebook
        </a>
      <?php endif; ?>
      <?php if ($mandir['youtube']): ?>
        <a href="<?= $mandir['youtube'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
          <i class="fab fa-youtube mr-2"></i>YouTube
        </a>
      <?php endif; ?>
      <?php if ($mandir['website']): ?>
        <a href="<?= $mandir['website'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-white transition">
          <i class="fas fa-external-link-alt mr-2"></i>Website
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- ======== MAIN CONTENT ======== -->
<main class="max-w-7xl mx-auto px-6 py-14 space-y-20">

  <!-- ABOUT + FAQ -->
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

    <div class="space-y-5">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
          <i class="fas fa-om text-white text-sm"></i>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-900">About the Mandir</h2>
          <p class="text-xs text-gray-400">History, traditions & spiritual significance</p>
        </div>
      </div>
      <div class="prose prose-sm text-gray-600 leading-relaxed wrap-anywhere">
        <?= $mandir['about_content'] ?>
      </div>
    </div>

    <?php if (!empty($faqs)): ?>
      <div class="space-y-5">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-lg bg-secondary flex items-center justify-center shrink-0">
            <i class="fas fa-question text-white text-sm"></i>
          </div>
          <div>
            <h2 class="text-xl font-bold text-gray-900">Frequently Asked Questions</h2>
            <p class="text-xs text-gray-400">Quick answers to common questions</p>
          </div>
        </div>
        <div class="space-y-2">
          <?php foreach ($faqs as $faq): ?>
            <details class="group border border-gray-200 rounded-xl overflow-hidden bg-white">
              <summary class="flex items-center justify-between px-5 py-3.5 cursor-pointer list-none hover:bg-gray-50 transition-colors">
                <span class="text-sm font-medium text-gray-800"><?= $faq['question'] ?></span>
                <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition-transform duration-200 shrink-0 ml-3"></i>
              </summary>
              <div class="px-5 pb-4 pt-3 text-sm text-gray-500 leading-relaxed border-t border-gray-100">
                <?= $faq['answer'] ?>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

  </section>


  <!-- GALLERY -->
  <?php if (count($mandir_images) > 0): ?>
    <section class="space-y-6">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
          <i class="fas fa-images text-white text-sm"></i>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-900">Sacred Gallery</h2>
          <p class="text-xs text-gray-400">Moments from our temple</p>
        </div>
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        <?php foreach ($mandir_images as $image): ?>
          <div class="relative group overflow-hidden rounded-xl aspect-square shadow-sm">
            <img
              src="/mandirsewa/<?= $image['url'] ?>"
              alt="<?= $image['image_name'] ?>"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
              <p class="text-white text-xs font-medium p-3"><?= $image['image_name'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>


  <!-- CAMPAIGNS -->
  <?php if (count($campaigns) > 0): ?>
    <section class="space-y-6">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
          <i class="fas fa-hand-holding-heart text-white text-sm"></i>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-900">Campaigns</h2>
          <p class="text-xs text-gray-400">Support our ongoing initiatives</p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php foreach ($campaigns as $campaign): ?>
          <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col hover:shadow-lg transition-shadow duration-300">
            <div class="px-5 pt-5 pb-4 flex flex-col flex-1 gap-3">
              <h3 class="text-base font-bold text-gray-900 leading-snug"><?= $campaign['name'] ?></h3>
              <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed flex-1"><?= $campaign['description'] ?></p>

              <?php if ($campaign['target_amount']): ?>
                <div class="space-y-1.5">
                  <div class="flex justify-between items-baseline text-xs">
                    <span class="text-gray-500 font-medium">NPR <?= number_format($campaign['raised']) ?> raised</span>
                    <span class="font-bold text-primary"><?= $campaign['percent'] ?>%</span>
                  </div>
                  <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-primary h-1.5 rounded-full transition-all" style="width: <?= $campaign['percent'] ?>%"></div>
                  </div>
                  <p class="text-xs text-gray-400">Goal: NPR <?= number_format($campaign['target_amount']) ?></p>
                </div>
              <?php endif; ?>
            </div>
            <div class="px-5 pb-5">
              <a href="#campaignModal<?= $campaign['id'] ?>" rel="modal:open" class="btn-primary w-full text-center text-sm">
                Donate Now
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>


  <!-- EVENTS -->
  <?php if (count($events) > 0): ?>
    <section class="space-y-6">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-secondary flex items-center justify-center shrink-0">
          <i class="fas fa-calendar-alt text-white text-sm"></i>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-900">Upcoming Events</h2>
          <p class="text-xs text-gray-400">Special celebrations & gatherings</p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <?php foreach ($events as $event): ?>
          <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-start gap-4 hover:shadow-lg transition-shadow duration-300">
            <div class="shrink-0 w-11 h-11 rounded-xl bg-secondary/15 flex items-center justify-center">
              <i class="fas fa-calendar-alt text-secondary"></i>
            </div>
            <div class="flex-1 min-w-0 space-y-1.5">
              <h3 class="text-base font-bold text-gray-900"><?= $event['name'] ?></h3>
              <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed"><?= $event['description'] ?></p>
              <a href="#eventModal<?= $event['id'] ?>" rel="modal:open"
                class="inline-flex items-center gap-1.5 text-sm font-semibold text-secondary hover:underline pt-1">
                View Details <i class="fas fa-arrow-right text-xs"></i>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>


  <!-- LOCATION & CONTACT -->
  <section class="space-y-6">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
        <i class="fas fa-map-marker-alt text-white text-sm"></i>
      </div>
      <div>
        <h2 class="text-xl font-bold text-gray-900">Visit Us</h2>
        <p class="text-xs text-gray-400">Find us & get in touch</p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
      <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
        <h3 class="text-sm font-semibold text-gray-700">Contact</h3>
        <div class="space-y-4">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
              <i class="fas fa-phone text-primary text-sm"></i>
            </div>
            <div>
              <p class="text-xs text-gray-400 font-medium">Primary Contact</p>
              <p class="text-sm font-semibold text-gray-800"><?= $mandir['primary_contact'] ?></p>
            </div>
          </div>
          <?php if ($mandir['secondary_contact']): ?>
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <i class="fas fa-phone text-primary text-sm"></i>
              </div>
              <div>
                <p class="text-xs text-gray-400 font-medium">Secondary Contact</p>
                <p class="text-sm font-semibold text-gray-800"><?= $mandir['secondary_contact'] ?></p>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="h-64 lg:h-auto rounded-2xl overflow-hidden border border-gray-200 shadow-sm min-h-56">
        <iframe
          class="w-full h-full"
          src="https://maps.google.com/maps?q=<?= $mandir['address_lat'] ?>,<?= $mandir['address_long'] ?>&ie=UTF8&iwloc=&output=embed"
          loading="lazy"
          style="border:0;"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </section>

</main>


<!-- DONATION MODAL -->
<div id="donationModal" class="modal bg-white max-w-xl!">
  <div class="p-2 space-y-4">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shrink-0">
        <i class="fas fa-donate"></i>
      </div>
      <div>
        <h3 class="text-base font-bold text-gray-900">Support the Mandir</h3>
        <p class="text-xs text-gray-400">Your donation supports daily seva</p>
      </div>
    </div>
    <input type="number" id="amount_input" placeholder="Amount (NPR)" class="w-full form-input" />
    <button id="donate_btn" class="w-full btn-primary">Donate Now</button>
    <p class="text-xs text-gray-400 text-center"><i class="fas fa-shield-alt mr-1"></i>Secure payment via eSewa</p>
  </div>
</div>


<!-- FLOATING DONATE BUTTON -->
<a href="#donationModal" rel="modal:open"
  class="fixed bottom-6 right-6 inline-flex items-center gap-2 px-5 py-3 bg-secondary text-white text-sm font-semibold rounded-full shadow-lg hover:shadow-xl transition-shadow animate-bounce">
  <i class="fas fa-donate"></i> Donate Now
</a>


<script src="/mandirsewa/public/js/easy-sewa.js"></script>
<script>
  let easySewa = new EasySewa.EasySewa({
    environment: "development",
    failure_url: "http://localhost/mandirsewa/failure",
    success_url: "http://localhost/mandirsewa/success",
    product_code: "EPAYTEST",
    secret: "8gBm/:&EnhH.1/q"
  });

  function donateToCampaign(campaignId) {
    let amount = $("#campaign_amount_" + campaignId).val();
    if (!amount) {
      alert("Please enter an amount");
      return;
    }
    $.ajax({
      url: "/mandirsewa/ajax/initiate-esewa.php",
      type: "POST",
      dataType: "json",
      data: {
        amount_paid: amount,
        campaign_id: campaignId,
        mandir_id: "<?= $mandir['id'] ?>"
      },
      success: function(res) {
        if (!res.success) {
          alert("Failed to initiate donation");
          return;
        }
        easySewa.pay({
          amount: Number(amount),
          transaction_uuid: res.transaction_uuid
        });
      },
      error: function() {
        alert("Server error");
      }
    });
  }

  $("#donate_btn").click(() => {
    let amount = $("#amount_input").val();
    if (!amount) return;
    $.ajax({
      url: "/mandirsewa/ajax/initiate-esewa.php",
      type: "POST",
      dataType: "json",
      data: {
        amount_paid: amount,
        mandir_id: "<?= $mandir['id'] ?>"
      },
      success: function(res) {
        if (!res.success) {
          alert("Failed to initiate donation");
          return;
        }
        easySewa.pay({
          amount: Number(amount),
          transaction_uuid: res.transaction_uuid
        });
      },
      error: function() {
        alert("Server error");
      }
    });
  });
</script>

<?php include "../components/footer.php"; ?>