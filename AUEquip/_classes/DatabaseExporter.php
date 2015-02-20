<?php
	require_once LIB_PATH.'PHPExcel.php';
	
	define('EQUIPMENT_COL','A');
	define('EQUIPMENT_TITLE','Equipment Name');
	define('FUNCTION_COL','B');
	define('FUNCTION_TITLE','What would you like to do?');
	define('WHATITDOES_COL','C');
	define('WHATITDOES_TITLE','What does it do?');
	define('WHATSAMPLE_COL','D');
	define('WHATSAMPLE_TITLE','What kind of sample do you need?');
	define('WHATINFORMATION_COL','E');
	define('WHATINFORMATION_TITLE','What information does this equipment give you?');
	define('BUILDING_COL','F');
	define('BUILDING_TITLE','Building');
	define('LEVEL_COL','G');
	define('LEVEL_TITLE','Level');
	define('ROOM_COL','H');
	define('ROOM_TITLE','Room');
	define('CAMPUS_COL','I');
	define('CAMPUS_TITLE','Campus');
	define('CONTACT_COL','J');
	define('CONTACT_TITLE','Contact');
	define('NUMBER_COL','K');
	define('NUMBER_TITLE','Number');
	define('EMAIL_COL','L');
	define('EMAIL_TITLE','Email');
	define('USAGEFEE_COL','M');
	define('USAGEFEE_TITLE','Usage Fee');
	
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
			$filename = "Equipment_Database";
			$this->setupFile($filename);
			$this->addHeader();
			$this->addRows();
			$this->saveFile($filename);
		}
		
		// Create a template of the database file
		public function createTemplate(){
			$filename = "Equipment_Database_Template";
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
				
				$worksheet->setCellValue(EQUIPMENT_COL.'1', EQUIPMENT_TITLE);
				$worksheet->setCellValue(FUNCTION_COL.'1', FUNCTION_TITLE);
				$worksheet->setCellValue(WHATITDOES_COL.'1', WHATITDOES_TITLE);
				$worksheet->setCellValue(WHATSAMPLE_COL.'1', WHATSAMPLE_TITLE);
				$worksheet->setCellValue(WHATINFORMATION_COL.'1', WHATINFORMATION_TITLE);
				$worksheet->setCellValue(BUILDING_COL.'1', BUILDING_TITLE);
				$worksheet->setCellValue(LEVEL_COL.'1', LEVEL_TITLE);
				$worksheet->setCellValue(ROOM_COL.'1', ROOM_TITLE);
				$worksheet->setCellValue(CAMPUS_COL.'1', CAMPUS_TITLE);
				$worksheet->setCellValue(CONTACT_COL.'1', CONTACT_TITLE);
				$worksheet->setCellValue(NUMBER_COL.'1', NUMBER_TITLE);
				$worksheet->setCellValue(EMAIL_COL.'1', EMAIL_TITLE);
				$worksheet->setCellValue(USAGEFEE_COL.'1', USAGEFEE_TITLE);
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
				$query .= " JOIN equipment ON room.ID=equipment.RoomID";
				$query .= " JOIN contact ON contact.ID=equipment.ContactID";
				$query .= " JOIN equipmentfunction ON equipment.ID=equipmentfunction.EquipmentID";
				$query .= " JOIN function ON function.ID=equipmentfunction.FunctionID";
				
				$rowNum = 1;
				if ($result = $this->dbi->query($query)){
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$rowNum++;
						$worksheet = $this->excelObj->getActiveSheet();
						
						$value = htmlspecialchars_decode($row['EquipmentName'],ENT_QUOTES);
						$worksheet->setCellValue(EQUIPMENT_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['FunctionName'],ENT_QUOTES);
						$worksheet->setCellValue(FUNCTION_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['WhatItDoes'],ENT_QUOTES);
						$worksheet->setCellValue(WHATITDOES_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['WhatSample'],ENT_QUOTES);
						$worksheet->setCellValue(WHATSAMPLE_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['WhatInformation'],ENT_QUOTES);
						$worksheet->setCellValue(WHATINFORMATION_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['BuildingName'],ENT_QUOTES);
						$worksheet->setCellValue(BUILDING_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Level'],ENT_QUOTES);
						$worksheet->setCellValue(LEVEL_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['RoomName'],ENT_QUOTES);
						$worksheet->setCellValue(ROOM_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['CampusName'],ENT_QUOTES);
						$worksheet->setCellValue(CAMPUS_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['ContactName'],ENT_QUOTES);
						$worksheet->setCellValue(CONTACT_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Number'],ENT_QUOTES);
						$worksheet->setCellValue(NUMBER_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['Email'],ENT_QUOTES);
						$worksheet->setCellValue(EMAIL_COL.$rowNum, $value);
						$value = htmlspecialchars_decode($row['UsageFee'],ENT_QUOTES);
						$worksheet->setCellValue(USAGEFEE_COL.$rowNum, $value);
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