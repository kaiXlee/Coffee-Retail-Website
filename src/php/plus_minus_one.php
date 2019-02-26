<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=="POST") {
  //button is clicked, judge which button
  if (isset($_POST['plus'])) {
    $pid = $_POST['plus'];//

    if (isset(($_SESSION['productList']))) {
      // get quantity form id
      $productList = $_SESSION['productList'];
      $productList[$pid]['quantity'] = $productList[$pid]['quantity'] + 1;
      $_SESSION['productList'] = $productList;
      header("Location: showcart.php");
    }
  }

  if (isset($_POST['minus'])) {
    $pid = $_POST['minus'];//

    if (isset(($_SESSION['productList']))) {
      // get quantity form id
      $productList = $_SESSION['productList'];
      $productList[$pid]['quantity'] = $productList[$pid]['quantity'] - 1;
      if ($productList[$pid]['quantity'] == 0) {
        unset($productList[$pid]);
      }
      $_SESSION['productList'] = $productList;
      header("Location: showcart.php");
  }
  }
  if (isset($_POST['delete'])) {
    $pid = $_POST['delete'];//

    if (isset(($_SESSION['productList']))) {
      // get quantity form id
      $productList = $_SESSION['productList'];
      $productList[$pid]['quantity'] = 0;
      if ($productList[$pid]['quantity'] == 0) {
        unset($productList[$pid]);
      }
      $_SESSION['productList'] = $productList;
      header("Location: showcart.php");
  }
  }
  else {
    echo "wrong button";
  }

}
else {
  echo "wrong request method";
}
?>
