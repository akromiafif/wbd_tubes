<?php
	if (!isset($_COOKIE["username"])) {
		header('location: login.php');
	}

	if (isset($_POST["logout"])) {
		setcookie("username", $_COOKIE["username"], time() - 3600, "/");
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Login And Registration To Sqlite Using PDO</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<form method="POST" action="">
			<button type="submit" name="logout">Logout</button>
		</form>
		
		<h1>Welcome User!</h1>
	</div>
</body>
</html>