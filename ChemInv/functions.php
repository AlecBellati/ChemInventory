<?php
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
	define('CARGINOGEN_COL',12);
	define('CHEMICALWEAPON_COL',13);
	define('CSC_COL',14);
	define('OTOTOXIC_COL',15);
	define('RESTRICTEDHAZARDOUS_COL',16);
	
	// Connect to the database
	function databaseConnect(){
		// since we're testing, turn error reporting on 
		ini_set ('display_errors', TRUE);
		error_reporting (E_ALL);
		
		define ('DB_USER','root');
		define ('DB_PASSWORD','');
		define ('DB_HOST','localhost');
		
		//connect to the database
		$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
		if (!$conn){
			$err = oci_error ();
			print (htmlentities ($err['message']));
			exit ();
		}
		
		return $conn;
	}
	
	// Create the markup for the start of the web page
	function pageStart($title){
		//connect to the database
		$conn = databaseConnect();
		
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
		
		return $conn;
	}
	
	// Create the markup for the end of the web page
	function pageEnd(){
		mysql_close();
		
		print '	</body>
</html>';
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
	
	// Parse the excel data
	function parseData($filename,$conn){
		// Open the file
		$spreadsheet = PHPExcel_IOFactory::load($filename);
		
		for($rowNum = $spreadsheet->getHighestRow(); $rowNum > 1; $rowNum--){
			$chemical = $spreadsheet->getCell($rowNum,CHEMICAL_COL);
			$supplier = $spreadsheet->getCell($rowNum,SUPPLIER_COL);
			$primaryDGC = $spreadsheet->getCell($rowNum,PRIMARYDGC_COL);
			$packingGroup = $spreadsheet->getCell($rowNum,PACKINGGROUP_COL);
			$hazardous = $spreadsheet->getCell($rowNum,HAZARDOUS_COL);
			$poisonsSchedule = $spreadsheet->getCell($rowNum,POISONSSCHEDULE_COL);
			$quantity = $spreadsheet->getCell($rowNum,QUANTITY_COL);
			$unit = $spreadsheet->getCell($rowNum,UNIT_COL);
			$building = $spreadsheet->getCell($rowNum,BUILDING_COL);
			$floor = $spreadsheet->getCell($rowNum,FLOOR_COL);
			$room = $spreadsheet->getCell($rowNum,ROOM_COL);
			$campus = $spreadsheet->getCell($rowNum,CAMPUS_COL);
			$carginogen = $spreadsheet->getCell($rowNum,CARCINOGEN_COL);
			$chemicalWeapon = $spreadsheet->getCell($rowNum,CHEMICALWEAPON_COL);
			$CSC = $spreadsheet->getCell($rowNum,CSC_COL);
			$ototoxic = $spreadsheet->getCell($rowNum,OTOTOXIC_COL);
			$restrictedHazardous = $spreadsheet->getCell($rowNum,RESTRICTEDHAZARDOUS_COL);
			
			$sql = "insert into Building values('" + $building + "','" + $campus + "')";
			$conn.query($sql);
			
			$sql = "insert into Room values('" + $room + "','" + $floor + "','" + $building + "')";
			$conn.query($sql);
			
			$sql = "insert into Supplier values('" + $supplier + "')";
			$conn.query($sql);
			
			$sql = "insert into Chemical values('" + $chemical + "','" + $primaryDGC + "','" + $packingGroup + "','" + $hazardous + "','" + $poisonsSchedule + "','" + $quantity + "','" + $unit + "','" + $carcinogen + "', '" + $chemicalWeapon + "', '" + $CSC + "', '" + $ototoxic + "', '" + $restrictedHazardous + "', '" + $supplier + "','" + $room + "')";
			$conn.query($sql);
		}
	}
	
	
	
	
?>