<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php?error=loggued out');
?>