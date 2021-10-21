<?php
  require_once "functions/user_function.php";
  
  if (isset($_POST["logout"])) {
		setcookie("username", $_COOKIE["username"], time() - 3600, "/");
		header('location: pages/login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="img/logo.svg" type="image/x-icon" />
    <link rel="stylesheet" href="css/navbar.css" />
  </head>
  <body>
    <div class="navbar">
      <div>
        <a href="index.php"><img src="img/logo.svg"/></a>
      </div>
      <div class="search">
        <?php if(isset($_SESSION['error'])): ?>
              <div class="error">
                <p><?php echo $_SESSION['error']?></p>
              </div>
              
            <?php endif; session_unset(); ?>

        <?php 
          if (isset($_COOKIE["username"])) {
            $connection = new PDO("sqlite:"."db/dorayaki.db");
            $username = $_COOKIE['username'];
    
            $is_admin = $connection->query("SELECT count(*) FROM member WHERE username = '$username' AND is_admin = 1")->fetchColumn();
    
            if ($is_admin == 1) {
              ?>
              <p>Admin</p>
              <?php 
            } else {
              ?>
                <a><?php echo $username; ?></a>
              <?php
            }
            ?>
              <form method="POST" action="">
                    <button class="register" type="submit" name="logout">Logout</button>
              </form>
              <form method="POST" action="index.php">
                  <input type="text" name="product" placeholder="Cari Varian" id="keyword" />
                  <button class="register" type="submit" name="search">Cari</button>
              </form>
            <?php

          } else { 
          ?>
            <a class="register" href="pages/register.php">Sign Up</a>
            <a class="register" href="pages/login.php">Login</a>
          <?php } ?>
      </div>
    </div>
  </body>
</html>
