<!DOCTYPE html>

<?php
session_start();
?>

<html lang = "en">
<head>
  <title>MY ACCOUNT</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/default.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/account.css">
</head>

<body>
  <?php include 'header.php';?>

  <div class="main">
<!--
    <div class="column welcome">
      <div class="part">
        <?php
        // welcome firstname
        /*if (isset($_SESSION['firstname'])) {
          $firstname = $_SESSION['firstname'];
          echo "<h1> WELCOME  $firstname </h1>";
        }
        else {
          echo "<h1>WELCOME </h1>";
        }*/
        ?>
      </div>
    -->
      <!--
      <div class="part image">
      <figure>
      <img src="" alt="">
    </figure>
    <figcaption>UPLOAD PHOTO</figcaption>
  </div>
-->
</div>

<div class="column account">
  <div class="part">
    <h1>MY ACCOUNT</h1>
  </div>
  <div class="part">
    <a class="acc" href="account.php">ACCOUNT</a>
  </div>
  <div class="part">
    <a class="acc" href="profile.php">PROFILE</a>
  </div>
  <!--
  <div class="part">
    <a href="addressbook.php">ADDRESS BOOK</a>
  </div>
-->
</div>

<div class="column purchase">
  <div class="part">
    <h1>MY PURCHASE</h1>
  </div>
  <div class="part">
    <a class="acc" href="orderhistory.php">ORDER HISTORY</a>
  </div>
</div>
<!--
<div class="wishlist">
<div class="leftbutton">
<a class="bl" href="#" class="previous round">&#8249;</a>
</div>
<div class="list">
<div class="listblock">

</div>
<div class="listblock">

</div>
<div class="listblock">

</div>
<div class="listblock">

</div>

</div>
<div class="rightbutton">
<a class="br" href="#" class="next round">&#8250;</a>
</div>

</div> -->
<!-- company names / copyright / info etc etc -->

</div>


<?php include 'footer.php';?>
<img class="accountbg" src="../images/bg/accountbg.jpg" alt="">

</body>
</html>
