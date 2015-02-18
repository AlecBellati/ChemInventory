<?php
	require_once(CLASSES_PATH."DatabaseInterface.php");
	
	ini_set ('display_errors', TRUE);
	error_reporting (E_ALL);
	date_default_timezone_set("Australia/Adelaide");
	session_start();
	
	define('DEFAULT_TABLE_SIZE',25);
	
	if (isset($_POST['action'])){
		$action = $_POST['action'];
	}
	else if (isset($_GET['action'])){
		$action = $_GET['action'];
	}
	else {
		$action = "";
	}
?>