<!DOCTYPE html>
<html lang = "en">
<head>
  <title>COFFEE</title>

  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/menu.css"/>
</head>
<body>
  <!-- coffee menu table -->

    <?php
	//add header
  session_start();
	include 'header.php';
    if(isset($_GET["itemCategory"])){
      $itemCategory = $_GET["itemCategory"];

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
        $sql = "SELECT * FROM product WHERE category = '$itemCategory' " ;//WHERE category = coffee
        $results = mysqli_query($conn, $sql);


        //query Done
          echo '<div class = "menuitems">
                <table id = "listingTable">
                  <tbody>
                      <tr>
                        <th class = "tableHead">Picture</th>
                        <th class = "tableHead">Product Name</th>
                        <th class = "tableHead">Price</th>
                        <th class = "tableHead">Rating</th>
                        <th class = "tableHead">Cart</th>
                      </tr>';
          while ($row = mysqli_fetch_assoc($results)) {
            $pname = $row['pname'];
            $price = $row['price'];
            $imageurl = $row['imageURL'];

            echo
            '<tr class = "menuitems">
              <td><a href = "item.php?itemID='. $row['pid'] . '"><img id = "menupic" src = "'.$row["imageURL"].'" alt =""></a> </td>

              <td> '.$pname.' </td>
              <td>'.$price.'</td>
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
    }
		//add footer
		include 'footer.php';
    ?>
  </div>
  <!-- company names / copyright / info etc etc -->
  </body>
</html>
