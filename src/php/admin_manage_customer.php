<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css"/>
    <link rel="stylesheet" href="../css/default.css"/>
    <link rel="stylesheet" href="../css/footer.css"/>
    <link rel="stylesheet" href="../css/mainPage.css" />
    <link rel="stylesheet" href="../css/admin_manage_customer.css"/>
    <title>Search Customers-Admin</title>

  </head>
  <body>
    <header>
      <div class = "nav">
        <!-- LOGO -->
        <div class = "logoImage">
          <a href = "frontPage.php" id = "logo">
            <img class = "logoimg" alt = "logo" src= "../images/logos/logo.png">
          </a>
        </div>

        <!-- search -->
        <div class = "navLeft">
          <form action="searchcustomer.php" method="get">
            <input type = "text" name ="searchcustomer" class = "search">
            <input type = "submit" value = " " class = "submit">
          </form>
        </div>

        <!-- cart -->
        <div class = "navRight">
          <a href = "showcart.php" id = "cart">cart </a>
        </div>

        <!-- account -->
        <div class = "navRight">
          <div class="dropdown">
            <button class="dropbtn">account</button>
            <div class="dropdown-content">
              <div class = "signIn">
                <?php
                // //check if its admin
                // include 'db_credential.php';
                // $conn = mysqli_connect($host, $user, $password, $database);
                // $error = mysqli_connect_error();
                // if($error != null){
                //   $output = "<p>Unable to connect to database!</p>";
                //   exit("Error description: " . mysqli_error($conn));
                // }
                // $sql = "SELECT isAdmin FROM customer WHERE email = '$userEmail';";
                // $results = mysqli_query($conn, $sql);
                // if(!$results){
                //   echo("Error description: " . mysqli_error($conn));
                // }
                // $row = mysqli_fetch_assoc($results);
                // $cid = $row['cid'];
                if(isset($_SESSION['login'])){
                  $firstname = $_SESSION['firstname'];
                  echo $firstname;
                  echo '<a href="logout.php">Logout</a>';
                  if(isset($_SESSION['isadmin'])){
                    $isAdmin = $_SESSION['isadmin'];
                    if($isAdmin==1){
                      echo '<a href = "adminPage.php" > Admin Page</a>';
                    }
                  }
                }
                else{
                  echo '<a href = "signin.php" id = "sign">sign in</a>';
                }

                ?>
                <ul class = "logIn">
                  <a href="account.php"><li class = "youraccount">Your Account</li></a>
                  <a href="orders.php"><li class = "yourorder">Your Orders</li></a>
                </ul>
              </div>
            </div>
          </div>

        </div>

        <!-- menu -->
        <div class = "navRight">
          <div class="dropdown">
            <button class="dropbtn">menu</button>
            <div class="dropdown-content">
              <div class = "drinkMenu">
                <p id = "beverages">beverages </a>
                  <ul class = "subMenu">
                    <!-- <li class = "beverageImg"> -->
                    <!-- <img src = "../images/logo.png" alt "beverage"> -->
                    <!-- </li> -->
                    <a href="coffee.php"><li class = "coffee">coffee</li></a>
                    <a href="tea.php"><li class = "tea">tea</li></a>
                    <a href="pop.php"><li calss = "pop">soft drinks</li></a>
                  </ul>
                </div>
                <div class = "foodMenu">
                  <p id = "food">food</p>
                  <ul class = "subMenu">
                    <a href="cookie.php"><li class = "cookie">cookie</li></a>
                    <a href="muffin.php"><li class = "muffin">muffin</li></a>
                    <a href="donut.php"><li class = "donut">donut</li></a>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- team members (us) -->
          <div class = "navRight">
            <a href = "aboutus.php" id = "aboutUs">about us </a>
          </div>
        </div>
      </header>

<!--
    <form action="searchcustomer.php" method="get" id="searchForm">
      <input type = "text" name ="searchcustomer">
      <input type = "submit" value = "Submit">
    </form>

-->
    <?php
    //list all customers
    include 'db_credential.php';
    $conn = mysqli_connect($host, $user, $password, $database);
    $error = mysqli_connect_error();

    if($error != null)
    {
      $output = "<p>Unable to connect to database!</p>";
      exit($output);
    }
    else {
      $sql = "SELECT * FROM customer";
      $results = mysqli_query($conn, $sql);
      //echo '<a href="adminPage.php">BACK TO ADMIN HOMEPAGE</a>';

      //echo cid email fName lName address cPassword phoneNum isAdmin
      echo '<div class = "table">
            <table id = "listcustomer">
              <tbody>
                  <tr>
                    <th class = "tableHead">CUSTOMER ID</th>
                    <th class = "tableHead">EMIAL</th>
                    <th class = "tableHead">FIRST NAME</th>
                    <th class = "tableHead">LAST NAME</th>
                    <th class = "tableHead">ADDRESS</th>
                    <th class = "tableHead">PHONE NUMBER</th>
                    <th class = "tableHead">ANDMIN</th>
                    <th class = "tableHead">disabled</th>
                  </tr>';
      while ($row = mysqli_fetch_assoc($results)) {
        //get all value
        $cid = $row['cid'];
        $email = $row['email'];
        $fName = $row['fName'];
        $lName = $row['lName'];
        $address = $row['address'];
        $phoneNum = $row['phoneNum'];
        if ($row['isAdmin']==0) {//remind kenney isset session tmr
          $isAdmin = 'NO';
        }
        else {
          $isAdmin = 'YES';
        }

        if ($row['disabled'] ==1 ) {
          $disabled = 'YES';
          $link = '<a class ="blue"   href = "enable_customer.php?id= '.$cid.' ">ENABLE THIS ACCOUNT</a>';
        }
        else {
          $disabled = 'NO';
          $link = '<a class = "red" href = "disable_customer.php?id= '.$cid.' ">DISABLE THIS ACCOUNT</a>';
        }

        echo
        '<tr class = "">
          <td> '.$cid.' </td>
          <td> '.$fName.' </td>
          <td> '.$lName.' </td>
          <td> '.$email.' </td>
          <td> '.$address. '</td>
          <td> '.$phoneNum.' </td>
          <td> '.$isAdmin.' </td>
          <td> '.$disabled.' </td>
          <td>'.$link.'</td>
         </tr>';
      }

      echo     '</tbody>
              </table>
            </div>';
      mysqli_close($conn);
    }



    ?>
    <?php include 'footer.php';?>

  </body>
</html>
