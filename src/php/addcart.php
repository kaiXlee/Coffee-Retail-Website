 <?php
// Get the current list of products
session_start();
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
} else{ 	// No products currently in list.  Create a list.
	$productList = array();
}

// Add new product selected
// Get product information
if(isset($_GET['id'])){
  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();

  if($error != null){
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else{
		$prod = $_GET['id'];
    //$sql = "SELECT * FROM product WHERE pid = ".$prod['id']; //WHERE category = coffee
		$sql = "SELECT * FROM product WHERE pid = '".$prod."'";
    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);
  }
	if(isset($_GET['quantity'])){ //if quantity is specified
		$id = $_GET['id'];
		$name = $row['pname'];
		$price = $row['price'];
	  $quantity = $_GET['quantity'];
	}
	else{		//if no quantity is specific, increment quantity
		$id = $_GET['id'];
		$name = $row['pname'];
		$price = $row['price'];
	  $quantity = 1;
	}
}
else {
	header('Location: frontPage.php');
}

// Update quantity if add same item to order again
if (isset($productList[$id])){
	$productList[$id]['quantity'] = $productList[$id]['quantity'] + $quantity;
} else {
	$productList[$id] = array( "id"=>$id, "name"=>$name, "price"=>$price, "quantity"=>$quantity );
}

$_SESSION['productList'] = $productList;
header('Location: showcart.php');
?>
