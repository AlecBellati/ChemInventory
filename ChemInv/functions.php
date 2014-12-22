<?php
	// Connect to the database
	function databaseConnect()
	{
		// since we're testing, turn error reporting on 
		ini_set ('display_errors', TRUE);
		error_reporting (E_ALL);
		
		define ('DB_USER','root');
		define ('DB_PASSWORD','');
		define ('DB_HOST','localhost');
		
		//connect to the database
		$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
		if (!$conn)
		{
			$err = oci_error ();
			print (htmlentities ($err['message']));
			exit ();
		}
		
		return $conn;
	}
	
	// Create the markup for the start of the web page
	function pageStart($title)
	{
		//connect to the database
		$conn = databaseConnect();
		
		//print start html code
		print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>';
		if($title != "")
		{
			print $title;
		}
		else
		{
			print '????';
		}
		print '</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>';
		
		return $conn;
	}
	
	// Create the markup for the end of the web page
	function pageEnd()
	{
		mysql_close();
		
		print '	</body>
</html>';
	}
	
	// Create a text box
	function inputText($label,$name,$size,$initial)
	{
		if($initial != '')
		{
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' value='.$initial.' /></label>';
		}
		else
		{
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' /></label>';
		}
		return $input;
	}
	
	// Create a button
	function inputButton($name,$value)
	{
		return '<input type="submit" name="'.$name.'" value="'.$value.'" />';
	}
?>