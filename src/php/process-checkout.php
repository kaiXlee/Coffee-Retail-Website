<!DOCTYPE html>
<html lang = "en">
<head>
  <title>IDEAS</title>
  <!--
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/menu.css"/> -->
</head>
<?php
// Get the current list of products
session_start();
if(isset($_SESSION['login'])){

  //if cart isn't empty
  if(isset($_SESSION['productList'])){
    //connect to db
    include 'db_credential.php';
    $conn = mysqli_connect($host, $user, $password, $database);
    $error = mysqli_connect_error();
    if($error != null){
      $output = "<p>Unable to connect to database!</p>";
      exit("Error description: " . mysqli_error($conn));
    }
    //Finished Connection
    else {
      // process checkout
      //-----Getting Customer Info
      $productList = $_SESSION['productList'];
      $userEmail = $_SESSION['login'];
      $cid=null;
      $datetime = null; //for setting current time as it's unique in orders table\
      $oid=null;

      //------temp
      $pid=1;
      $creditCardNum =123456789;
      $pQuantity = 1;
      $pPrice = 100;

      //Getting User id for ORDERS data insertion
      $sql = "SELECT cid FROM customer WHERE email = '$userEmail';";
      $results = mysqli_query($conn, $sql);
      if(!$results){
        echo("Error description: " . mysqli_error($conn));
      }
      else {
        // connect to db
        $row = mysqli_fetch_assoc($results);
        $cid = $row['cid'];
        //echo $cid;
        $flag = false;

        //check whether this cid in creditcart
        $sql = "SELECT cid FROM creditcard ";
        $results = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
          if ($row['cid'] == $cid)   {
            // this customer has a card
            $flag = true;
          }
        }

        if (!$flag) {
          // no credit card
          $_SESSION['creditcard'] = false;
          header("Location: checkout.php");
        }

        else {

          // this customer has a credit card in db
          $sql = "SELECT cardNum FROM creditcard WHERE cid = '".$cid."'";
          $results = mysqli_query($conn, $sql);

          $row = mysqli_fetch_assoc($results);
          $creditCardNum = $row['cardNum'];
          //echo $creditCardNum;
          //Store Customer Cart into TABLE: ORDERS
          $datetime = date('Y-m-d H:i:s'); //get current datetime
          $_SESSION['datetime'] = $datetime;

          $sql = "INSERT INTO orders (purchasedDate, cardNum, cid, status) VALUES ('$datetime', '$creditCardNum', $cid, 'processing');";
          $result = mysqli_query($conn, $sql);
          if(!$result){
            echo("Error description: " . mysqli_error($conn));
          }
          else {
            //Select oid
            $sql = "SELECT * FROM orders WHERE purchasedDate = '$datetime';";
            $results = mysqli_query($conn, $sql);
            if(!$results){
              echo("Error description: " . mysqli_error($conn));
            }
            else {
              $row = mysqli_fetch_assoc($results);
              $oid = $row['oid'];
              echo 'oid: '.$oid;
              echo "<br>";
              echo "<br>";

              //Insert into ORDERCONTAINS
              foreach ($productList as $id => $prod) {
                //retrieve product info
                $sql = "SELECT * FROM product WHERE pid = '".$prod['id']."'";
                $results = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($results);

                $pid = $prod['id'];
                $pQuantity = $prod['quantity'];
                $pPrice = $row['price'] * $pQuantity;
                $storage = $row['amountLeft'];
                $storage = $storage - $pQuantity;



                $sql = "INSERT INTO `ordercontains` (`quantity`, `price`, `oid`, `pid`) VALUES ('$pQuantity', $pPrice, '$oid', '$pid');"; //WHERE category = coffee
                $result = mysqli_query($conn, $sql);

                if(!$result){
                  echo("Error description: " . mysqli_error($conn));
                }

                $sql = "UPDATE product SET amountLeft = $storage, sale = $pQuantity WHERE pid = '".$prod['id']."'";
                $result = mysqli_query($conn, $sql);
                if(!$result){
                  echo("Error description: " . mysqli_error($conn));
                }
              }

              echo 'Ordered Time: '.$datetime;
              echo "<br>";

              echo '<br> PROCESSING YOUR ORDER...';
              echo "<br>";

              header('Refresh: 4; orders.php');


              mysqli_close($conn);

            }
          }



        }

      }


        }


  }
  //if cart is empty
  // else {
  //   // echo '<h1> <font size="+50">NO PRODUCTLIST (EMPTY CART)  </font></h1>';
  //   header('Refresh: 4; URL=frontPage.php');
  // }


}
?>
</html>
