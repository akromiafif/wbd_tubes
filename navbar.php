<?php //session_start()?>
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
        <form action="index.php" name="form2" method="POST">
          <input type="text" placeholder="Enter a Product" name="product">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <a class="register" href="pages/register.php">Sign Up</a>
        <a class="register" href="pages/login.php">Login</a>
      </div>
    </div>
  </body>
</html>
