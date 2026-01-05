<?php
session_start();
session_destroy();
header("Location: /mandirsewa/login.php");
