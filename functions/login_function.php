<?php
	session_start();
	require_once '../database.php';
	
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT COUNT(*) as count FROM `member` WHERE `username` = :username AND `password` = :password";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];
		
		if($count > 0){
			setcookie("username", $username, time() + (86400 * 30), "/");
			header('location:../pages/home.php');
		}else{
			$_SESSION['error'] = "Invalid username or password";
			header('location:../pages/login.php');
		}
	}
?>