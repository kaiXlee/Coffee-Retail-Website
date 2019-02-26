<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css"/>
    <link rel="stylesheet" href="../css/default.css"/>
    <link rel="stylesheet" href="../css/footer.css"/>
    <link rel="stylesheet" href="../css/mainPage.css" />
    <link rel="stylesheet" href="../css/inventory.css" />

    <title>INVENTORY</title>

  </head>
  <body>
    <?php include 'header.php' ?>
    <?php
    echo '<button type="button" name="button"><a href="trackstorage.php">PIECHART OF SALES</a></button>';
     ?>

<!--
    <form action="searchcustomer.php" method="get" id="searchForm">
      <input type = "text" name ="searchcustomer">
      <input type = "submit" value = "Submit">
    </form>

-->
    <?php
    //list all customers
    include 'db_credential.php';
    $conn = mysqli_connect($host, $user, $password, $database);
    $error = mysqli_connect_error();

    if($error != null)
    {
      $output = "<p>Unable to connect to database!</p>";
      exit($output);
    }
    else {
      $sql = "SELECT * FROM product";
      $results = mysqli_query($conn, $sql);
      //echo '<a href="adminPage.php">BACK TO ADMIN HOMEPAGE</a>';

      //echo cid email fName lName address cPassword phoneNum isAdmin
      echo '<div class = "table">
            <table id = "listallproduct">
              <tbody>
                  <tr>
                    <th class = "tableHead">PRODUCT ID</th>
                    <th class = "tableHead">IMAGE</th>
                    <th class = "tableHead">PRODUCT NAME</th>
                    <th class = "tableHead">PRODUCT PRICE</th>
                    <th class = "tableHead">CATEGORY</th>
                    <th class = "tableHead">DESCRIPTION</th>
                    <th class = "tableHead">STORAGE</th>
                    <th class = "tableHead">SALES</th>

                  </tr>';
      while ($row = mysqli_fetch_assoc($results)) {
        //get all value
        $pid = $row['pid'];
        $image = $row['imageURL'];
        $pname = $row['pname'];
        $price = $row['price'];
        $category = $row['category'];
        $description = $row['description'];
        $storage = $row['amountLeft'];
        $sales = $row['sale'];

        echo
        '<tr class = "">
          <td> '.$pid.' </td>
          <td> <img src="'.$image.'" alt="" style="float:left;width:8em;height:8em;padding-right:1em;"> </td>
          <td> '.$pname.'</td>
          <td> '.$price.' </td>
          <td> '.$category. '</td>
          <td> '.$description.' </td>
          <td> '.$storage.' </td>
          <td> '.$sales.' </td>
         </tr>';
      }

      echo     '</tbody>
              </table>
            </div>';
      mysqli_close($conn);
    }



    ?>
    <?php include 'footer.php';?>

  </body>
</html>
