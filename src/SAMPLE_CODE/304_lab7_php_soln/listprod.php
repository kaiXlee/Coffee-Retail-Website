<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ray's Grocery</title>
</head>
<body>

<h1>Search for the products you want to buy:</h1>

<form method="get" action="listprod.php">
<input type="text" name="productName" size="50">
<input type="submit" value="Submit"><input type="reset" value="Reset"> (Leave blank for all products)
</form>

<?php
	// Get product name to search for
	$name = "";
	$hasParameter = false;
	if (isset($_GET['productName'])){
		$name = $_GET['productName'];
	}
	$sql = "";

	if ($name == "") {
		echo("<h2>All Products</h2>");
		$sql = "SELECT productId, productName, price FROM Product";
	} else {
		echo("<h2>Products containing '" . $name . "'</h2>");
		$hasParameter = true;
		$sql = "SELECT productId, productName, price FROM Product WHERE productName LIKE ?";
		$name = '%' . $name . '%';
	}
	include 'include/db_credentials.php';
	$con = sqlsrv_connect($server, $connectionInfo);
	
	/* Try/Catch connection errors */
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$pstmt = null;
	if($hasParameter){
		$pstmt = sqlsrv_query($con, $sql, array( $name ));
	} else {
		$pstmt = sqlsrv_query($con, $sql, array());
	}
	
	echo("<table><tr><th></th><th>Product Name</th><th>Price</th></tr>");
	while ($rst = sqlsrv_fetch_array( $pstmt, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td><a href=\"addcart.php?id=" . $rst['productId'] . "&name=" . $rst['productName'] . "&price=" . $rst['price'] . "\">Add to Cart</a></td>");
		echo("<td>" . $rst['productName'] . "</td><td>" . $rst['price'] . "</td></tr>");
	}
	echo("</table>");
	
	sqlsrv_close($con);
?>
</body>
</html>