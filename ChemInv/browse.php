<?php
	include 'functions.php';
	
	// The starting page code
	pageStart('Home');
	setupConnection();
	session_start();
	
	// Process the form request
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Process the link input
		$link = $_POST["link"];
		if ($link != ''){
			linkHandler($link);
		}
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
	print '<form method="POST" action="browse.php" id="browseform" name="browseform">';
	
	print '</form>';
	
	// The ending page code
	pageEnd();
	
?>
