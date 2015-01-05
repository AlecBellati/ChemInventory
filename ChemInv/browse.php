<?php
	include 'functions.php';
	
	// The starting page code
	pageStart('Home');
	setupConnection();
	session_start();
	
	if ($_SESSION['lastPage'] != 'browse'){
		$_SESSION['limitStart'] = 0;
		$_SESSION['limitEnd'] = 25;
		
		$_SESSION['lastPage'] = 'browse';
	}
	else{
		$_SESSION['limitStart'] += 25;
		$_SESSION['limitEnd'] += 25;
	}
	
	
	// Process the search
	if(count($_GET) > 0){
		
	}
	
	// Create a table of chemicals
	print '<table border="1">';
	print '	<tr>
				<td>Chemical:</td>
				<td>Room:</td>
			</tr>';
	$query = "SELECT ChemicalName,Room FROM chemical LIMIT ".$_SESSION['limitStart'].",".$_SESSION['limitEnd'];
	if ($result = mysql_query($query)){
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
			print '	<tr>
						<td>'.$row["ChemicalName"].'</td>
						<td>'.$row["Room"].'</td>
					</tr>';
		}
	}
	print '</table>';
	
	
	
	// Form to search for a chemical
	print '<form action="search.php" method \'get\'>';
	
	print '</form>';
	
	// The ending page code
	pageEnd();
	
?>
