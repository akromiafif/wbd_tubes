<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../img/logo.svg" type="image/x-icon" />
    <title>Dorayaki Shop</title>
    <title>Register</title>
  </head>
  <body>
    <div class="container">
      <div class="login">
        <div>
          <img src="../img/logo_txt.svg" />
        </div>

        <form method="POST" action="../functions/register_function.php">
          <div class="data">
						<input
              type="text"
              placeholder="Email"
              name="email"
              id="email"
            />
            <input
              type="text"
              placeholder="Username"
              name="username"
              id="username"
            />
            <input
              type="password"
              placeholder="Password"
              name="password"
              id="password"
            />
            <div class="error" id="err-text">
                
            </div>
            <?php if(isset($_SESSION['error'])): ?>
              <div class="error">
                <p><?php echo $_SESSION['error']?></p>
              </div>
              
            <?php endif; session_unset(); ?>
            <button type="submit" name="register">Register</button>
          </div>
        </form>
      </div>
    </div>
    <script src="../js/register.js"></script>
  </body>
</html>
