<?php
session_start();
include 'header.php'
?>
<!DOCTYPE html>
<head>
  <title>Delete Items-Admin</title>
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <!-- <link rel="stylesheet" href="../css/mainPage.css"/> -->
  <link rel="stylesheet" href="../css/admin_delete.css" />

<script type = "text/javascript" src = "../scripts/validate.js"> </script>
</head>

<form action="process-delete_update.php" method="post" id = "mainform">
  <table>
    <th colspan="2"><h1 class="form">Delete Existing Product</h1></th>
    <tr>
      <td class="firstcol"><label for="pname">Product Name</label></td>
      <td><input type="text" name="pname" class="required"></td>
    </tr>
    <tr>
      <td></td>
      <td><button class="delete product" type="submit" name="button">Delete Items</button></td>
    </tr>
    </table>
</form>
<?php
if ($_SERVER['REQUEST_METHOD']=="GET") {
  //$Add_Item = $_GET['Add_Item'];
  // $insert_sql = mysqli_query($conn,"INSERT INTO Product VALUES($Add_Item)");
  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();

  // try catch for connection
  if($error != null){
    $output = "Unable to connect to database!";
    exit($output);
  } else {

    //LISTING ALL PRODUCTS IF NOTHING IS ENTERED





      echo("<div class = 'title'><h2>All Products Listed Below</h2></div>");
      $sql = mysqli_query($conn,"SELECT * FROM product");
      while($row = mysqli_fetch_assoc($sql)){

        echo "<div class = 'part'><p><h3 style='color:black;'".$row['pname']."</h3>";
        echo "Dollars: ".$row['price'];
        echo "<br> Description: <br> ".$row['description']."</p>";
        $image=$row['imageURL'];
        echo '<img src="'.$image.'" style="width:128px;height:128px"></div>';

      }


      mysqli_close($conn);

    }
  }
  ?>

    <?php include 'footer.php';?>

</html>
