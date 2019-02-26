<?php
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
  $email = $_POST["email"];
  $pw = $_POST["password"];
  $pwhash = md5($pw);
  $referer = $_SERVER['HTTP_REFERER'];

  include 'db_credential.php';
  $conn = mysqli_connect($host, $user, $password, $database);
  $error = mysqli_connect_error();
  $flag = false;

  if($error != null)
  {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
  }
  else {
    $sql = "SELECT fname, email, cpassword, isadmin, disabled FROM customer";
    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($results)) {
      if ($row['disabled']) {
        // access denied
        $_SESSION['denied'] = true;
        header("Location: $referer");
      }
      else {
        //login
        if ($row["email"] == $email) {
          $flag = true;//user exists
          if ($row["cpassword"] == $pwhash) {
            //echo "this is a valid account";//jump to frontPage
            $_SESSION['login'] = $email;
            $_SESSION['firstname'] = $row['fname'];
            $_SESSION['isadmin']=$row['isadmin'];

            //$_SESSION['wrongpw']= false;
            //$_SESSION['wrongemail']= false;
            header('Location: frontPage.php');
          }
          else {
            //echo "password not match";
            $_SESSION['wrongpw']= true;
            header("Location: $referer");

          }
        }
      }

    }
    if (!$flag) {//user not exist
      //echo "user not exit";
      $_SESSION['wrongemail']= true;
      header("Location: $referer");
    }
    mysqli_close($conn);
  }

}
else {
  //echo "wrong request method";
  $_SESSION['invalid']= true;
  if (isset($_SESSION['invalid'])) {
    header('Location: login.php');
  }

}
?>
