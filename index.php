<?php session_start();?>
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
    <title>Dorayaki Shop</title>
  </head>
  <body>
    <?php
      if (!isset($_COOKIE["username"])) {
        header('location: pages/login.php');
      }
      require_once 'navbar.php';
      if(isset($_POST['product'])){
        $_SESSION['searchitem'] = $_POST['product'];
      }
      require 'functions/productDashboard.php';
    ?>
  </body>
</html>
