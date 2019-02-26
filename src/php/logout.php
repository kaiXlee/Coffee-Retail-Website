<?php
session_start();
$referer = $_SERVER['HTTP_REFERER'];
if (isset($_SESSION['login'])) {
  session_unset();
  header("Location: $referer");
}
if (!isset($_SESSION['login'])) {
  header("Location: frontPage.php");
}
?>
