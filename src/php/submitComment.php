<?php
include 'db_credential.php';
include 'accessProduct.php';

$connection = mysqli_connect($host, $user, $password, $database);
$error = mysqli_connect_error();
if($error != null) {
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
} else {
	//Gathers required information from server and database
	$referer = $_SERVER['HTTP_REFERER'];
	$email = $_GET["email"];
	$customerArray = returnLoggedIn($email);
	$cid = $customerArray[0];
	$currentRating = $_GET["currentRating"];
	$pid = trim(mysqli_real_escape_string($connection, $_GET["pid"]));
	$content = trim(mysqli_real_escape_string($connection, $_GET["content"]));
	$rating = $_GET["rating"];
	$numComments = $_GET["numComments"];
	$rating = intval($rating);
	
	//returns average rating and sets the items to the new rating
	$newRating = (($currentRating*$numComments)+$rating)/($numComments+1);
	
	//Inserts new comment into database
	$sql = "INSERT INTO usercomments (pid, cid, content, userrating) VALUES('$pid' , '$cid' , '$content', '$rating')";
	if (mysqli_query($connection, $sql)){
		$sql = "UPDATE product SET rating = '$newRating' WHERE pid = '$pid'";
		if (mysqli_query($connection, $sql)){
			header("Location: $referer");
		}else {
			echo '<p> Could not connect to product database</p>';
		}
	}else {
		echo '<p> Could not connect to comment database</p>';
	}
	
	
	
}
mysqli_close($connection);

?>