<!DOCTYPE html>
<?php
session_start();
?>
<html lang = "en">
<head>
  <title>Your orders</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/orders.css">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/default.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/admin_order.css"/>
</head>

<body>

  <?php include 'header.php';?>
<?php
if (isset($_SESSION['login'])) {
  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();
  $flag = false;

  if($error != null)
  {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }

    else {
    //   $email = $_SESSION['login'];
    //   $sql = "SELECT * FROM customer WHERE email ='".$email."'";
    //   $results = mysqli_query($conn, $sql);
    // //get all orders with this cid
    //   if (!$results) {
    //     echo "error";
    //   }
    //   else {
    //     $row = mysqli_fetch_assoc($results);
    //     $cid = $row['cid'];

        $sql = "SELECT * FROM orders  ";//and purchasedDate = '".$datetime."'  WHERE cid ='".$cid."'
        $results = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($results)) {
          // cid-----oid
          $cid = $row['cid'];
          $oid = $row['oid'];
          $status = $row['status'];
          $datetime = $row['purchasedDate'];
          //$date = $row['purchasedDate'];
          echo '<div class="order">
            <table>
            <caption>CUSTOMER NUMBER:  '.$cid.'</caption>
              <caption>ORDER NUMBER:  '.$oid.'</caption>
              <caption>PURCHASED DATE:  '.$datetime.'</caption>
              <caption>ORDER STATUS:  '.$status.'</caption>
              <caption><button type="button" name="button"><a href="shiporder.php?oid='.$oid.' ">ship this order</a>
              <button type="button" name="button"><a href="cancelorder.php?oid='.$oid.'">cancel this order</a> </button>
              </button></caption>
              <tr>
                <th>PRODUCT NAME</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
              </tr>';
              $sql = "SELECT * FROM ordercontains WHERE oid ='".$oid."'";
              $reslt = mysqli_query($conn, $sql);
              while ($hang = mysqli_fetch_assoc($reslt)) {
                $pid = $hang['pid'];
                $quantity = $hang['quantity'];
                $price = $hang['price'];

                $sql = "SELECT * FROM product WHERE pid ='".$pid."'";
                $final = mysqli_query($conn, $sql);
                $hang = mysqli_fetch_assoc($final);

                $pname = $hang['pname'];
                echo ' <tr>
                  <td>'.$pname.'</td>
                  <td>'.$quantity.'</td>
                  <td>'.$price.'</td>
                </tr> ';

              }
                echo  '</table>
                    </div> ';
        }
      //}

  }



}
else {
  header("Location: signin.php");
}



?>



  <!--
<div class="mainbody">
  <div>
    <div class="top">
      <h1>Your orders</h1>
    </div>
    <div class="top search">
      <input type="text" name="search" value="Search all ordedrs">
      <button type="button" name="search">Search Orders</button>
    </div>
  </div>
<div class="navigation first">
<div class="category">
  <a class="orders" href="#">Orders</a>
</div>
<div class="category">
  <a class="orders" href="#">Open Orders</a>
</div>
<div class="category">
  <a class="orders" href="#">Cancelled Orders</a>
</div>
<div class="category">
  <select class="date" name="">
    <option value="">past 1 year</option>
    <option value="">past 6 months</option>
    <option value="">past 30 days</option>
    <option value="">past 1 week</option>
  </select>

</div>
</div>
<div class="ordershow">

</div>

</div>
-->

<?php include 'footer.php';?>


</body>
</html>
