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
function redirect_if_no_mandir_selected()
{
    if (isset($_SESSION['current_mandir'])) {
        header("Location: /mandirsewa/dashboard");
    }
}


function get_active_class($request_url, $link)
{
    if (str_contains($request_url, $link)) {
        return "bg-gray-200";
    } else {
        return "hover:bg-gray-100";
    }
}
