<?php
	require_once SCHEMA_PATH.'/building_schema.php';
	require_once SCHEMA_PATH.'/chemical_schema.php';
	require_once SCHEMA_PATH.'/room_schema.php';
	require_once SCHEMA_PATH.'/supplier_schema.php';
	require_once LIB_PATH.'/PHPExcel.php';
	
	define('CHEMICAL_COL','A');
	define('SUPPLIER_COL','B');
	define('PRIMARYDGC_COL','C');
	define('PACKINGGROUP_COL','D');
	define('HAZARDOUS_COL','E');
	define('POISONSSCHEDULE_COL','F');
	define('AMOUNT_COL','G');
	define('UNIT_COL','H');
	define('BUILDING_COL','I');
	define('FLOOR_COL','J');
	define('ROOM_COL','K');
	define('CAMPUS_COL','L');
	define('CARCINOGEN_COL','M');
	define('CHEMICALWEAPON_COL','N');
	define('CSC_COL','O');
	define('OTOTOXIC_COL','P');
	define('RESTRICTEDHAZARDOUS_COL','Q');
	
	class ChemicalParser{
		// The database interface
		private $dbi;
		
		// Constructor
		function __construct($_dbi){
			$this->dbi = $_dbi;
		}
		
		// Setup the database
		public function setupDatabase(){
			// Create the tables in the database
			$this->dbi->dropTables();
			$this->dbi->createTables();
		}
		
		// Parse an excel spreadsheet
		public function parseData($filename){
			// Open the file
			$file = PHPExcel_IOFactory::load($filename);
			$worksheet = $file->getActiveSheet();
			
			// Read each row
			foreach($worksheet->getRowIterator() as $row){
				// Parse the contents of the row
				$rowIndex = $row->getRowIndex();
				
				$chemical = parseChemical($worksheet, $rowIndex);
				$supplier = parseSupplier($worksheet, $rowIndex);
				$primaryDGC = parsePrimaryDGC($worksheet, $rowIndex);
				$packingGroup = parsePackingGroup($worksheet, $rowIndex);
				$hazardous = parseHazardous($worksheet, $rowIndex);
				$poisonsSchedule = parsePoisonsSchedule($worksheet, $rowIndex);
				$amount = parseAmount($worksheet, $rowIndex);
				$unit = parseUnit($worksheet, $rowIndex);
				$building = parseBuilding($worksheet, $rowIndex);
				$floor = parseFloor($worksheet, $rowIndex);
				$room = parseRoom($worksheet, $rowIndex);
				$campus = parseCampus($worksheet, $rowIndex);
				$carcinogen = parseCarcinogen($worksheet, $rowIndex);
				$chemicalWeapon = parseChemicalWeapon($worksheet, $rowIndex);
				$CSC = parseCSC($worksheet, $rowIndex);
				$ototoxic = parseOtotoxic($worksheet, $rowIndex);
				$restrictedHazardous = parseRestrictedHazardous($worksheet, $rowIndex);
				
				// Insert the information from this row
				$buildingID = insertBuilding($building, $campus);
				$roomID = insertRoom($room, $floor, $buildingID);
				$supplierID = insertSupplier($supplier);
				insertChemical($chemicalName, $supplierID, $primaryDGC, $packingGroup, $hazardous, $poisonsSchedule, $amount, $unit, $roomID, $carcinogen, $chemicalWeapon, $CSC, $ototoxic, $restrictedHazardous);
			}
		}
		
		/* Insert a record into the buildings table
		 * @param _buildingName - The name of the building
		 * @param _campus - The name of the campus
		 * @return:
		 *		The building's ID if successfully added
		 *		0 if it was already added or unsuccessfully added
		 */
		public function insertBuilding($_buildingName, $_campus){
			// Check if this record has already been added
			$from = " FROM building WHERE BuildingName='".$_buildingName."' AND Campus='".$_campus."'";
			$query = "SELECT COUNT(*)".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			else if(mysql_result($result,0) > 0){
				return 0;
			}
			
			// Insert the record
			$query = "insert into Building values('".$_buildingName."','".$_campus."')";
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
		 * @param _roomFloor - The floor of the room
		 * @param _buildingID - The ID of the building
		 * @return:
		 *		The room's ID if successfully added
		 *		0 if it was already added or unsuccessfully added
		 */
		public function insertRoom($_roomName, $_roomFloor, $_buildingID){
			// Check if this record has already been added
			$from = " FROM room WHERE RoomName='".$_roomName."' AND RoomFloor='".$_roomFloor."' AND BuildingId='".$_buildingID."'";
			$query = "SELECT COUNT(*)".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			else if(mysql_result($result,0) > 0){
				return 0;
			}
			
			// Insert the record
			$query = "insert into Room values('".$_roomName."','".$_roomFloor."','".$_buildingID."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the room added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the supplier table
		 * @param _supplierName - The name of the supplier
		 * @return:
		 *		The supplier's ID if successfully added
		 *		0 if it was already added or unsuccessfully added
		 */
		public function insertSupplier($_supplierName){
			// Check if this record has already been added
			$from = " FROM supplier WHERE SupplierName='".$_supplierName."'";
			$query = "SELECT COUNT(*)".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			else if(mysql_result($result,0) > 0){
				return 0;
			}
			
			// Insert the record
			$query = "insert into Supplier values('".$_supplierName."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the supplier added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Insert a record into the chemical table
		 * @param _chemicalName - The name of the chemical
		 * @param _supplierID - The id of the supplier
		 * @param _primaryDGC - The primary DGC of the chemical
		 * @param _packingGroup - The packing group of the chemical
		 * @param _hazardous - The indicator of whether the chemical is hazardous
		 * @param _poisonsSchedule - The poisons schedule of the chemical
		 * @param _amount - The amount of the chemical
		 * @param _unit - The unit the chemical is measure in
		 * @param _roomID - The id of the room
		 * @param _carcinogen - The indicator of whether the chemical is carcinogenic
		 * @param _chemicalWeapon - The indicator of whether the chemical is chemical weapon
		 * @param _CSC - The indicator of whether the chemical is CSC
		 * @param _ototoxic - The indicator of whether the chemical is ototoxic
		 * @param _restrictedHazardous - The indicator of whether the chemical is restricted hazardous
		 * @return:
		 *		The chemical's ID if successfully added
		 *		0 if it was already added or unsuccessfully added
		 */
		public function insertChemical($_chemicalName, $_supplierID, $_primaryDGC, $_packingGroup, $_hazardous, $_poisonsSchedule, $_amount, $_unit, $_roomID, $_carcinogen, $_chemicalWeapon, $_CSC, $_ototoxic, $_restrictedHazardous){
			// Check if this record has already been added
			$from = " FROM chemical WHERE ChemicalName='".$_chemicalName."' AND SupplierID='".$_supplierID."' AND PrimaryDGC='".$_primaryDGC."' AND PackingGroup='".$_packingGroup."' AND Hazardous='".$_hazardous."' AND PoisonsSchedule='".$_poisonsSchedule."' AND Amount='".$_amount."' AND Unit='".$_unit."' AND RoomID='".$_roomID."' AND Carcinogen='".$_carcinogen."' AND CSC='".$_CSC."' AND Ototoxic='".$_ototoxic."' AND RestrictedHazardous='".$_restrictedHazardous."'";
			$query = "SELECT COUNT(*)".$from;
			if (!($result = $this->dbi->query($query))){
				return 0;
			}
			else if(mysql_result($result,0) > 0){
				return 0;
			}
			
			// Insert the record
			$query = "insert into Chemical values('".$_chemicalName."','".$_supplierID."','".$_primaryDGC."','".$_packingGroup."','".$_hazardous."','".$_poisonsSchedule."','".$_amount."','".$_unit."','".$_roomID."','".$_carcinogen."','".$_CSC."','".$_ototoxic."','".$_restrictedHazardous."')";
			if(!($this->dbi->query($query))){
				return 0;
			}
			
			// Get the ID of the chemical added
			$query = "SELECT ID".$from;
			$result = $this->dbi->query($query);
			$resultsRow = mysql_fetch_array($result, MYSQL_BOTH);
			return $resultsRow["ID"];
		}
		
		/* Parse the cell containing the chemical
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The chemical
		 */
		private function parseChemical($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CHEMICAL_COL . $_rowIndex);
			$chemical = trim($cell->getValue());
			return $chemical;
		}
		
		/* Parse the cell containing the supplier
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The supplier
		 */
		private function parseSupplier($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(SUPPLIER_COL . $_rowIndex);
			$supplier = trim($cell->getValue());
			return $supplier;
		}
		
		/* Parse the cell containing the primary DGC
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The primary DGC
		 */
		private function parsePrimaryDGC($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(PRIMARYDGC_COL . $_rowIndex);
			$primaryDGC = trim($cell->getValue());
			return $primaryDGC;
		}
		
		/* Parse the cell containing the packing group
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The packing group
		 */
		private function parsePackingGroup($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(PRIMARYDGC_COL . $_rowIndex);
			$packingGroup = trim($cell->getValue());
			if ($packingGroup != "I" && $packingGroup != "II" && $packingGroup != "III"){
				return "unknown";
			}
			return $packingGroup;
		}
		
		/* Parse the cell containing the hazardous indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The hazardous indicator
		 */
		private function parseHazardous($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(HAZARDOUS_COL . $_rowIndex);
			$hazardous = trim($cell->getValue());
			if ($hazardous != "H" && $hazardous != "NH"){
				return "unknown";
			}
			return $hazardous;
		}
		
		/* Parse the cell containing the poisons schedule
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The poisons schedule
		 */
		private function parsePoisonsSchedule($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(POISONSSCHEDULE_COL . $_rowIndex);
			$poisonsSchedule = trim($cell->getValue());
			return $poisonsSchedule;
		}
		
		/* Parse the cell containing the amount
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The amount
		 */
		private function parseAmount($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(AMOUNT_COL . $_rowIndex);
			$amount = trim($cell->getValue());
			return $amount;
		}
		
		/* Parse the cell containing the unit
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The unit
		 */
		private function parseUnit($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(UNIT_COL . $_rowIndex);
			$unit = trim($cell->getValue());
			return $unit;
		}
		
		/* Parse the cell containing the building
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The building
		 */
		private function parseBuilding($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(BUILDING_COL . $_rowIndex);
			$building = trim($cell->getValue());
			return $building;
		}
		
		/* Parse the cell containing the floor
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The floor
		 */
		private function parseFloor($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(FLOOR_COL . $_rowIndex);
			$floor = trim($cell->getValue());
			return $floor;
		}
		
		/* Parse the cell containing the room
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The room
		 */
		private function parseRoom($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(ROOM_COL . $_rowIndex);
			$room = trim($cell->getValue());
			return $room;
		}
		
		/* Parse the cell containing the campus
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The campus
		 */
		private function parseCampus($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CAMPUS_COL . $_rowIndex);
			$campus = trim($cell->getValue());
			return $campus;
		}
		
		/* Parse the cell containing the carcinogen indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The carcinogen indicator
		 */
		private function parseCarcinogen($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CARCINOGEN_COL . $_rowIndex);
			if ($cell == ""){
				return  0;
			}
			return  1;
		}
		
		/* Parse the cell containing the chemical weapon indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The chemical weapon indicator
		 */
		private function parseChemicalWeapon($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CHEMICALWEAPON_COL . $_rowIndex);
			if ($cell == ""){
				return  0;
			}
			return  1;
		}
		
		/* Parse the cell containing the CSC indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The CSC indicator
		 */
		private function parseCSC($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(CSC_COL . $_rowIndex);
			if ($cell == ""){
				return  0;
			}
			return  1;
		}
		
		/* Parse the cell containing the ototoxic indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The ototoxic indicator
		 */
		private function parseOtotoxic($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(OTOTOXIC_COL . $_rowIndex);
			if ($cell == ""){
				return  0;
			}
			return  1;
		}
		
		/* Parse the cell containing the restricted hazardous indicator
		 * @param _worksheet - The worksheet being parsed
		 * @param _rowIndex - The row index of the worksheet being parsed
		 * @return The restricted hazardous indicator
		 */
		private function parseRestrictedHazardous($_worksheet, $_rowIndex){
			$cell = $_worksheet->getCell(RESTRICTEDHAZARDOUS_COL . $_rowIndex);
			if ($cell == ""){
				return  0;
			}
			return  1;
		}
		
	}
?>
