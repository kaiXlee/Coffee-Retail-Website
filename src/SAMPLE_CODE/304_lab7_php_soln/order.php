<!DOCTYPE html>
<html>
<head>
<title>Ray's Grocery Order Processing</title>
</head>
<body>

<?php
	// include 'include/money_format_windows.php'; //Only required on windows PCs
	// Get customer id
	$custId = "";
	if(isset($_GET['customerId'])){
		$custId = $_GET['customerId'];
	} else {
		die("<h1>Invalid customer id.  Go back to the previous page and try again.</h1>");
	}
	session_start();
	$productList = null;
	if (isset($_SESSION['productList'])){
		$productList = $_SESSION['productList'];
	} else {
		die("<h1>Your shopping cart is empty!</h1>");
	}

	if(!is_numeric($custId)){
		die("<h1>Invalid customer id.  Go back to the previous page and try again.</h1>");
	}
    $custId = intval($custId);
	$sql = "SELECT customerId, cname FROM Customer WHERE customerId = ?";	
	

	include 'include/db_credentials.php';
	$con = sqlsrv_connect($server, $connectionInfo);

	$pstmt = sqlsrv_query($con, $sql, array( $custId ));
	
	$orderId=0;
	$custName = "";

		if($rst = sqlsrv_fetch_array( $pstmt, SQLSRV_FETCH_ASSOC)) {
			$custName = $rst['cname'];

			// Enter order information into database
			$sql2 = "INSERT INTO Orders (customerId, totalAmount) OUTPUT INSERTED.orderId VALUES(?, 0);";

			$pstmt2 = sqlsrv_query($con, $sql2, array($custId));
			if(!sqlsrv_fetch($pstmt2)){
				die( print_r( sqlsrv_errors(), true));
			}
			$orderId = sqlsrv_get_field($pstmt2,0);
			
			echo("<h1>Your Order Summary</h1>");
      	  	echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>");

        	$total =0;
        	foreach ($productList as $id => $prod) {
                echo("<tr><td>".$prod['id']."</td>");
                echo("<td>".$prod['name']."</td>");
				echo("<td align=\"center\">".$prod['quantity']."</td>");
                $price = doubleval($prod['price']);
				echo("<td align=\"right\">".str_replace("USD","$",money_format('%i',$price))."</td>");
               	echo("<td align=\"right\">".str_replace("USD","$",money_format('%i',$price*$prod['quantity']))."</td></tr>");
                echo("</tr>");
                $total = $total +$price*$prod['quantity'];

				$sql3 = "INSERT INTO OrderedProduct VALUES(?, ?, ?, ?)";
				$pid = intval($prod['id']);
				sqlsrv_query($con, $sql3, array($orderId, $pid, $prod['quantity'], $prod['price']) );
        	}
        	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td>" .
                       	"<td aling=\"right\">".str_replace("USD","$",money_format('%i',$total))."</td></tr>");
        	echo("</table>");

			// Update order total
			$sql4 = "UPDATE Orders SET totalAmount=? WHERE orderId=?";
			sqlsrv_query($con, $sql4, array( $total, $orderId));

			echo("<h1>Order completed.  Will be shipped soon...</h1>");
			echo("<h1>Your order reference number is: ".$orderId."</h1>");
			echo("<h1>Shipping to customer: ".$custId." Name: ".$custName."</h1>");

			// Clear session variables (cart)
			$_SESSION['productList'] = null;
		} else {
			die("<h1>Invalid customer id.  Go back to the previous page and try again.</h1>");
		}
		sqlsrv_close($con);
?>
</body>
</html>

