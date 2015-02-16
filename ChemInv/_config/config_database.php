<?php
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	
	if (!isset($_SESSION['host']) || !isset($_SESSION['username'])
	 || !isset($_SESSION['password']) || !isset($_SESSION['dbName'])){
		$file = fopen(DATA_PATH."database_configuration.txt", "r");
		
		fgets($file);
		$_SESSION['host'] = trim(fgets($file));
		fgets($file);
		$_SESSION['username'] = trim(fgets($file));
		fgets($file);
		$_SESSION['password'] = trim(fgets($file));
		fgets($file);
		$_SESSION['dbName'] = trim(fgets($file));
		
		fclose($file);
	}
	
	$host = $_SESSION['host'];
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$dbName = $_SESSION['dbName'];
	
	$_SESSION['dbi']->connect($username, $password, $host, $dbName, true);
?>