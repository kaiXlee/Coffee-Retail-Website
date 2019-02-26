<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $id = $_POST['cid'];
  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $phonenumber = $_POST['phonenumber'];
  $pword1 = md5($password);

  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();
  $return = $_SERVER['HTTP_REFERER'];
  $flag = false;
  if($error != null){
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  } else {
    //Check in database whether username and password is valid
    $userchecker = mysqli_query($conn,"SELECT * FROM Customer");
    while($row = mysqli_fetch_assoc($userchecker)){
      if ($id==$row['cid']){
          $flag = true;
          $update = mysqli_query($conn,
          "UPDATE Customer SET email =  '$email', fName = '$firstname', lName =  '$lastname',
          address =  '$address', cPassword =  '$pword1', phoneNum = '$phonenumber'
          WHERE cid = '$id'");
          $_SESSION['firstname'] = $firstname;
          header("Location: profile.php");
        } else {
          echo "INFO does not match!";
          echo "<br><a href = $return> Return to user entry</a>";
        }
      }
    if (!$flag){
      echo "Can't Update the password";
    }
    mysqli_close($conn);
  }
}
?>
