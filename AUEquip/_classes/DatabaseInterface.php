<?php
	require_once SCHEMA_PATH.'administrator_schema.php';
	require_once SCHEMA_PATH.'campus_schema.php';
	require_once SCHEMA_PATH.'building_schema.php';
	require_once SCHEMA_PATH.'room_schema.php';
	require_once SCHEMA_PATH.'contact_schema.php';
	require_once SCHEMA_PATH.'equipment_schema.php';
	require_once SCHEMA_PATH.'function_schema.php';
	require_once SCHEMA_PATH.'equipmentfunction_schema.php';
	
	class DatabaseInterface{
		private $conn;
		
		// Constructor
		function __construct(){}
		
		// Connect to the database
		public function connect($_user,$_pass,$_host,$_db, $_persist){
			try{
				$this->conn = @mysql_pconnect($_host,$_user,$_pass);
				if (!$this->conn){
					$err = oci_error ();
					print (htmlentities ($err['message']));
					exit ();
				}
				
				mysql_select_db($_db,$this->conn);
			} catch(Exception $e){
				return false;
			}
			
			return true;
		}
		
		// Disconnect from the database
		public function disconnect(){
			mysql_close();
		}
		
		// Parse a given query
		public function query($query){
			try{
				return mysql_query($query);
			} catch(Exception $e){
				return false;
			}
		}
		
		// Setup the database
		public function setupDatabase(){
			// Create the tables in the database
			$this->dropTables();
			$this->createTables();
		}
		
		// Clear all the tables expect the administrator table
		public function clearAll(){
			$this->clearEquipmentFunction();
			$this->clearFunction();
			$this->clearEquipment();
			$this->clearContact();
			$this->clearRoom();
			$this->clearBuilding();
			$this->clearCampus();
		}
		
		// Clear the records in the equipmentfunction table
		public function clearEquipmentFunction(){
			$query = "DELETE FROM equipmentfunction";
			$this->query($query);
		}
		
		// Clear the records in the function table
		public function clearFunction(){
			$query = "DELETE FROM function";
			$this->query($query);
		}
		
		// Clear the records in the equipment table
		public function clearEquipment(){
			$query = "DELETE FROM equipment";
			$this->query($query);
		}
		
		// Clear the records in the contact table
		public function clearContact(){
			$query = "DELETE FROM contact";
			$this->query($query);
		}
		
		// Clear the records in the room table
		public function clearRoom(){
			$query = "DELETE FROM room";
			$this->query($query);
		}
		
		// Clear the records in the building table
		public function clearBuilding(){
			$query = "DELETE FROM building";
			$this->query($query);
		}
		
		// Clear the records in the campus table
		public function clearCampus(){
			$query = "DELETE FROM campus";
			$this->query($query);
		}
		
		// Check the tables missing from the database
		public function checkMissing(){
			$this->checkAdministrator();
			$this->checkCampus();
			$this->checkBuilding();
			$this->checkRoom();
			$this->checkContact();
			$this->checkEquipment();
			$this->checkFunction();
			$this->checkEquipmentFunction();
		}
		
		// Check if the administrator table is missing
		// Adds it if missing
		public function checkAdministrator(){
			$query = "SHOW TABLES LIKE 'administrator'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableAdministrator($this->conn);
			}
		}
		
		// Check if the campus table is missing
		// Adds it if missing
		public function checkCampus(){
			$query = "SHOW TABLES LIKE 'campus'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableCampus($this->conn);
			}
		}
		
		// Check if the building table is missing
		// Adds it if missing
		public function checkBuilding(){
			$query = "SHOW TABLES LIKE 'building'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableBuilding($this->conn);
			}
		}
		
		// Check if the room table is missing
		// Adds it if missing
		public function checkRoom(){
			$query = "SHOW TABLES LIKE 'room'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableRoom($this->conn);
			}
		}
		
		// Check if the contact table is missing
		// Adds it if missing
		public function checkContact(){
			$query = "SHOW TABLES LIKE 'contact'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableContact($this->conn);
			}
		}
		
		// Check if the equipment table is missing
		// Adds it if missing
		public function checkEquipment(){
			$query = "SHOW TABLES LIKE 'equipment'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableEquipment($this->conn);
			}
		}
		
		// Check if the function table is missing
		// Adds it if missing
		public function checkFunction(){
			$query = "SHOW TABLES LIKE 'function'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableFunction($this->conn);
			}
		}
		
		// Check if the equipmentfunction table is missing
		// Adds it if missing
		public function checkEquipmentFunction(){
			$query = "SHOW TABLES LIKE 'equipmentfunction'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableEquipmentFunction($this->conn);
			}
		}
		
		// Create the tables in the database
		private function createTables(){
			createTableCampus($this->conn);
			createTableBuilding($this->conn);
			createTableRoom($this->conn);
			createTableContact($this->conn);
			createTableEquipment($this->conn);
			createTableFunction($this->conn);
			createTableEquipmentFunction($this->conn);
		}
		
		// Drop the tables in the database
		private function dropTables(){
			dropTableEquipmentFunction($this->conn);
			dropTableFunction($this->conn);
			dropTableEquipment($this->conn);
			dropTableContact($this->conn);
			dropTableRoom($this->conn);
			dropTableBuilding($this->conn);
			dropTableCampus($this->conn);
		}
		
	}
?>
