<?
session_start();
unset($_SESSION['user_login']);
unset($_SESSION['ip']);
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;
?>