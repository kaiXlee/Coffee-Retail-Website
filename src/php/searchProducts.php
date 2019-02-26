<!DOCTYPE html>
<?php   session_start(); ?>
<html lang = "en">
<head>
  <title>IDEAS</title>
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/default.css"/>
</head>
<?php include 'header.php';?>

  <?php
  if ($_SERVER['REQUEST_METHOD']=="GET") {
    $search_product = $_GET['search_product'];
    include 'db_credential.php';
    $conn = mysqli_connect($host, $user, $password, $database);
    $error = mysqli_connect_error();
    $return = $_SERVER['HTTP_REFERER'];

    // try catch for connection
    if($error != null){
      $output = "Unable to connect to database!";
      exit($output);
    } else {
      //LISTING ALL PRODUCTS IF NOTHING IS ENTERED
      if($search_product == ""){
        echo("<h2 class = \"productTitle\">All Products</h2>");
        $sql = mysqli_query($conn,"SELECT * FROM product");
        while($row = mysqli_fetch_assoc($sql)){
          $image=$row['imageURL'];
          echo "<div class = \"productInfo\">";
          echo "<h3 style = \"font-size: 200%\">".$row['pname']."</h3>";
          echo '<img src="'.$image.'" style="float:left;width:8em;height:8em;padding-right:1em;">';
          echo "<h3>".$row['description']."</h3>";
          echo "</div>";
        }
      } else{
        //SEARCHING WITH KEYWORDS
        echo("<h2 class = \"productTitle\">Products containing '" . $search_product. "'</h2>");
        $sql = mysqli_query($conn,"SELECT * FROM product
          WHERE (pname LIKE '%".$search_product."%') OR (description LIKE '%".$search_product."%')");

          //CHECK IF KEYWORDS EXITS IN PRODUCT DATABASE
          if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
              $image=$row['imageURL'];
			  $pname=$row['pname'];
			  $desc=$row['description'];
			  $pid=$row['pid'];
			  $price=$row['price'];
			  echo "<div class = 'panel'>
				<form method='get' action='item.php' id='addSubmit'>
					<figure class='itemFig'>
						<img src='".$image ."' alt='".$pname."'>
						<input type='hidden' name='itemID' value='".$pid."' >
						<figcaption>
							<input type='submit' class='viewItem' value='".$pname."' name='".$pname."'>
						</figcaption>
					</figure>
				</form>
				<p class='itemDesc'>".$desc." <br> <br> Price: " . $price . " 
					<form method='get' action='addcart.php'>
						<input type='hidden' name='pname' value='".$pname."'>
						<input type='hidden' name='id' value='".$pid."'>
						<input type='hidden' name='price' value='".$price."'>
						<input type='submit' name='addCart' class='addCart addButton' value='Add to Cart'>
					</form>
				</p>
				</div>";
            }
            //OTHERWISE RETURN TO LAST PAGE or Home PAGE
          }else {
            echo "<a style='color:white;font-size:300%;padding:auto;text-align:center;margin:auto;background-color: black;' href = $return > Return to Last Page </a>";
            echo "<br><br><a style = 'color:white;font-size:300%;padding:auto;text-align:center;margin:auto;background-color: black;' href='frontPage.php'>Return to Home page</a>";
          }
        }
        mysqli_close($conn);

      }
    }
    ?>
    <?php include 'footer.php';?>
    </html>
