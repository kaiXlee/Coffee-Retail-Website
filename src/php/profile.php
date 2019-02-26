<!DOCTYPE html>

<?php
//CHECK IF SESSION EXISTS FIRST
session_start();
if (isset($_SESSION['login'])) {
  $exist = $_SESSION['login'];
}
else {
  header('Location: signin.php');
}
?>
<html lang = "en">
<head>
  <title>Your profile</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/default.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/account.css">
  <title>Your Profile</title>
  <script type="text/javascript" src="../scripts/validate.js"></script>
  <script type="text/javascript">
  document.getElementById("mainForm").onsubmit = function(){checkPasswordMatch(e)};
  function checkPasswordMatch(e){
    var pw = document.getElementById("password");
    var pwcheck = document.getElementById("password-check");
    if (pw.value != pwcheck.value) {
      e.preventDefault();
      makeRed(pw);
      makeRed(pwcheck);
      alert("passwords not match");

    }
    else {
      document.getElementById("mainForm").submit();
    }
  }
  </script>
</head>
<body>
  <?php include 'header.php';?>
  <div class="profile">
    <h1>Your Profile</h1>
    <?php
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
      $userchecker = mysqli_query($conn,"SELECT * FROM customer WHERE email ='".$exist."'");
      while($row = mysqli_fetch_assoc($userchecker)){
        echo"<form id=\"mainForm\" action = \"checkProfile.php\" method=\"POST\">
        <table class = \"profileTable\">
        <tr><td>Customer ID: </td><td><input type=\"text\" value=".$row['cid']." name = \"cid\" readonly=\"readonly\" /></td></tr>
        <tr><td>Email: </td><td><input type=\"text\" name=\"email\" value = ".$row['email']." readonly=\"readonly\"></td></tr>
        <tr><td>First Name: </td><td><input type=\"text\" name=\"firstname\" value = ".$row['fName']."></td></tr>
        <tr><td>Last Name: </td><td><input type=\"text\" name=\"lastname\" value = ".$row['lName']."></td></tr>
        <tr><td>Address: </td><td><input type=\"text\" name=\"address\" value = ".$row['address']."></td></tr>
        <tr><td>Password: </td><td><input id=\"password\" type=\"password\" name=\"password\" value = ".$row['cPassword']."></td></tr>
        <tr><td>Confirm Password: </td><td><input id=\"password-check\" type=\"password\" name=\"confirmpassword\" value = ".$row['cPassword']."></td></tr>
        <tr><td>Phone Number: </td><td><input type=\"text\" name=\"phonenumber\" value = ".$row['phoneNum']."></td></tr>
        <tr><td></td><td><input  type = \"submit\" value = \"submit\"></td></tr>
        </table>
        </form>";
      }
    }
        ?>
      </div>
      <?php include 'footer.php';?>
      <img class="accountbg" src="../images/bg/accountbg.jpg" alt="">
    </body>
    </html>
