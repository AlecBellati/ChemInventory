<?php
	include 'functions.php';
	
	// The starting page code
	pageStart('Home');
	setupConnection();
	session_start();
	
	$_SESSION['lastPage'] = 'search';
	
	// Process the search
	if(count($_GET) > 0){
		$chemical = $_GET['chemical'];
		$room = $_GET['room'];
		
		// Check if there is any input
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
	print '<form action="search.php" method \'get\'>';
	
	print inputText('Chemical: ','chemical','40','');
	print '<br />';
	print inputText('Room: ','room','20','');
	print '<br />';
	print inputButton('search','Search');
	
	print '</form>';
	
	// The ending page code
	pageEnd();
	
?>
