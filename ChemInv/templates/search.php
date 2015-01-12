<?php
	include "templates/include/header.php";
	
	require_once 'functions/markup_funcs.php';
	require_once 'functions/db_funcs.php';
	
	// The starting page code
	databaseConnect();
	session_start();
	
	// Process the form request
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Process the search input
		$_SESSION["chemical"] = $_POST["chemical"];
		$_SESSION["room"] = $_POST["room"];
		$chemical = $_SESSION["chemical"];
		$room = $_SESSION["room"];
		
		if ($chemical != '' && $room != ''){
			$query = "SELECT ChemicalName FROM chemical WHERE ChemicalName='" . $chemical . "' AND Room='" . $room . "'";
			if ($result = mysql_query($query)){
				while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
					print $row["ChemicalName"];
					print '<br />';
				}
			}
		}
		else if ($chemical != ''){
			$query = "SELECT ChemicalName FROM chemical WHERE ChemicalName='" . $chemical . "'";
			if ($result = mysql_query($query)){
				while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
					print $row["ChemicalName"];
					print '<br />';
				}
			}
		}
		else if ($room != ''){
			$query = "SELECT ChemicalName FROM chemical WHERE Room='" . $room . "'";
			if ($result = mysql_query($query)){
				while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
					print $row["ChemicalName"];
					print '<br />';
				}
			}
		}
		else{
			print 'Please enter a room or chemical';
		}
	}
	
	
	// Form to search for a chemical
	print '<form method="POST" action="forms/search_form.php" id="searchform" name="searchform">';
	
	print inputText('Chemical: ','chemical','40','');
	print '<br />';
	print inputText('Room: ','room','20','');
	print '<br />';
	print inputButton('search','Search');
	
	print '</form>';
	
	include "templates/include/footer.php";
?>