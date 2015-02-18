<?php
	define("NO_ERROR", 0);
	define("UPLOAD_WRONG_FILETYPE", 1);
	define("INVALID_USERNAME", 2);
	define("USERNAME_MISSING", 3);
	define("USERNAME_WRONGSIZE", 4);
	define("USERNAME_WRONGCHAR", 5);
	define("USERNAME_TAKEN", 6);
	define("FIRSTNAME_MISSING", 7);
	define("FIRSTNAME_WRONGCHAR", 8);
	define("LASTNAME_MISSING", 9);
	define("LASTNAME_WRONGCHAR", 10);
	define("PASSWORD_MISSING", 11);
	define("PASSWORD_NOMATCH", 12);
	define("PASSWORD_WRONGSIZE", 13);
	define("PASSWORD_WRONGCHAR", 14);
	define("WRONG_PASSWORD", 15);
	
	$error = NO_ERROR;
?>