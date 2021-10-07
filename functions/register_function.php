<?php
	session_start();

	//including the database connectionection
	require_once '../database.php';
	
	if(isset($_POST['register'])){

		// Setting variables
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$is_admin = 0;
		
		// Insertion Query
		$query = "INSERT INTO `member` (email, username, password, is_admin) VALUES(:email, :username, :password, :is_admin)";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':is_admin', $is_admin);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "Invalid email address";
			header('location:../pages/register.php');
		} else if (checkUsername($username, $connection)) {
			$_SESSION['error'] = "Username already exist";
			header('location:../pages/register.php');
		} else if (checkUsernamePattern($username)) {
			$_SESSION['error'] = "Invalid username type";
			header('location:../pages/register.php');
		} else if (empty($_POST['password'])) {
			$_SESSION['error'] = "Invalid password";
			header('location:../pages/register.php');
		} else {
			if($stmt->execute()){
				$_SESSION['success'] = "Successfully created an account";

				header('location: ../pages/home.php');
			}
		}
	}

	function checkUsername($username, $connection) {
		$query = "SELECT COUNT(*) as count FROM `member` WHERE `username` = :username";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];

		if($count > 0){
			return true;
		}

		return false;
	}

	function checkUsernamePattern($username) {
		$pattern = "/[^A-Za-z0-9]+/";

		if (preg_match($pattern, $username)) {
			return true;
		}

		return false;
	}
?>