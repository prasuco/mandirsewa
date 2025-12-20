<?php
function redirect_if_not_authenticated()
{
    if (!isset($_SESSION['id'])) {
        header("Location: /mandirsewa/login.php");
    }
}


function redirect_if_authenticated()
{
    if (isset($_SESSION['id'])) {
        header("Location: /mandirsewa/dashboard");
    }
}
