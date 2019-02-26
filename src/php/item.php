<!DOCTYPE html>
<?php session_start();?>
<html lang = "en">
<head>
  <title>IDEAS</title>
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/default.css"/>
  <link rel="stylesheet" href="../css/item.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <script type="text/javascript" src="../scripts/validate.js"></script>
</head>
<body>
<?php
	//php files for pulling
	include "accessProduct.php";

	$pid = $_GET["itemID"];
	$itemArray = returnItem($pid);
	//retrieve comments
	$commentsArray = returnComments($pid);

	//CHANGE THIS TO CHANGE SIMILAR ITEMS
	$similarItems = returnMultipleItems(array(5, 22, 19, 7));

	include 'header.php';
?>

  <!-- item body -->
    <div class = "panel">
		<figure class="itemFig">
			<img src="<?php echo $itemArray[4];?>" alt="<?php echo $itemArray[1];?>">
			<figcaption><?php echo $itemArray[1];?></figcaption>
		</figure>
		<p class="itemDesc"><?php echo $itemArray[3];?> 
			<br> <br> Price: $<?php echo $itemArray[2];?>
			<br> <br> Rating: <?php if ($itemArray[8] == null ){ echo "No Rating Yet"; } else { echo $itemArray[8];}?>
			<form method='get' action='addcart.php'>
					<input type='hidden' name='pname' value='<?php echo $itemArray[1];?>'>
					<input type='hidden' name='id' value='<?php echo $itemArray[0];?>'>
					<input type='hidden' name='price' value='<?php echo $itemArray[2];?>'>
					<input type='submit' name='addCart' class='addCart addButton' value='Add to Cart'>
			</form>
		</p>
	</div>

	<!-- Comments -->
	<div class="comments">
		<h2>Comments</h2>
		<?php
			$numComments = 0;
			$currentRating = $itemArray[8];
			//If there are comments display them, otherwise say no comments yet
			if (isset($commentsArray)){
				$numComments = count($commentsArray);
				foreach ($commentsArray as $value){
					$userInfo = returnCustomer($value[2]);
					echo "<div class='panel'>
						<h2 class='userName'>".$userInfo[2]."</h2>
						<p class='ptext'>".$value[3]." <br> <br> Rating: " . $value[4] . "</p>
					</div>";
				}
			} else {
				$currentRating = 0;
				echo "<div class='panel'>
					<p class='ptext'> No Comments Yet. </p>
				</div>";
			}
			//If user is logged in dispaly comment
			if (isset($_SESSION['login'])){
				$email = $_SESSION['login'];
				echo "<form action='submitComment.php' method='get' id='mainForm'>
					<fieldset>
						<input type='hidden' name='email' value='".$email."'>
						<input type='hidden' name='pid' value='".$pid."'>
						<input type='hidden' name='numComments' value='".$numComments."'>
						<input type='hidden' name='currentRating' value='".$currentRating."'>
						<input type='text' name='content' id='commentBox' class='required'>
						<span class='starGroup'> Rating: 
							<input type='radio' name='rating' value=1 id='ra' class='radioButton'> <label for='ra'>1</label>
							<input type='radio' name='rating' value=2 id='rb' class='radioButton'> <label for='rb'>2</label>
							<input type='radio' name='rating' value=3 id='rc' class='radioButton' checked> <label for='rc'>3</label>
							<input type='radio' name='rating' value=4 id='rd' class='radioButton'> <label for='rd'>4</label>
							<input type='radio' name='rating' value=5 id='re' class='radioButton'> <label for='re'>5</label>
						</span>
						<input type='submit' class='commentBtn' name ='commentSubmit' value='Submit'>
					</fieldset>
				</form>";
			}
		?>
	</div>

	<!-- Similar Items -->
	<div class="similarItems">
		<h2>Similar Items</h2>
		<?php
		foreach($similarItems as $value){
			echo "<form method='get' action='item.php' id='addSubmit'>
			<div class = 'panel'>
				<figure class='itemFig'>
					<img src='".$value[4] ."' alt='".$value[1]."'>
					<input type='hidden' name='itemID' value='".$value[0]."' >
					<figcaption>
						<input type='submit' class='viewItem' value='".$value[1]."' name='".$value[1]."'>
					</figcaption>
				</figure>
			</div>
			</form>";}?>
	</div>

  <?php include 'footer.php'?>
  </body>
</html>
