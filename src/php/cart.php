<!DOCTYPE html>
<html lang = "en">
<head>
  <title>Shopping Cart</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/cart.css">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
</head>

<body>
  <?php include 'header.php';?>

<div class="mainbody">
  <!-- Title -->
  <div class="carttitle">
    <p class="titlecontent">Shopping Cart</p>
    <button type="button" name="button"><a class="checkout" href = "checkout.php">Check Out</a></button>
  </div>

  <!-- Product #1 -->
  <div class="item">
    <div class="col buttons">
      <button type="delete" name="button">
        <img src="../images/sign/delete.png" width="20em" height="20em">
      </button>
    </div>
    <div class="col checkboxdiv">
      <input class="checkbox" type="checkbox">
    </div>

    <div class="col image">
      <img src="../images/coffee/americano.jpg" alt="item1" / width="80em" height="80em">
    </div>

    <div class="col description">
      Americano
    </div>

    <div class="col quantity">
      <button class="plus-btn" type="button" name="button">
         <img src="../images/sign/plus.png" width="15em" height="15em">
      </button>
      <input type="text" name="name" value="1">
      <button class="minus-btn" type="button" name="button">
         <img src="../images/sign/minus.png" width="15em" height="15em">
      </button>
    </div>

    <div class="col total-price">$2.50</div>
  </div>

  <!-- Product #2 -->
  <div class="item">
    <div class="col buttons">
      <button type="delete" name="button">
        <img src="../images/sign/delete.png" width="20em" height="20em">
      </button>
    </div>
    <div class="col checkboxdiv">
      <input class="checkbox" type="checkbox">
    </div>

    <div class="col image">
      <img src="../images/tea/chai.jpg" alt="item2" / width="80em" height="80em">
    </div>

    <div class="col description">
      chai
    </div>

    <div class="col quantity">
      <button class="plus-btn" type="button" name="button">
         <img src="../images/sign/plus.png" width="15em" height="15em">
      </button>
      <input type="text" name="name" value="1">
      <button class="minus-btn" type="button" name="button">
         <img src="../images/sign/minus.png" width="15em" height="15em">
      </button>
    </div>

    <div class="col total-price">$3.75</div>
  </div>

  <!-- Product #3 -->
  <div class="item">
    <div class="col buttons">
      <button type="delete" name="button">
        <img src="../images/sign/delete.png" width="20em" height="20em">
      </button>
    </div>
    <div class="col checkboxdiv">
      <input class="checkbox" type="checkbox">
    </div>

    <div class="col image">
      <img src="../images/coffee/cafe-latte.png" alt="item3" / width="80em" height="80em">
    </div>

    <div class="col description">
      cafe latte
    </div>

    <div class="col quantity">
      <button class="plus-btn" type="button" name="button">
         <img src="../images/sign/plus.png" width="15em" height="15em">
      </button>
      <input type="text" name="name" value="1">
      <button class="minus-btn" type="button" name="button">
         <img src="../images/sign/minus.png" width="15em" height="15em">
      </button>
    </div>

    <div class="col total-price">$2.75</div>
  </div>

  <div class="subtotal">
    subtotal:
  </div>
  <div class="subvalue">

  </div>
</div>

<?php include 'footer.php';?>
</body>
<img class="cartbg" src="../images/bg/cartbg.jpg" alt="">
</body>
</html>
