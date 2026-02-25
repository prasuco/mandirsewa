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

$sql = "SELECT * FROM `campaigns` WHERE `created_by_mandir` = $mandir_id AND `type` = 'campaign'";
$campaigns = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `faqs` WHERE `created_by_mandir` = $mandir_id";
$faqs = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `campaigns` WHERE `created_by_mandir` = $mandir_id AND `type` = 'event'";
$events = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `images` WHERE `mandir_id` = $mandir_id";
$mandir_images = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$now = date('Y-m-d H:i:s');
$sql = "SELECT * FROM `announcements` WHERE `created_by_mandir` = $mandir_id AND start_date <= '$now' AND end_date >= '$now' ORDER BY id DESC";
$active_announcements = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `announcements` WHERE `created_by_mandir` = $mandir_id ORDER BY id DESC LIMIT 5";
$all_announcements = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);

?>


<!-- HERO SECTION -->
<section class="bg-gray-50 ">
  <!-- announcement modals -->
  <?php foreach ($active_announcements as  $announcement) { ?>
    <div id="announcementModal<?= $announcement['id'] ?>" class="modal bg-white max-w-lg! ">
      <?php if ($announcement['image']) { ?>
        <img src="/mandirsewa/<?= $announcement['image'] ?>" alt="<?= $announcement['title'] ?>" class="w-full h-48 object-cover">
      <?php } ?>
      <div class="p-6">
        <div class="flex items-center justify-between mb-3">
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary text-white">
            <i class="fas fa-bullhorn mr-1"></i> Announcement
          </span>

        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3"><?= $announcement['title'] ?></h3>
        <p class="text-gray-600 leading-relaxed"><?= $announcement['description'] ?></p>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <p class="text-xs text-gray-400">
            <i class="fas fa-calendar-alt mr-1"></i>
            Valid until <?= date('M d, Y', strtotime($announcement['end_date'])) ?>
          </p>
        </div>
      </div>
    </div>
  <?php } ?>

  <script>
    <?php foreach ($active_announcements as $announcement) {
    ?>
      $('#announcementModal<?= $announcement['id'] ?>').modal({
        closeExisting: false,
        fadeDuration: 100
      });
    <?php } ?>
  </script>

  <!-- CAMPAIGN MODALS -->
  <?php foreach ($campaigns as $campaign): ?>
    <div id="campaignModal<?= $campaign['id'] ?>" class="modal bg-white max-w-lg! ">
      <div class="p-2 space-y-4">
        <div class="flex items-center justify-between">
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary text-white">
            <?= ucfirst($campaign['type']) ?>
          </span>

        </div>

        <h3 class="text-xl font-bold text-gray-900"><?= $campaign['name'] ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed"><?= $campaign['description'] ?></p>

        <?php if ($campaign['content']): ?>
          <div class="text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
            <?= $campaign['content'] ?>
          </div>
        <?php endif; ?>

        <?php if ($campaign['target_amount']): ?>
          <div class="bg-gray-50 rounded-lg p-4 space-y-2">
            <div class="flex justify-between text-sm">
              <span class="text-gray-500">Target Amount</span>
              <span class="font-bold text-gray-900">NPR <?= number_format($campaign['target_amount']) ?></span>
            </div>
          </div>
        <?php endif; ?>

        <div class="bg-primary/5 rounded-lg p-4 space-y-3 border-t border-gray-100 pt-4">
          <h4 class="text-sm font-semibold text-gray-800">Support this Campaign</h4>
          <input
            type="number"
            id="campaign_amount_<?= $campaign['id'] ?>"
            placeholder="Enter amount (NPR)"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary" />
          <button
            onclick="donateToCampaign(<?= $campaign['id'] ?>)"
            class="w-full btn-primary">
            Donate Now
          </button>
          <p class="text-xs text-gray-400 text-center">
            <i class="fas fa-shield-alt mr-1"></i>
            Secure payment via eSewa
          </p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <div class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center space-y-8">
      <div class="inline-flex items-center justify-center ">
        <img
          src="/mandirsewa/<?= $mandir['logo'] ?? "default_mandir_logo.webp" ?>"
          class="w-32 h-32 rounded-full shadow-lg border-4 border-white"
          alt="<?= $mandir['name'] ?>" />
        <span class="inline-flex relative top-10   right-4   items-center p-1 rounded-full  text-green-700 text-lg font-medium">
          <i class="fas fa-check-circle "></i>

        </span>
      </div>

      <div class="space-y-4">
        <h1 class="text-5xl font-bold text-gray-900"><?= $mandir['name'] ?></h1>

        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
          <?= $mandir['description'] ?>
        </p>
      </div>

      <div class="flex items-center justify-center gap-4">
        <?php if ($mandir['facebook']): ?>
          <a href="<?= $mandir['facebook'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fab fa-facebook-f mr-2"></i>
            Facebook
          </a>
        <?php endif; ?>

        <?php if ($mandir['youtube']): ?>
          <a href="<?= $mandir['youtube'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
            <i class="fab fa-youtube mr-2"></i>
            YouTube
          </a>
        <?php endif; ?>

        <?php if ($mandir['website']): ?>
          <a href="<?= $mandir['website'] ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i class="fas fa-external-link-alt mr-2"></i>
            Website
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-12 space-y-20">

  <!-- ABOUT SECTION -->
  <section class="space-y-8">
    <div class="space-y-3">
      <h2 class="text-2xl font-bold text-gray-900">
        About the Mandir
      </h2>
      <p class="text-gray-500 max-w-md">
        Learn about our history, traditions, and spiritual significance
      </p>
    </div>
    <div class="prose prose-sm wrap-anywhere text-gray-700 leading-relaxed">
      <?= $mandir['about_content'] ?>
  </div>
