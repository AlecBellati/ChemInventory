<?php
	include 'functions.php';
	
	// Create the starting code
	pageStart('Home');
	
	// Process the search
	if(count($_GET) > 0)
	{
		$chemical = $_GET['chemical'];
		$room = $_GET['room'];
		
	}
	
	
	// Create a form to search for a chemical
	print '<form action="search.php" method \'get\'>';
	
	print inputText('Chemical: ','chemical','20','');
	print '<br />';
	print inputText('Room: ','room','20','');
	print '<br />';
	print inputButton('search','Search');
	
	print '</form>';
	
	// Create the ending code
	pageEnd();
	
?>
