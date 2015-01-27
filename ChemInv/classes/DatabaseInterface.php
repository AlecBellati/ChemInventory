<?php
	require_once SCHEMA_PATH.'building_schema.php';
	require_once SCHEMA_PATH.'chemical_schema.php';
	require_once SCHEMA_PATH.'room_schema.php';
	require_once SCHEMA_PATH.'supplier_schema.php';
	
	class DatabaseInterface{
	private $conn;
		
		// Constructor
		function __construct(){}
		
		// Connect to the database
		public function connect($_user,$_pass,$_host,$_db, $_persist){
			try{
				$this->conn = @mysql_pconnect(DB_HOST,DB_USERNAME,DB_PASSWORD);
				if (!$this->conn){
					$err = oci_error ();
					print (htmlentities ($err['message']));
					exit ();
				}
				
				mysql_select_db('inventory',$this->conn);
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
		
	}
?>
