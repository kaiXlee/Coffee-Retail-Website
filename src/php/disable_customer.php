<?php
if(isset($_GET['id'])){
  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();
  $cid = $_GET['id'];

  if($error != null){
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else{
    $sql = "UPDATE customer SET disabled = 1 WHERE cid = $cid"; //WHERE category = coffee
    $results = mysqli_query($conn, $sql);
    header("Location: admin_manage_customer.php");
  }

}

?>
