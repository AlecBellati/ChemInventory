<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$dbi = $_SESSION['dbi'];
	
	// Create a table of chemicals
	$chemicalsTable = new Table();
	$row = array("Chemical:", "Room:");
	$chemicalsTable->addRow($row);
	
	$query = "SELECT ID,ChemicalName,Room FROM chemical ";
	
	// Get the results in alphanumerical order
	$query .= " ORDER BY ChemicalName ASC LIMIT ".$_SESSION['resultsStart'].",".$_SESSION['resultsSize'];
	if ($result = $dbi->query($query)){
		while ($resultsRow = mysql_fetch_array($result, MYSQL_BOTH)){
			$link = '<a href="./?action=chemical&chemicalId='.$resultsRow["ID"].'">'.$resultsRow["ChemicalName"].'</a>';
			$tableRow = array($link,$resultsRow["Room"]);
			$chemicalsTable->addRow($tableRow);
		}
	}
	
	echo $chemicalsTable->outputTable();
	
	// Form to scroll the results table
	echo '<br />';
	
	$query = 'SELECT COUNT(*) FROM chemical ';
	$result = mysql_query($query);
	$size = mysql_result($result,0);
	
	echo '<form method="POST" action="./?action=viewChemicals">';
	
	if ($_SESSION['resultsStart'] > 0){
		echo inputButton('button','Back');
	}
	if ($_SESSION['resultsStart'] + $_SESSION['resultsSize'] < $size){
		echo inputButton('button','Next');
	}
	
	echo '</form>';
	
	// Go back to the search page
	echo '<br />';
	echo '<form method="POST" action="./?action=searchChemical">';
	echo inputButton('button','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>