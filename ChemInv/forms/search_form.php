<?php
	session_start();
	
	// Process the link input
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Process the search input
		$_SESSION["chemical"] = $_POST["chemical"];
		$_SESSION["room"] = $_POST["room"];
		
		if ($_SESSION["chemical"] == "" && $_SESSION["room"] == ""){
			header("Location:../search.php");
			print 'Please enter a room or chemical';
		}
		else{
			header("Location:../browse.php");
		}
	}
	else{
		// Default to the search page if the user manually goes to this page
		header("Location:../search.php");
	}
?>
