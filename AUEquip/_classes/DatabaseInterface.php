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
			$this->clearChemical();
			$this->clearSupplier();
			$this->clearRoom();
			$this->clearBuilding();
			$this->clearCampus();
		}
		
		// Clear the records in the chemicals table
		public function clearChemical(){
			$query = "DELETE FROM chemical";
			$this->query($query);
		}
		
		// Clear the records in the supplier table
		public function clearSupplier(){
			$query = "DELETE FROM supplier";
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
			$this->checkSupplier();
			$this->checkChemical();
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
		
		// Check if the supplier table is missing
		// Adds it if missing
		public function checkSupplier(){
			$query = "SHOW TABLES LIKE 'supplier'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableSupplier($this->conn);
			}
		}
		
		// Check if the chemical table is missing
		// Adds it if missing
		public function checkChemical(){
			$query = "SHOW TABLES LIKE 'chemical'";
			$result = $this->query($query);
			if(mysql_num_rows($result) != 1){
				createTableChemical($this->conn);
			}
		}
		
		// Create the tables in the database
		private function createTables(){
			createTableCampus($this->conn);
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
			dropTableCampus($this->conn);
		}
		
	}
?>
