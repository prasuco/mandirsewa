<?= $_SESSION['message'] ?? "" ?>


<?php if ($showHeaderFooter) { ?>
  <footer class="bg-neutral-100 border-t border-neutral-200 py-6 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">

      <!-- Left -->
      <div class="text-gray-600 text-sm">
        © 2026 Mandir Sewa
      </div>

      <!-- Center Links -->
      <div class="flex items-center gap-8 text-gray-700 text-sm font-medium">
        <a href="/mandirsewa/about.php" class="hover:text-gray-900 transition">About </a>
        <a href="/mandirsewa/ourteam.php" class="hover:text-gray-900 transition">Our Team</a>
      </div>

      <!-- Right Social Icons -->
      <div class="flex items-center gap-2">

        Made with<span class="animate-bounce">❤️</span>in Nepal

      </div>

    </div>
  </footer>
<?php } ?>

</div>
</main>

</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>

<?php unset($_SESSION['message']); ?>