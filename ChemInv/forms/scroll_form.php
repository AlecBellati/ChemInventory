<?php
	include '../functions.php';
	session_start();
	
	// Process the link input
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Process the scroll input
		$scroll = $_POST["scroll"];
		
		if ($scroll == "Back"){
			$_SESSION['resultsStart'] -= $_SESSION['resultsSize'];
			header("Location:../browse.php");
		}
		else if ($scroll == "Next"){
			$_SESSION['resultsStart'] += $_SESSION['resultsSize'];
			header("Location:../browse.php");
		}
		// Default to the browse page if this point is reached
		// This should NEVER occur
		else{
			header("Location:../browse.php");
		}
	}
	else{
		// Default to the browse page if the user manually goes to this page
		header("Location:../browse.php");
	}
?>
