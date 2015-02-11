<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	$table = $_SESSION['table'];
	echo '<form method="GET">';
	
	// Print the table
	echo $table->getTable();
	
	// Form to scroll the table
	echo '<br />';
	
	if (isset($_GET['campusId'])){
		echo inputHidden('campusId', $_GET['campusId']);
	}
	if (isset($_GET['buildingId'])){
		echo inputHidden('buildingId', $_GET['buildingId']);
	}
	if (isset($_GET['roomId'])){
		echo inputHidden('roomId', $_GET['roomId']);
	}
	if (isset($_GET['chemicalName'])){
		echo inputHidden('chemicalName', $_GET['chemicalName']);
	}
	if (isset($_GET['roomName'])){
		echo inputHidden('roomName', $_GET['roomName']);
	}
	
	
	if ($table->getPage() > 1){
		echo inputButton('action','Back');
	}
	if (!$table->endReached()){
		echo inputButton('action','Next');
	}
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>