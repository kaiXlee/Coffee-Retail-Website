<?php session_start(); ?>

<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
  $pname = 	$_POST["pname"];
  $price	= $_POST["price"];
  $description = $_POST["description"];
  $image = $_POST["imageURL"];
  $category = $_POST["category"];

  $referer = $_SERVER['HTTP_REFERER'];

  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();
  $flag = false;

  $referer = $_SERVER['HTTP_REFERER'];

  if($error != null)
  {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else{
      $sql = "SELECT pname FROM product";
      $results = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($results)){
        if($row["pname"]==$pname){
          $exist = true;
          //$_SESSION['exist']=true;
          //header("Location: $referer");
        }
      }
  // }
    if ($exist) {
      // update
      $sql = "UPDATE product SET price = '".$price."', description = '".$description."', imageURL = '".$image."', category = '".$category."'
       WHERE pname = '".$pname."'";
      $results = mysqli_query($conn, $sql);
      if ($results) {
        //update succeed
        header("Location: admin_insert_update.php");//go back to insert

      }
      else {
        echo "error: ".$sql. "<br>";
      }
      mysqli_close($conn);
    }

    else{
      $sql = "INSERT INTO product (pname, price, description, imageURL, category)
      VALUES ('$pname','$price','$description', '$image','$category') ";
      $results = mysqli_query($conn, $sql);

      if ($results) {
        //update succeed
        header("Location: admin_insert_update.php");//go back to insert

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
