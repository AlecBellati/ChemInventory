<?php
	ini_set ('display_errors', TRUE);
	error_reporting (E_ALL);
	date_default_timezone_set("Australia/Adelaide");
	
	define("DB_HOST","localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME","inventory");
	define('DEFAULT_TABLE_SIZE',25);
	
	define("CLASSES_PATH", ROOT_PATH."classes/");
	define("FUNCTIONS_PATH", ROOT_PATH."functions/");
	define("LIB_PATH", ROOT_PATH."lib/");
	define("SCHEMA_PATH", ROOT_PATH."schema/");
	define("STYLESHEETS_PATH", ROOT_PATH."stylesheets/");
	define("TEMPLATES_PATH", ROOT_PATH."templates/");
	
	require_once(ROOT_PATH."config_error.php");
?>