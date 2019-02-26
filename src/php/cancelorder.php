<?php
include 'db_credential.php';
$conn = mysqli_connect($host, $user, $password, $database);
$error = mysqli_connect_error();

$oid = $_GET['oid'];
//echo $oid;
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}

  else {
    //echo $oid;
    $sql = "UPDATE orders SET status = 'cancelled' WHERE oid = '".$oid."'";
    $reslt = mysqli_query($conn, $sql);
    if (!$reslt) {
      echo "query error";
    }
    else {
      header("Location: admin_order.php");
    }

  }

?>
