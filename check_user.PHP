<?php
if (isset($_SESSION) && !isset($_SESSION['user_id'])) {
            header('Location: login-register.php');
        } else {
        	header('Location: post_ad.php');
        }
?>