<?php
	require_once LIB_PATH.'PHPExcel.php';
	
	define('CHEMICAL_COL','A');
	define('CHEMICAL_TITLE','Chemical');
	define('SUPPLIER_COL','B');
	define('SUPPLIER_TITLE','Supplier');
	define('PRIMARYDGC_COL','C');
	define('PRIMARYDGC_TITLE','Primary DGC');
	define('PACKINGGROUP_COL','D');
	define('PACKINGGROUP_TITLE','Packing Group');
	define('HAZARDOUS_COL','E');
	define('HAZARDOUS_TITLE','Hazardous');
	define('POISONSSCHEDULE_COL','F');
	define('POISONSSCHEDULE_TITLE','Poisons Schedule');
	define('AMOUNT_COL','G');
	define('AMOUNT_TITLE','Amount');
	define('UNIT_COL','H');
	define('UNIT_TITLE','Unit');
	define('BUILDING_COL','I');
	define('BUILDING_TITLE','Building');
	define('LEVEL_COL','J');
	define('LEVEL_TITLE','Level');
	define('ROOM_COL','K');
	define('ROOM_TITLE','Room');
	define('CAMPUS_COL','L');
	define('CAMPUS_TITLE','Campus');
	define('CARCINOGEN_COL','M');
	define('CARCINOGEN_TITLE','Carcinogen');
	define('CHEMICALWEAPON_COL','N');
	define('CHEMICALWEAPON_TITLE','Chemical Weapon');
	define('CSC_COL','O');
	define('CSC_TITLE','CSC');
	define('OTOTOXIC_COL','P');
	define('OTOTOXIC_TITLE','Ototoxic');
	define('RESTRICTEDHAZARDOUS_COL','Q');
	define('RESTRICTEDHAZARDOUS_TITLE','Restricted Hazardous');
	
	class DatabaseExporter{
		// The database interface
		private $dbi;
		private $excelObj;
		
		// Constructor
		function __construct($_dbi){
			$this->dbi = $_dbi;
		}
		
		// Create a copy of the database
		public function createDatabase(){
			$filename = "Chemical_Database";
			$this->setupFile($filename);
			$this->addHeader();
			$this->addRows();
			$this->saveFile($filename);
		}
		
		// Create a template of the database file
		public function createTemplate(){
			$filename = "Chemical_Database_Template";
			$this->setupFile($filename);
			$this->addHeader();
			$this->saveFile($filename);
		}
		
		// Create the file structure
		private function setupFile($_filename){
			$this->excelObj = new PHPExcel();
			$this->excelObj->getProperties()->setTitle($_filename);
			$this->excelObj->setActiveSheetIndex(0);
		}
		
		// Create the first row of the file
		private function addHeader(){
			if(isset($this->excelObj)){
				$worksheet = $this->excelObj->getActiveSheet();
				$worksheet->setCellValue(CHEMICAL_COL.'1', CHEMICAL_TITLE);
				$worksheet->setCellValue(SUPPLIER_COL.'1', SUPPLIER_TITLE);
				$worksheet->setCellValue(PRIMARYDGC_COL.'1', PRIMARYDGC_TITLE);
				$worksheet->setCellValue(PACKINGGROUP_COL.'1', PACKINGGROUP_TITLE);
				$worksheet->setCellValue(HAZARDOUS_COL.'1', HAZARDOUS_TITLE);
				$worksheet->setCellValue(POISONSSCHEDULE_COL.'1', POISONSSCHEDULE_TITLE);
				$worksheet->setCellValue(AMOUNT_COL.'1', AMOUNT_TITLE);
				$worksheet->setCellValue(UNIT_COL.'1', UNIT_TITLE);
				$worksheet->setCellValue(BUILDING_COL.'1', BUILDING_TITLE);
				$worksheet->setCellValue(LEVEL_COL.'1', LEVEL_TITLE);
				$worksheet->setCellValue(ROOM_COL.'1', ROOM_TITLE);
				$worksheet->setCellValue(CAMPUS_COL.'1', CAMPUS_TITLE);
				$worksheet->setCellValue(CARCINOGEN_COL.'1', CARCINOGEN_TITLE);
				$worksheet->setCellValue(CHEMICALWEAPON_COL.'1', CHEMICALWEAPON_TITLE);
				$worksheet->setCellValue(CSC_COL.'1', CSC_TITLE);
				$worksheet->setCellValue(OTOTOXIC_COL.'1', OTOTOXIC_TITLE);
				$worksheet->setCellValue(RESTRICTEDHAZARDOUS_COL.'1', RESTRICTEDHAZARDOUS_TITLE);
				
				return true;
			}
			
			return false;
		}
		
		// Create the rows of the file
		private function addRows(){
			if(isset($this->excelObj)){
				$query = "SELECT * FROM";
				$query .= " campus JOIN building ON campus.ID=building.CampusID";
				$query .= " JOIN room ON building.ID=room.BuildingID";
				$query .= " JOIN chemical ON room.ID=chemical.RoomID";
				$query .= " JOIN supplier ON supplier.ID=chemical.SupplierID";
				
				$rowNum = 1;
				if ($result = $this->dbi->query($query)){
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$rowNum++;
						$worksheet = $this->excelObj->getActiveSheet();
						$value = htmlspecialchars_decode($row['ChemicalName'],ENT_QUOTES);
						$worksheet->setCellValue(CHEMICAL_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['SupplierName'],ENT_QUOTES);
						$worksheet->setCellValue(SUPPLIER_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['PrimaryDGC'],ENT_QUOTES);
						$worksheet->setCellValue(PRIMARYDGC_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['PackingGroup'],ENT_QUOTES);
						$worksheet->setCellValue(PACKINGGROUP_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Hazardous'],ENT_QUOTES);
						$worksheet->setCellValue(HAZARDOUS_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['PoisonsSchedule'],ENT_QUOTES);
						$worksheet->setCellValue(POISONSSCHEDULE_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Amount'],ENT_QUOTES);
						$worksheet->setCellValue(AMOUNT_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Unit'],ENT_QUOTES);
						$worksheet->setCellValue(UNIT_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['BuildingName'],ENT_QUOTES);
						$worksheet->setCellValue(BUILDING_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Level'],ENT_QUOTES);
						$worksheet->setCellValue(LEVEL_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['RoomName'],ENT_QUOTES);
						$worksheet->setCellValue(ROOM_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['CampusName'],ENT_QUOTES);
						$worksheet->setCellValue(CAMPUS_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Carcinogen'],ENT_QUOTES);
						$worksheet->setCellValue(CARCINOGEN_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['ChemicalWeapon'],ENT_QUOTES);
						$worksheet->setCellValue(CHEMICALWEAPON_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['CSC'],ENT_QUOTES);
						$worksheet->setCellValue(CSC_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Ototoxic'],ENT_QUOTES);
						$worksheet->setCellValue(OTOTOXIC_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['RestrictedHazardous'],ENT_QUOTES);
						$worksheet->setCellValue(RESTRICTEDHAZARDOUS_COL.$rowNum, $value);
						
					}
				}
				
				
				return true;
			}
			
			return false;
		}
		
		// Save the excel file
		private function saveFile($_filename){
			$excelWriter = new PHPExcel_Writer_Excel2007($this->excelObj);
			$excelWriter->save(TMP_PATH.$_filename.".xlsx");
		}
		
	}
?>