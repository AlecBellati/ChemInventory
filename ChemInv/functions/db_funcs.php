<?php
	require_once SCHEMA_PATH.'/building_schema.php';
	require_once SCHEMA_PATH.'/chemical_schema.php';
	require_once SCHEMA_PATH.'/room_schema.php';
	require_once SCHEMA_PATH.'/supplier_schema.php';
	require_once LIB_PATH.'/PHPExcel.php';
	
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
	
	// Setup the database
	function setupDatabase(){
		$conn = databaseConnect();
		
		// Create the tables in the database
		dropTables($conn);
		createTables($conn);
		
		// Parse the dataset
		parseData('data/ChemicalDatabase.xlsx',$conn);
		
		mysql_close();
	}
	
	// Create the tables in the database
	function createTables($conn){
		createTableBuilding($conn);
		createTableRoom($conn);
		createTableSupplier($conn);
		createTableChemical($conn);
	}
	
	// Drop the tables in the database
	function dropTables($conn){
		dropTableChemical($conn);
		dropTableSupplier($conn);
		dropTableRoom($conn);
		dropTableBuilding($conn);
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