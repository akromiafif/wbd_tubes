<?php
	// check if the database file exists and create a new if not
	if(!is_file('../db/dorayaki.db')){
		file_put_contents('../db/dorayaki.db', null);
	}

	// connecting the database
	$connection = new PDO('sqlite:../db/dorayaki.db');
	
	// setting connection attributes
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// query for creating reating the member table in the database if not exist yet.
	$query = "CREATE TABLE IF NOT EXISTS member(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR, username VARCHAR, password VARCHAR, is_admin INT)";
	
	// executing the query
	$connection->exec($query);
?>