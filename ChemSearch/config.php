<?php
	define("ROOT_PATH", "./");
	
	require_once("config_pre.php");
	require_once(CLASSES_PATH."/ChemicalParser.php");
	require_once("config_post.php");
	
	$_SESSION['pageTitle'] = "Home";
?>