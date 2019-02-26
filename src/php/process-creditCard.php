<?php session_start(); ?>

<?php
include 'db_credential.php';
$referer = $_SERVER['HTTP_REFERER'];

$conn = mysqli_connect($host, $user, $password, $database);
$error = mysqli_connect_error();
$exist = false;

if ($_SERVER['REQUEST_METHOD']=="POST") {
  if (isset($_SESSION['login'])) {
    // customer logged in
    $email = $_SESSION['login'];
    $sql = "SELECT cid FROM customer WHERE email = '".$email."'";
    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);
    //get cid
    $cid = $row['cid'];

  }
  $cardnumber	= $_POST["cardnumber"];
  $CVV = $_POST["CVV"];
  $expiredate = $_POST["expiredate"];
  $bAddress = $_POST["bAddress"];

  if($error != null)
  {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else{
      $sql = "SELECT cardNum FROM creditcard WHERE cid = '".$cid."'";
      $results = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($results)){
        if($row["cardNum"]==$cardnumber){
          $exist = true;// this card in the table
            }
          //$_SESSION['exist']=true;
          //header("Location: $referer");
        }
        if ($exist) {
          // update
          $sql = "UPDATE creditcard SET cardExpired = '".$expiredate."', CVV = '".$CVV."',bAddress = '".$bAddress."'
          WHERE cid = '".$cid."' AND cardNum = '".$cardnumber."'";
          $results = mysqli_query($conn, $sql);
          header("Location: checkout.php");
        }

        else{
          $sql = "DELETE FROM creditcard WHERE cid = '".$cid."'";
          $results = mysqli_query($conn, $sql);

          $sql = "INSERT INTO creditcard VALUES ($cardnumber, '$expiredate', $CVV, '$bAddress', $cid)";
          $results = mysqli_query($conn, $sql);

          if ($results) {
            //update succeed
            header("Location: checkout.php");//go back to insert

          }
          else {
            echo "error: ".$sql. "<br>";
          }
          mysqli_close($conn);
        }
}

}
  else{
    echo"wrong request method";
  }



 ?>