</section>


<!-- IMAGE GALLERY -->
  <?php if (count($mandir_images) > 0): ?>
    <section class="space-y-8">
      <div class="space-y-3">
        <h2 class="text-2xl font-bold text-gray-900">
          Sacred Gallery
        </h2>
        <p class="text-gray-500 max-w-xl">
          Explore the divine beauty and spiritual moments captured at our temple
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($mandir_images as $image): ?>
          <div class="relative group overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
            <img
              src="/mandirsewa/<?= $image['url'] ?>"
              alt="<?= $image['image_name'] ?>"
              class="w-full h-72 object-cover  transition-transform duration-500" />
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
              <p class="text-white text-sm font-medium p-4 w-full bg-linear-to-t from-black/50 to-transparent"><?= $image['image_name'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- CAMPAIGNS & EVENTS SECTION -->
  <?php if (count($campaigns) > 0): ?>
    <section class="space-y-8">
      <div class="space-y-3">
        <h2 class="text-2xl font-bold text-gray-900">
          Current Campaigns
        </h2>
        <p class="text-gray-500 max-w-md">
          Support our ongoing initiatives and help make a difference
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($campaigns as $campaign): ?>
          <div class="relative group bg-white  rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
            <div class="top-2  right-2 absolute bg-gray-200 p-1    rounded-full ">

              <i class="fas fa-calendar group-hover:rotate-12 duration-500   text-secondary   text-xl"></i>
            </div>
            <div class="p-6 space-y-4">
              <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                  <?= ucfirst($campaign['type']) ?>
                </span>
              </div>

              <h3 class="text-xl font-semibold text-gray-900"><?= $campaign['name'] ?></h3>
              <p class="text-gray-600 text-sm line-clamp-3"><?= $campaign['description'] ?></p>

              <?php if ($campaign['target_amount'] && $campaign['type'] == 'campaign'): ?>
                <div class="space-y-2">
                  <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Target</span>
                    <span class="font-semibold text-gray-900">NPR <?= number_format($campaign['target_amount']) ?></span>
                  </div>
                </div>
              <?php endif; ?>

              <div class="pt-4 border-t border-gray-100">
                <a href="#campaignModal<?= $campaign['id'] ?>" rel="modal:open" class="w-full btn-primary inline-block text-center">
                  Learn More
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- UPCOMING EVENTS -->
  <?php if (count($events) > 0): ?>
    <section class="space-y-8">
      <div class="space-y-3">
        <h2 class="text-2xl font-bold text-gray-900">
          Upcoming Events
        </h2>
        <p class="text-gray-500 max-w-md">
          Join us for special celebrations and spiritual gatherings
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($events as $event): ?>
          <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
            <div class="flex items-start space-x-4">
              <div class="shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                <i class="fas fa-calendar text-secondary opacity-70"></i>
              </div>

              <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900"><?= $event['name'] ?></h3>
                <p class="text-gray-600 text-sm mt-1"><?= $event['description'] ?></p>
                <div class="mt-4">
                  <button class="btn-primary btn-sm">
                    Details
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>


  <!-- LOCATION & CONTACT -->
  <section class="space-y-8">
    <div class="space-y-3">
      <h2 class="text-2xl font-bold text-gray-900">
        Visit Us
      </h2>
      <p class="text-gray-500 max-w-md">
        Find our location and get in touch with our temple community
      </p>
    </div>

    <div class="flex flex-row justify-between gap-4">
      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-900">Get in Touch</h3>

        <div class="space-y-4">
          <div class="flex items-center  space-x-3">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
              <i class="fas fa-phone text-gray-600"></i>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900">Primary Contact</p>
              <p class="text-sm text-gray-600"><?= $mandir['primary_contact'] ?></p>
            </div>
          </div>

          <?php if ($mandir['secondary_contact']): ?>
            <div class="flex items-center flex-row space-x-3">
              <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-phone text-gray-600"></i>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-900">Secondary Contact</p>
                <p class="text-sm text-gray-600"><?= $mandir['secondary_contact'] ?></p>
              </div>
            </div>
          <?php endif; ?>

        
        </div>
      </div>

      <div class="space-y-4 flex-1">

        <div class="h-64 rounded-2xl overflow-hidden shadow-lg">
          <iframe
            class="w-full h-full"
            src="https://maps.google.com/maps?q=<?= $mandir['address_lat'] ?>,<?= $mandir['address_long'] ?>&ie=UTF8&iwloc=&output=embed"
            loading="lazy"
            style="border:0;"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </section>


</main>


<!-- Donation Modal -->
<div id="donationModal" class="modal bg-gray-50! rounded-2xl p-6 text-black shadow-lg max-w-md mx-auto">
  <!-- Icon + Title -->
  <div class="text-center space-y-4">
    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center mx-auto text-white">
      <i class="fas fa-donate text-xl"></i>
    </div>

    <div>
      <h3 class="text-xl font-bold">Support the Mandir</h3>
      <p class="text-gray-700 text-sm mt-1">
        Your contribution supports daily seva and temple maintenance
      </p>
    </div>
  </div>

  <!-- Input + Button -->
  <div class="mt-6 space-y-4">
    <input
      type="number"
      id="amount_input"
      placeholder="Amount (NPR)"
      class="w-full form-input"
    />

    <button
      id="donate_btn"
      class="w-full btn btn-primary">
      Donate Now
    </button>

 
  </div>
</div>

<!-- donate now button -->
<a href="#donationModal" rel="modal:open" class="animate-bounce  bottom-6 right-6 text-center flex items-center justify-center fixed   px-3 py-2 bg-secondary text-white rounded-full">
  <p>
  Donate Now
  </p>
</a>



<!-- for easy-sewa package -->
<script src="/mandirsewa/public/js/easy-sewa.js"></script>

<script>
  let easySewa = new EasySewa.EasySewa({
    environment: "development",
    failure_url: "http://localhost/mandirsewa/failure",
    success_url: "http://localhost/mandirsewa/success",
    product_code: "EPAYTEST",
    secret: "8gBm/:&EnhH.1/q"
  })


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
</script>

<script>
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

        // use transaction_uuid generated by backend
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