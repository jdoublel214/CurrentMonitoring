<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

unset($_SESSION['USER_TYPE']);
unset($_SESSION['USERNAME']);
unset($_SESSION['PICTURE']);

session_destroy();

header("Location: index");
?>
