<?php
include 'config.php'; // Untuk session_start()
session_destroy();
header('Location: login.php');
exit;
?>