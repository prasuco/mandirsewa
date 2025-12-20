<?php




?>


</div>
</main>

</div>


</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(function() {
        // Sidebar toggle
        $('#sidebarToggle').on('click', function() {
            $('#sidebar').toggleClass('-translate-x-full');
        });

        // User menu toggle
        $('#userMenuButton').on('click', function(e) {
            e.stopPropagation();
            $('#userMenu').toggleClass('hidden');
        });

        // Close user menu on outside click
        $(document).on('click', function() {
            $('#userMenu').addClass('hidden');
        });
    });
</script>

</html>

<?php unset($_SESSION['message']); ?>