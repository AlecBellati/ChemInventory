<?php
	include 'schema.php';
	include 'lib/PHPExcel.php';
	
	define('CHEMICAL_COL',0);
	define('SUPPLIER_COL',1);
	define('PRIMARYDGC_COL',2);
	define('PACKINGGROUP_COL',3);
	define('HAZARDOUS_COL',4);
	define('POISONSSCHEDULE_COL',5);
	define('QUANTITY_COL',6);
	define('UNIT_COL',7);
	define('BUILDING_COL',8);
	define('FLOOR_COL',9);
	define('ROOM_COL',10);
	define('CAMPUS_COL',11);
	define('CARCINOGEN_COL',12);
	define('CHEMICALWEAPON_COL',13);
	define('CSC_COL',14);
	define('OTOTOXIC_COL',15);
	define('RESTRICTEDHAZARDOUS_COL',16);
	
	// Connect to the database
	function databaseConnect(){
		// Since we're testing, turn error reporting on 
		ini_set ('display_errors', TRUE);
		error_reporting (E_ALL);
		
		define ('DB_USER','root');
		define ('DB_PASSWORD','');
		define ('DB_HOST','localhost');
		
		// Connect to the server
		$conn = @mysql_pconnect(DB_HOST,DB_USER,DB_PASSWORD);
		if (!$conn){
			$err = oci_error ();
			print (htmlentities ($err['message']));
			exit ();
		}
		
		// Connect to the database
		mysql_select_db('inventory',$conn);
		
		return $conn;
	}
	
	// Setup the connection to the database
	function setupConnection(){
		$conn = databaseConnect();
		
		// Create the tables in the database
		//dropTables($conn);
		//createTables($conn);
		
		//parseData('ChemicalDatabase.xlsx',$conn);
		
		//mysql_close();
	}
	
	// Create the markup for the start of the web page
	function pageStart($title){
		//print start html code
		print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>';
		if($title != ""){
			print $title;
		}
		else{
			print '????';
		}
		print '</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>';
	}
	
	// Create the markup for the end of the web page
	function pageEnd(){
		// Text links
		print '<br />';
		print '<br />';
		
		print '<form method="POST" action="search.php" id="linkform" name="linkform">';
		
		print '<input type="hidden" id="link" name="link" value="">';
		print textLinkForm('Search','linkform','link','search');
		print ' | ';
		print textLinkForm('Browse','linkform','link','browse');
		
		print '</form>';
		
		// End markup
		print '	</body>
</html>';
	}
	
	// Create the code for the link handler
	function linkHandler($link){
		if ($link == "search"){
			header("Location:search.php");
		}
		else if ($link == "browse"){
			header("Location:browse.php");
		}
	}
	
	// Create a text box
	function inputText($label,$name,$size,$initial){
		if($initial != ''){
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' value='.$initial.' /></label>';
		}
		else{
			$input = '<label>'.$label.' <input type="text" name='.$name.' size='.$size.' /></label>';
		}
		return $input;
	}
	
	// Create a button
	function inputButton($name,$value){
		return '<input type="submit" name="'.$name.'" value="'.$value.'" />';
	}
	
	// Create a text link to a url
	function textLinkUrl($title,$url){
		
		return '<a href="'.$url.'">'.$title.'</a>';
	}
	
	// Create a text link to a form
	function textLinkForm($title,$form,$field,$value){
		return '<a href="javascript: submit('."'".$form."','".$field."','".$value."'".')">'.$title.'</a>';
	}
	
	// Parse the excel data
	function parseData($filename,$conn){
		// Open the file
		$file = PHPExcel_IOFactory::load($filename);
		$worksheet = $file->getActiveSheet();
		
		// Read each row
		for($rowNum = 2; $rowNum <= $worksheet->getHighestRow(); $rowNum++){
			$cell = $worksheet->getCellByColumnAndRow(CHEMICAL_COL,$rowNum);
			$chemical = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(SUPPLIER_COL,$rowNum);
			$supplier = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(PRIMARYDGC_COL,$rowNum);
			$primaryDGC = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(PACKINGGROUP_COL,$rowNum);
			$packingGroup = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(HAZARDOUS_COL,$rowNum);
			$hazardous = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(POISONSSCHEDULE_COL,$rowNum);
			$poisonsSchedule = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(QUANTITY_COL,$rowNum);
			$quantity = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(UNIT_COL,$rowNum);
			$unit = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(BUILDING_COL,$rowNum);
			$building = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(FLOOR_COL,$rowNum);
			$floor = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(ROOM_COL,$rowNum);
			$room = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(CAMPUS_COL,$rowNum);
			$campus = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(CARCINOGEN_COL,$rowNum);
			$carcinogen = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(CHEMICALWEAPON_COL,$rowNum);
			$chemicalWeapon = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(CSC_COL,$rowNum);
			$CSC = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(OTOTOXIC_COL,$rowNum);
			$ototoxic = $cell->getValue();
			$cell = $worksheet->getCellByColumnAndRow(RESTRICTEDHAZARDOUS_COL,$rowNum);
			$restrictedHazardous = $cell->getValue();
			
			$sql = "insert into Building values('" . $building . "','" . $campus . "')";
			mysql_query($sql);
			
			$sql = "insert into Room values('" . $room . "','" . $floor . "','" . $building . "')";
			mysql_query($sql);
			
			$sql = "insert into Supplier values('" . $supplier . "')";
			mysql_query($sql);
			
			$sql = "insert into Chemical values('" . $rowNum . "','" . $chemical . "', '" . $supplier . "','" . $primaryDGC . "','" . $packingGroup . "','" . $hazardous . "','" . $poisonsSchedule . "','" . $quantity . "','" . $unit . "','" . $room . "','" . $carcinogen . "', '" . $chemicalWeapon . "', '" . $CSC . "', '" . $ototoxic . "', '" . $restrictedHazardous . "')";
			mysql_query($sql);
		}
	}
	
	
	
	
?>

<script type="text/javascript">
	function submit(form,field,value){
		document.getElementById(field).value = value;
		document.forms[form].submit();
	}
	
</script>