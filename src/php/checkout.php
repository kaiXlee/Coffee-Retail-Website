<?php session_start();
// unset($_SESSION['productList']);
 ?>
<!DOCTYPE html>
<html lang = "en">
<head>
  <title>IDEAS</title>
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/default.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/checkout.css">
  <script type="text/javascript">

  </script>

</head>
<body>
  <?php
  if (isset($_SESSION['creditcard'])) {
    if ($_SESSION['creditcard'] == false) {
      // checkout with no card
      echo "<script>alert('please add a credit card to checkout');</script>";
      unset($_SESSION['creditcard']);
    }
  }
  // include 'include/money_format_windows.php'; //Only required on windows PCs
  // Get the current list of products
  include 'header.php';

  echo '<div class="mainbody">
    <!-- Title -->
    <div class="carttitle">
      <p class="titlecontent">Shopping Cart</p>
    </div>';
  $productList = null;
  if (isset($_SESSION['productList'])){
  	$productList = $_SESSION['productList'];
    if (empty($productList)) {
      	echo("<H1>Your shopping cart is empty!</H1>");
    }
    else {
      //PRINTING OUT CART INFO
      $total = 0;
      echo
         '<div class="carttitle">
          <button type="button" class="checkout" name="button"><a href = "process-checkout.php">Check Out</a></button>
        </div>';
    foreach ($productList as $id => $prod) { //For each product in productList
      //Query each product info
      //print_r($productList[$id]['name']);
      include 'db_credential.php';
      $conn = mysqli_connect($host, $user, $password, $database);
      $error = mysqli_connect_error();

      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{
        $sql = "SELECT * FROM product WHERE pid = ".$prod['id'];
        $results = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($results);
        $pertotal = $row['price'] * $prod['quantity'];
        $total = $total + $pertotal;
        // echo          '
        //         </tbody>
        //       </table>
        //   </div>';
      }
      //print_r($prod);

      echo
      '<div class="item">
      <form action="plus_minus_one.php" method="post">
        <div class="col buttons">
          <button type="submit" name="delete"  value="'.$prod['id'].'" >
            <img src="../images/sign/delete.png" width="20em" height="20em">
          </button>
        </div>

        <div class="col image">
          <img src="'.$row['imageURL'].'" alt="item1" / width="80em" height="80em">
        </div>

        <div class="col description">
          '.$row['pname'].'
        </div>


          <div class="col quantity">
            <button class="plus-btn" name="plus" value="'.$prod['id'].'" type="submit">

               <img src="../images/sign/plus.png" width="15em" height="15em">
            </button>
            <input type="text" name="pid" readonly value="'.$prod['quantity'].'">
            <button class="minus-btn" name="minus" value="'.$prod['id'].'" type="submit">
               <img src="../images/sign/minus.png" width="15em" height="15em">
            </button>
          </div>
        </form>
          <div class="col total-price">'.$pertotal.'</div>
        </div>
      ';

      //
      // Quantity: <input type="number" id="myNumber'.$prod['id'].' name="quantity" value="quantity">
      // <input type="submit" class="minus-btn" name="pid" value="'.$prod['id'].'" >
      // Update Quantity
      // </button>

      // echo("<tr><td>". $prod['id'] . "</td>");
      // echo("<td>" . $prod['name'] . "</td>");
      //
      // echo("<td align=\"center\">". $prod['quantity'] . "</td>");
      // $price = $prod['price'];
      //
      // echo("<td align=\"right\">".str_replace("USD","$",$price)."</td>");
      // echo("<td align=\"right\">" . str_replace("USD","$",$prod['quantity']*$price) . "</td></tr>");
      // echo("</tr>");
      // $total = $total +$prod['quantity']*$price;
    }
    echo("<div><p class='total'>Order Total: ".$total."</p></div>");
  	echo("</div>");

    //Getting creditcard INFO to check whether show
    $email = $_SESSION['login'];
    //select cid
    $sql = "SELECT cid FROM customer WHERE email = '".$email."'";
    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);
    $cid = $row['cid'];

    $sql = "SELECT * FROM creditcard WHERE cid = '".$cid."'";
    $results = mysqli_query($conn, $sql);
    //mysqli_fetch_row();
    if(!$results){
      //echo("Error description: " . mysqli_error($conn));//no credit card
      //Payment form
      echo'
      <div class="payment">
        <h1 class="po">Payment options</h1>
        <div class="card">
          <form class="" action="process-creditCard.php" method="post">
            <table>
              <tr>
                <th>Customer ID</th><th>Card Number</th><th>CVV</th><th>Expiration date</th><th>Billing Address</th>
              </tr>
              <tr>
                <td>'.$cid.'</td>
                <td><input type="text" name="cardnumber" class="required" ></td>
                <td><input type="text" name="CVV" class="required" ></td>
                <td><input type="date" name="expiredate" class="required" ></td>
                <td><input type="text" name="bAddress" class="required" ></td>

                <td><input type="submit" name="submit" value="ADD"></td>
              </tr>
            </table>
          </form>
        </div>

      </div>

      ';
    }
    else {
      // list credit card info
      $row = mysqli_fetch_assoc($results);
      $cardnum = $row['cardNum'];
      $cvv = $row['CVV'];
      $expiredate = $row['cardExpired'];
      $baddress = $row['bAddress'];

      echo'
      <div class="payment">
        <h1 class="po">Payment options</h1>
        <div class="card">
          <form class="" action="process-creditCard.php" method="post">
            <table>
              <tr>
                <th>Customer ID</th><th>Card Number</th><th>CVV</th><th>Expiration date</th><th>Billing Address</th>
              </tr>
              <tr>
                <td>'.$cid.'</td>
                <td><input type="text" name="cardnumber" class="required" value = "'.$cardnum.'"></td>
                <td><input type="text" name="CVV" class="required" value = "'.$cvv.'"></td>
                <td><input type="date" name="expiredate" class="required" value = "'.$expiredate.'"></td>
                <td><input type="text" name="bAddress" class="required" value = "'.$baddress.'"></td>

                <td><input type="submit" name="submit" value="UPDATE"></td>
              </tr>
            </table>
          </form>
        </div>

      </div>

      ';}

  }

    }


  include("footer.php");
  ?>
  <!-- <h2><a href="listprod.php">Continue Shopping</a></h2>
  </body>
  </html> -->

</body>
</html>
