<?php
	ini_set ('display_errors', TRUE);
	error_reporting (E_ALL);
	date_default_timezone_set("Australia/Adelaide");
	
	define("DB_DSN", "mysql:host=localhost;dbname=inventory");
	define("DB_HOST","localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME","inventory");
	define('DEFAULT_RESULTS_SIZE',25);
	
	define("CLASSES_PATH", "classes");
	define("FORMS_PATH", "forms");
	define("FUNCTIONS_PATH", "functions");
	define("LIB_PATH", "lib");
	define("SCHEMA_PATH", "schema");
	define("TEMPLATES_PATH", "templates");
	
?>