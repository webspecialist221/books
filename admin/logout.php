<?php
require_once("includes/includes.php");
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['full_name']);
unset($_SESSION['role_id']);
unset($_SESSION['role_name']);

header("location: ". base_url("login-register.php?action=login"));
?>
