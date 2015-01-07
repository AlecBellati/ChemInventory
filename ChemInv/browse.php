<?php
	include 'functions.php';
	
	// The starting page code
	pageStart('Home');
	setupConnection();
	session_start();
	
	// Process the form request
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Process the scroll input
		$scroll = $_POST["scroll"];
		if ($scroll == "Back"){
			$_SESSION['resultsStart'] -= $_SESSION['resultsSize'];
		} else if ($scroll == "Next"){
			$_SESSION['resultsStart'] += $_SESSION['resultsSize'];
		}
	}
	
	// Create a table of chemicals
	print '<table border="1">';
	print '	<tr>
				<td>Chemical:</td>
				<td>Room:</td>
			</tr>';
	
	$query = "SELECT ChemicalName,Room FROM chemical";
	
	// Get the search conditions if any
	$chemical = $_SESSION['chemical'];
	$room = $_SESSION['room'];
	if ($chemical != ''){
		$query .= " WHERE ChemicalName RLIKE '".$chemical."'";
		
		if ($room != ''){
			$query .= " AND Room RLIKE '".$room."'";
		}
	}
	else if ($room != ''){
		$query .= " WHERE Room RLIKE '".$room."'";
	}
	
	$query .= " ORDER BY ChemicalName ASC LIMIT ".$_SESSION['resultsStart'].",".$_SESSION['resultsSize'];
	
	if ($result = mysql_query($query)){
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
			print '	<tr>
						<td>'.$row["ChemicalName"].'</td>
						<td>'.$row["Room"].'</td>
					</tr>';
		}
	}
	print '</table>';
	
	$query = 'SELECT COUNT(*) FROM chemical';
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	// Form to scroll the results table
	print '<form method="POST" action="forms/scroll_form.php" id="scrollform" name="scrollform">';
	
	if ($_SESSION['resultsStart'] > 0){
		print inputButton('scroll','Back');
	}
	if ($_SESSION['resultsStart'] + $_SESSION['resultsSize'] < $size){
		print inputButton('scroll','Next');
	}
	
	print '</form>';
	
	// The ending page code
	pageEnd();
	
?>
