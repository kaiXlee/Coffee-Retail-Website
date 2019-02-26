<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['exist'])) {
  if ($_SESSION['exist'] == true) {
    echo "<script>alert('this email has been registered!');</script>";
    $_SESSION['exist'] = false;
  }
}

?>

<html lang = "en">
<head>
  <title>IDEAS registration</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <link rel="stylesheet" href="../css/registration.css">
  <script type="text/javascript" src="../scripts/validate.js"></script>
  <script>//show pw or cover pw
  function showpassword() {
    var x = document.getElementsByName("password")[0];
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

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
  <form  action="process-register.php" method="post" id="mainForm">
    <table>
      <th colspan="2"><h1 class="form">Create account</h1></th>
      <tr>
        <td class="firstcol"><label for="firstname">firstname</label></td>
        <td><input type="text" name="firstname" class="required"></td>
      </tr>

      <tr>
        <td class="firstcol"><label for="lastname">lastname</label></td>
        <td><input type="text" name="lastname" class="required"></td>
      </tr>

      <tr>
        <td class="firstcol"><label for="email">Email</label></td>
        <td><input type="text" name="email" class="required"></td>
      </tr>

      <tr>
        <td class="firstcol"><label for="phonenum">Phone number</label></td>
        <td><input type="text" name="phonenum" class="required"></td>
      </tr>

      <tr>
        <td class="firstcol"><label for="address">Address</label></td>
        <td><input type="text" name="address" class="required"></td>
      </tr>

      <tr>
        <td class="firstcol"><label for="password">Password</label></td>
        <td><input type="password" name="password" onfocus="this.value=''" class="required" id="password"></td>
      </tr>

      <tr>
        <td class="firstcol"><input type="checkbox" name="showpw" onclick="showpassword()">Show Password</td>
      </tr>

      <tr>
        <td class="firstcol"><label for="confirm">Password again</label></td>
        <td><input type="password" name="confirm" onfocus="this.value=''" class="required" id="password-check"></td>
      </tr>

      <tr>
        <td class="firstcol"><p class="change">Already have an account?<a class="signinlink" href="signin.php">Sign in</a></p></td>
        <td><button class="register" type="submit" name="button">Create your IDEAS account</button></td>
      </tr>
    </table>
  </form>

  <?php include 'footer.php';?>
  <img class="registerbg" src="../images/bg/registerbg.jpg" alt="">
</video>


</body>
</html>
