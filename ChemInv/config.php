<?php
	ini_set ('display_errors', TRUE);
	error_reporting (E_ALL);
	date_default_timezone_set("Australia/Adelaide");
	
	define("DB_DSN", "mysql:host=localhost;dbname=inventory");
	define("DB_HOST","localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME","inventory");
	
	define("CLASS_PATH", "classes");
	define("TEMPLATE_PATH", "templates");
	
?>