<!DOCTYPE html>
<html>
<head>
<title>Ray's Grocery Order List</title>
</head>
<body>

<h1>Order List</h1>

<?php
// include 'include/money_format_windows.php'; //Only required on windows PCs
$sql = "SELECT orderId, O.CustomerId, totalAmount, cname FROM Orders O, Customer C WHERE O.customerId = C.customerId";

include 'include/db_credentials.php';
$con = sqlsrv_connect($server, $connectionInfo);

$pstmt = sqlsrv_query($con, $sql, array());
echo("<table border=\"1\"><tr><th>Order Id</th><th>Customer Id</th><th>Customer Name</th><th>Total Amount</th></tr>");

// Use a PreparedStatement as will execute many times
$orderId = 0;
$pstmt2 = sqlsrv_prepare($con, "SELECT productId, quantity, price FROM OrderedProduct WHERE orderId=?",array(&$orderId));

while ($rst = sqlsrv_fetch_array( $pstmt, SQLSRV_FETCH_ASSOC)) {
	$orderId = $rst['orderId'];
	echo("<tr><td>".$orderId."</td>");
	echo("<td>".$rst['CustomerId']."</td>");
	echo("<td>".$rst['cname']."</td>");
	echo("<td>".str_replace("USD","$",money_format('%i',$rst['totalAmount']))."</td>");
	echo("</tr>");

	// Retrieve all the items for an order
	sqlsrv_execute($pstmt2);
	
	echo("<tr align=\"right\"><td colspan=\"4\"><table border=\"1\">");
	echo("<th>Product Id</th> <th>Quantity</th> <th>Price</th></tr>");
	while ($rst2 = sqlsrv_fetch_array( $pstmt2, SQLSRV_FETCH_ASSOC)) {
		echo("<tr><td>".$rst2['productId']."</td>");
		echo("<td>".$rst2['quantity']."</td>");
		echo("<td>".str_replace("USD","$",money_format('%i',$rst2['price']))."</td></tr>");
	}
	echo("</table></td></tr>");
}
echo("</table>");
sqlsrv_free_stmt($pstmt2);
sqlsrv_close($con);
?>
</body>
</html>