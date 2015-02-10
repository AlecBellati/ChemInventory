<?php
	if(!defined("ROOT_PATH")){
		define("ROOT_PATH", "./");
		$home = true;
	}
	else{
		$home = false;
	}
	
	define("CONFIG_PATH", ROOT_PATH."_config/");
	
	require_once(CONFIG_PATH."config_paths.php");
	require_once(CONFIG_PATH."config_setup.php");
	require_once(CONFIG_PATH."config_database.php");
	require_once(CONFIG_PATH."config_error.php");
	require_once(FUNCTIONS_PATH."admin_funcs.php");
	
	if($home){
		require_once(CLASSES_PATH."/ChemicalParser.php");
		
		$_SESSION['pageTitle'] = "Home";
	}
?>