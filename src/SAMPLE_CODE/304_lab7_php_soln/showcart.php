<!DOCTYPE html>
<html>
<head>
<title>Your Shopping Cart</title>
</head>
<body>

<?php
// include 'include/money_format_windows.php'; //Only required on windows PCs
// Get the current list of products
session_start();
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
	echo("<h1>Your Shopping Cart</h1>");
	echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
	echo("<th>Price</th><th>Subtotal</th></tr>");

	$total =0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");

		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">".str_replace("USD","$",money_format('%i',$price))."</td>");
		echo("<td align=\"right\">" . str_replace("USD","$",money_format('%i',$prod['quantity']*$price)) . "</td></tr>");
		echo("</tr>");
		$total = $total +$prod['quantity']*$price;
	}
	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">".str_replace("USD","$",money_format('%i',$total))."</td></tr>");
	echo("</table>");

	echo("<h2><a href=\"checkout.php\">Check Out</a></h2>");
} else{
	echo("<H1>Your shopping cart is empty!</H1>");
}
?>
<h2><a href="listprod.php">Continue Shopping</a></h2>
</body>
</html> 

