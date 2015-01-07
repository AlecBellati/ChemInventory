<?php
	include '../functions.php';
	
	session_start();
	
	$_SESSION['resultsStart'] = 0;
	$_SESSION['resultsSize'] = DEFAULT_RESULTS_SIZE;
	$_SESSION['chemical'] = '';
	$_SESSION['room'] = '';
	
	// Process the link input
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$link = $_POST["link"];
		
		if ($link != ''){
			// Handle if the search page is requested
			if ($link == "search"){
				header("Location:../search.php");
			}
			// Handle if the browse page is requested
			else if ($link == "browse"){
				header("Location:../browse.php");
			}
		}
		// Default to the search page if this point is reached
		// This should NEVER occur
		else{
			header("Location:../search.php");
		}
	}
	else{
		// Default to the search page if the user manually goes to this page
		header("Location:../search.php");
	}
?>
