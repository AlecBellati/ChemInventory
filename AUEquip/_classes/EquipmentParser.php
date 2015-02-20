<?php
	require_once SCHEMA_PATH.'campus_schema.php';
	require_once SCHEMA_PATH.'building_schema.php';
	require_once SCHEMA_PATH.'room_schema.php';
	require_once SCHEMA_PATH.'contact_schema.php';
	require_once SCHEMA_PATH.'equipment_schema.php';
	require_once SCHEMA_PATH.'function_schema.php';
	require_once SCHEMA_PATH.'equipmentfunction_schema.php';
	require_once LIB_PATH.'PHPExcel.php';
	
	define('EQUIPMENT_COL','A');
	define('FUNCTION_COL','B');
	define('WHATITDOES_COL','C');
	define('WHATSAMPLE_COL','D');
	define('WHATINFORMATION_COL','E');
	define('BUILDING_COL','F');
	define('LEVEL_COL','G');
	define('ROOM_COL','H');
	define('CAMPUS_COL','I');
	define('CONTACT_COL','J');
	define('NUMBER_COL','K');
	define('EMAIL_COL','L');
	define('USAGEFEE_COL','M');
	
	class EquipmentParser{
		// The database interface
		private $dbi;
		
		// Constructor
		function __construct($_dbi){
			$this->dbi = $_dbi;
		}
		
		// Parse an excel spreadsheet
		public function parseData($filename){
			// Open the file
			$file = PHPExcel_IOFactory::load($filename);
			$worksheet = $file->getActiveSheet();
			
			// Read each row
			for($rowIndex = 2; $rowIndex <= $worksheet->getHighestRow(); $rowIndex++){
				// Parse the contents of the row
				$equipment = $this->parseEquipment($worksheet, $rowIndex);
				$function = $this->parseFunction($worksheet, $rowIndex);
				$whatItDoes = $this->parseWhatItDoes($worksheet, $rowIndex);
				$whatSample = $this->parseWhatSample($worksheet, $rowIndex);
				$whatInformation = $this->parseWhatInformation($worksheet, $rowIndex);
				$building = $this->parseBuilding($worksheet, $rowIndex);
				$level = $this->parseLevel($worksheet, $rowIndex);
				$room = $this->parseRoom($worksheet, $rowIndex);
				$campus = $this->parseCampus($worksheet, $rowIndex);
				$contact = $this->parseContact($worksheet, $rowIndex);
				$number = $this->parseNumber($worksheet, $rowIndex);
				$email = $this->parseEmail($worksheet, $rowIndex);
				$usageFee = $this->parseUsageFee($worksheet, $rowIndex);
				
				// Insert the information from this row
				$campusID = $this->insertCampus($campus);
				$buildingID = $this->insertBuilding($building, $campusID);
				$roomID = $this->insertRoom($room, $level, $buildingID);
				$contactID = $this->insertContact($contact, $number, $email);
				$equipmentID = $this->insertEquipment($equipment, $whatItDoes, $whatSample, $whatInformation, $usageFee, $roomID, $contactID);
				$functionID = $this->insertFunction($function);
				$this->insertEquipmentFunction($equipmentID, $functionID);
			}
			
		}
		
		/* Insert a record into the campus table
		 * @param _campusName - The name of the campus
		 * @return:
		 *		The ID of campus matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertCampus($_campusName){
			// Check an actual equipment and function id was given
			if ($_campusName == NULL){
				return 0;
			}
			
			// Check if this record has already been added
			$from = " FROM campus WHERE CampusName='".$_campusName."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO Campus (CampusName)";
			$query .= " VALUES('".$_campusName."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the building added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the buildings table
		 * @param _buildingName - The name of the building
		 * @param _campusID - The ID of the campus
		 * @return:
		 *		The ID of building matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertBuilding($_buildingName, $_campusID){
			// Check an actual equipment and function id was given
			if ($_buildingName == NULL || $_campusID == 0){
				return 0;
			}
			
			// Check if this record has already been added
			$from = " FROM building WHERE BuildingName='".$_buildingName."' AND CampusID='".$_campusID."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO Building (BuildingName, CampusID)";
			$query .= " VALUES('".$_buildingName."','".$_campusID."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the building added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the room table
		 * @param _roomName - The name of the room
		 * @param _level - The level the room is on
		 * @param _buildingID - The ID of the building
		 * @return:
		 *		The ID of room matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertRoom($_roomName, $_level, $_buildingID){
			// Check an actual equipment and function id was given
			if ($_roomName == NULL || $_buildingID == 0){
				return 0;
			}
			
			// Check if this record has already been added
			$from = " FROM room WHERE RoomName='".$_roomName."' AND Level='".$_level."' AND BuildingId='".$_buildingID."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO Room(RoomName, Level, BuildingID)";
			$query .= " VALUES('".$_roomName."','".$_level."',".$_buildingID.")";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the room added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the contact table
		 * @param _contactName - The name of the contact
		 * @param _number - The contact's phone number
		 * @param _email - The contact's email address
		 * @return:
		 *		The ID of contact matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertContact($_contactName, $_number, $_email){
			// Check if this record has already been added
			$from = " FROM contact WHERE ContactName='".$_contactName."' AND Number='".$_number."' AND Email='".$_email."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO Contact(ContactName, Number, Email)";
			$query .= " VALUES('".$_contactName."','".$_number."','".$_email."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the contact added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the equipment table
		 * @param _equipmentName - The name of the equipment
		 * @param _whatItDoes - What the equipment does
		 * @param _whatSample - What sample the equipment needs
		 * @param _whatInformation - What information the equipment gives
		 * @param _usageFee - The usage fee of the equipment
		 * @param _roomID - The id of the equipment's room location
		 * @param _contactID - The id of the equipment's contact
		 * @return:
		 *		The ID of equipment matching the parameters successfully
		 *		0 if unsuccessfully added
		 */
		public function insertEquipment($_equipmentName, $_whatItDoes, $_whatSample, $_whatInformation, $_usageFee, $_roomID, $_contactID){
			// Check an actual equipment and function id was given
			if ($_equipmentName == NULL || $_roomID == 0 || $_contactID == 0){
				return 0;
			}
			
			$from = " FROM equipment WHERE EquipmentName='".$_equipmentName."' AND WhatItDoes='".$_whatItDoes."' AND WhatSample='".$_whatSample."' AND WhatInformation='".$_whatInformation."' AND UsageFee='".$_usageFee."' AND RoomID='".$_roomID."' AND ContactID='".$_contactID."'";
			
			// Insert the record
			$query = "INSERT INTO Equipment(EquipmentName, WhatItDoes, WhatSample, WhatInformation, UsageFee, RoomID, ContactID)";
			$query .= " VALUES('".$_equipmentName."','".$_whatItDoes."','".$_whatSample."','".$_whatInformation."','".$_usageFee."','".$_roomID."','".$_contactID."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the equipment added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the function table
		 * @param _functionName - The name of the function
		 * @return:
		 *		The ID of function matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertFunction($_functionName){
			// Check an actual equipment and function id was given
			if ($_functionName == NULL){
				return 0;
			}
			
			// Check if this record has already been added
			$from = " FROM function WHERE FunctionName='".$_functionName."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO Function(FunctionName)";
			$query .= " VALUES('".$_functionName."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the function added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the equipmentfunction table
		 * @param _equipmentID - The ID of the equipment
		 * @param _functionID - The ID of the function
		 * @return:
		 *		The ID of equipment matching the parameters successfully or already added
		 *		0 if unsuccessfully added
		 */
		public function insertEquipmentFunction($_equipmentID, $_functionID){
			// Check the given parameters are valid
			if ($_equipmentID == 0 || $_functionID == 0){
				return 0;
			}
			
			// Check if this record has already been added
			$from = " FROM equipmentfunction WHERE EquipmentID='".$_equipmentID."' AND FunctionID='".$_functionID."'";
			$query = "SELECT ID".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			if($resultsRow){
				return $resultsRow['ID'];
			}
			
			// Insert the record
			$query = "INSERT INTO EquipmentFunction(EquipmentID, FunctionID)";
			$query .= " VALUES('".$_equipmentID."','".$_functionID."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the equipmentfunction added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Parse the cell containing the equipment
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The equipment name
		 */
		private function parseEquipment($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(EQUIPMENT_COL . $_rowIndex);
			$equipment = trim($cell->getValue());
			$equipment = htmlspecialchars($equipment,ENT_QUOTES);
			if ($equipment == ""){
				return null;
			}
			else {
				return $equipment;
			}
		}
		
		/* Parse the cell containing the function
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The function(s)
		 */
		private function parseFunction($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(FUNCTION_COL . $_rowIndex);
			$function = trim($cell->getValue());
			$function = htmlspecialchars($function,ENT_QUOTES);
			if ($function == ""){
				return null;
			}
			else {
				return $function;
			}
		}
		
		/* Parse the cell containing what it does
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return What it does
		 */
		private function parseWhatItDoes($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(WHATITDOES_COL . $_rowIndex);
			$whatItDoes = trim($cell->getValue());
			$whatItDoes = htmlspecialchars($whatItDoes,ENT_QUOTES);
			return $whatItDoes;
		}
		
		/* Parse the cell containing what sample is needed
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The sample(s)
		 */
		private function parseWhatSample($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(WHATSAMPLE_COL . $_rowIndex);
			$whatSample = trim($cell->getValue());
			$whatSample = htmlspecialchars($whatSample,ENT_QUOTES);
			return $whatSample;
		}
		
		/* Parse the cell containing what information is given
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The information given
		 */
		private function parseWhatInformation($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(WHATINFORMATION_COL . $_rowIndex);
			$whatInformation = trim($cell->getValue());
			$whatInformation = htmlspecialchars($whatInformation,ENT_QUOTES);
			return $whatInformation;
		}
		
		/* Parse the cell containing the building
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The building
		 */
		private function parseBuilding($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(BUILDING_COL . $_rowIndex);
			$building = trim($cell->getValue());
			$building = htmlspecialchars($building,ENT_QUOTES);
			if ($building == ""){
				return null;
			}
			else {
				return $building;
			}
		}
		
		/* Parse the cell containing the level
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The level
		 */
		private function parseLevel($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(LEVEL_COL . $_rowIndex);
			$level = trim($cell->getValue());
			$level = htmlspecialchars($level,ENT_QUOTES);
			return $level;
		}
		
		/* Parse the cell containing the room
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The room
		 */
		private function parseRoom($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(ROOM_COL . $_rowIndex);
			$room = trim($cell->getValue());
			$room = htmlspecialchars($room,ENT_QUOTES);
			if ($room == ""){
				return null;
			}
			else {
				return $room;
			}
		}
		
		/* Parse the cell containing the campus
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The campus
		 */
		private function parseCampus($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CAMPUS_COL . $_rowIndex);
			$campus = trim($cell->getValue());
			$campus = htmlspecialchars($campus,ENT_QUOTES);
			if ($campus == ""){
				return null;
			}
			else {
				return $campus;
			}
		}
		
		/* Parse the cell containing the contact
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The contact name
		 */
		private function parseContact($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CONTACT_COL . $_rowIndex);
			$contact = trim($cell->getValue());
			$contact = htmlspecialchars($contact,ENT_QUOTES);
			return $contact;
		}
		
		/* Parse the cell containing the contact's number
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The contact's number
		 */
		private function parseNumber($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(NUMBER_COL . $_rowIndex);
			$number = trim($cell->getValue());
			$number = htmlspecialchars($number,ENT_QUOTES);
			return $number;
		}
		
		/* Parse the cell containing the contact's email
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The contact's email
		 */
		private function parseEmail($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(EMAIL_COL . $_rowIndex);
			$email = trim($cell->getValue());
			$email = htmlspecialchars($email,ENT_QUOTES);
			return $email;
		}
		
		/* Parse the cell containing the usage fee
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The usage fee
		 */
		private function parseUsageFee($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(USAGEFEE_COL . $_rowIndex);
			$useageFee = trim($cell->getValue());
			$useageFee = htmlspecialchars($useageFee,ENT_QUOTES);
			return $useageFee;
		}
		
	}
?>
