<?php
	session_start();

	//including the database connectionection
	require_once 'database.php';
	
	if(ISSET($_POST['register'])){

		// Setting variables
		$email = $_POST['email'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$is_admin = 0;
		
		// Insertion Query
		$query = "INSERT INTO `member` (email, name, username, password, is_admin) VALUES(:email, :name, :username, :password, :is_admin)";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':is_admin', $is_admin);
		
		// Check if the execution of query is success
		if($stmt->execute()){
			
			//setting a 'success' session to save our insertion success message.
			$_SESSION['success'] = "Successfully created an account";

			//redirecting to the index.php 
			header('location: index.php');
		}

	}
?>