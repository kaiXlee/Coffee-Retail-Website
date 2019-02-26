<!DOCTYPE html>
<html lang = "en">
<head>
  <title>DONUT</title>
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/menu.css"/>
</head>
<body>
 <?php
	//add header
  session_start();
	include 'header.php';

      include 'db_credential.php';
      $conn = mysqli_connect($host, $user, $password, $database);
      $error = mysqli_connect_error();

      if($error != null)
      {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else
      {
        $sql = "SELECT * FROM product WHERE category = 'donut' " ;//WHERE category = donut
        $results = mysqli_query($conn, $sql);


        //query Done
          echo '<div class = "menuitems">
                <table id = "listingTable">
                  <tbody>
                      <tr>
                        <th class = "tableHead">Picture</th>
                        <th class = "tableHead">Product Name</th>
                        <th class = "tableHead">Price</th>
                        <th class = "tableHead">Quantity</th>
                        <th class = "tableHead">Rating</th>
                        <th class = "tableHead">Cart</th>
                      </tr>';
          while ($row = mysqli_fetch_assoc($results)) {
            $pname = $row['pname'];
            $price = $row['price'];
            $imageurl = $row['imageURL'];

            echo
            '<tr class = "menuitems">
              <td><img id = "menupic" src = "'.$row["imageURL"].'" alt =""></td>
              <td> '.$pname.' </td>
              <td>'.$price.'</td>
              <td> quantity</td>
              <td>
                <div class = "rating">
                  <span> ★ </span>
                  <span> ★ </span>
                  <span> ★ </span>
                  <span> ★ </span>
                  <span> ★ </span>
                </div>
              </td>
              <td><a class="addCart" href = "addcart.php?id='. $row['pid'] . '&quantity=1"> Add to Cart </a> </td>
             </tr>';
          }
          echo          '
                  </tbody>
                </table>
            </div>';
      }

	//add footer
	include 'footer.php';

    ?>
  </body>
</html>
