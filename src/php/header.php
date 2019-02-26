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
      <form action="searchProducts.php" method="get">
        <input type = "text" name ="search_product" class = "search">
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
            //session_start();
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
              <a href="orderhistory.php"><li class = "yourorder">Your Orders</li></a>
              <a href="register.php"><li class = "yourorder">Sign Up</li></a>
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
                <a href="browseCategory.php?itemCategory=coffee"><li class = "coffee">coffee</li></a>
                <a href="tea.php?itemCategory=tea"><li class = "tea">tea</li></a>
                <a href="pop.php?itemCategory=pop"><li calss = "pop">soft drinks</li></a>
              </ul>
            </div>
            <div class = "foodMenu">
              <p id = "food">food</p>
              <ul class = "subMenu">
                <a href="cookie.php?itemCategory=cookie"><li class = "cookie">cookie</li></a>
                <a href="muffin.php?itemCategory=muffin"><li class = "muffin">muffin</li></a>
                <a href="donut.php?itemCategory=donut"><li class = "donut">donut</li></a>
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
