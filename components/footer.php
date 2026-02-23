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
      <a href="/contact" class="hover:text-gray-900 transition">Contact</a>
      <a href="/ourteam" class="hover:text-gray-900 transition">Our Team</a>
    </div>

    <!-- Right Social Icons -->
    <div class="flex items-center gap-5">
      
      <!-- Facebook -->
      <a href="#" class="text-gray-700 hover:text-blue-600 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.08 5.66 21.13 10.44 22v-6.99H7.9v-2.94h2.54V9.41c0-2.5 1.5-3.87 3.78-3.87 1.09 0 2.23.19 2.23.19v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.77l-.44 2.94h-2.33V22C18.34 21.13 22 17.08 22 12.07z"/>
        </svg>
      </a>

      <!-- YouTube -->
      <a href="#" class="text-gray-700 hover:text-red-600 transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M23.5 6.2s-.2-1.7-.8-2.4c-.8-.9-1.7-.9-2.1-1C17.6 2.5 12 2.5 12 2.5h0s-5.6 0-8.6.3c-.4.1-1.3.1-2.1 1C.7 4.5.5 6.2.5 6.2S.2 8.1.2 10v1.9c0 1.9.3 3.8.3 3.8s.2 1.7.8 2.4c.8.9 1.9.9 2.4 1 1.7.2 7.3.3 7.3.3s5.6 0 8.6-.3c.4-.1 1.3-.1 2.1-1 .6-.7.8-2.4.8-2.4s.3-1.9.3-3.8V10c0-1.9-.3-3.8-.3-3.8zM9.8 14.6V7.8l6.3 3.4-6.3 3.4z"/>
        </svg>
      </a>

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