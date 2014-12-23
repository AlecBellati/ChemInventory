<?php
	include 'functions.php';
	
	// Create the starting code
	pageStart('Home');
	
	//setupConnection();
	
	// Process the search
	if(count($_GET) > 0){
		$chemical = $_GET['chemical'];
		$room = $_GET['room'];
		
		// Check if there is any input
		if ($chemical == '' && $room == ''){
			print 'Please enter a room or chemical';
		}
		else if ($chemical == 'Yung'){
			print 'Chemical: Yung Ngothai';
			print '<br />';
			print 'Type: Associate Professor';
			print '<br />';
			print 'Building: Engineering North';
			print '<br />';
			print 'Room: 212a';
			print '<br />';
		}
		else{
			print 'Sorry that chemical does not exist in our database';
		}
	}
	
	
	// Create a form to search for a chemical
	print '<form action="search.php" method \'get\'>';
	
	print inputText('Chemical: ','chemical','40','');
	print '<br />';
	print inputText('Room: ','room','20','');
	print '<br />';
	print inputButton('search','Search');
	
	print '</form>';
	
	// Create the ending code
	pageEnd();
	
?>
