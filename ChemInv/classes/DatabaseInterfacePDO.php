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
	
	class DatabaseInterface{
		private $conn;
		
		// Constructor
		function __construct(){}
		
		// Connect to the database
		public function connect($_user,$_pass,$_host,$_db, $_persist){
			try{
				$this->conn = new PDO(
					"mysql:host=".$_host.";dbname=".$_db,
					$_user,
					$_pass,
					array(PDO::ATTR_PERSISTENT => $_persist));
			} catch(PDOException $e){
				return 0;
			}
			
			return 1;
		}
		
		// Disconnect from the database
		public function disconnect(){
			$this->conn = null;
		}
		
		// Parse a given query
		public function query($query){
			try{
				return $this->conn->query($query);
			} catch(PDOException $e){
				return 0;
			}
		}
		
		// Setup the database
		public function setupDatabase(){
			// Create the tables in the database
			dropTables();
			createTables();
			
			// Parse the dataset
			parseData('data/ChemicalDatabase.xlsx');
		}
		
		// Create the tables in the database
		private function createTables(){
			createTableBuilding($this->conn);
			createTableRoom($this->conn);
			createTableSupplier($this->conn);
			createTableChemical($this->conn);
		}
		
		// Drop the tables in the database
		private function dropTables(){
			dropTableChemical($this->conn);
			dropTableSupplier($this->conn);
			dropTableRoom($this->conn);
			dropTableBuilding($this->conn);
		}
		
		// Parse the excel data
		private function parseData($filename){
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
				
				$query = "insert into Building values('" . $building . "','" . $campus . "')";
				$this->query($query);
				
				$query = "insert into Room values('" . $room . "','" . $floor . "','" . $building . "')";
				$this->query($query);
				
				$query = "insert into Supplier values('" . $supplier . "')";
				$this->query($query);
				
				$query = "insert into Chemical values('" . $rowNum . "','" . $chemical . "', '" . $supplier . "','" . $primaryDGC . "','" . $packingGroup . "','" . $hazardous . "','" . $poisonsSchedule . "','" . $quantity . "','" . $unit . "','" . $room . "','" . $carcinogen . "', '" . $chemicalWeapon . "', '" . $CSC . "', '" . $ototoxic . "', '" . $restrictedHazardous . "')";
				$this->query($query);
			}
		}
	}
?>
