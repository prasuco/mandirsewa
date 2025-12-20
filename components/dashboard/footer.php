<?php




?>



</div>
<footer>
    <?= $_SESSION['message'] ?? '' ?>
</footer>

</div>

</body>




<script>
  $(function () {

    function closeSidebar() {
      $('#sidebar').addClass('-translate-x-full');
      $('#sidebarOverlay').addClass('hidden');
    }

    $('#sidebarToggle').on('click', function () {
      $('#sidebar').toggleClass('-translate-x-full');
      $('#sidebarOverlay').toggleClass('hidden');
    });

    $('#sidebarOverlay').on('click', function () {
      closeSidebar();
    });

    $('#userMenuButton').on('click', function (e) {
      e.stopPropagation();
      $('#userMenu').toggleClass('hidden');
    });

    $(document).on('click', function () {
      $('#userMenu').addClass('hidden');
    });

  });
</script>


</html>

<?php unset($_SESSION['message']); ?>