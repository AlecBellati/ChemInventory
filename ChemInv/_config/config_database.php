<?php
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	
	if (!isset($_SESSION['dbUsername']) || !isset($_SESSION['dbPassword'])
	 || !isset($_SESSION['dbHost']) || !isset($_SESSION['dbName'])){
		$file = fopen(CONFIG_PATH."database_settings.txt", "r");
		
		fgets($file);
		$_SESSION['dbUsername'] = trim(fgets($file));
		fgets($file);
		$_SESSION['dbPassword'] = trim(fgets($file));
		fgets($file);
		$_SESSION['dbHost'] = trim(fgets($file));
		fgets($file);
		$_SESSION['dbName'] = trim(fgets($file));
	}
	
	$username = $_SESSION['dbUsername'];
	$password = $_SESSION['dbPassword'];
	$host = $_SESSION['dbHost'];
	$dbName = $_SESSION['dbName'];
	
	$_SESSION['dbi']->connect($username, $password, $host, $dbName, true);
?>