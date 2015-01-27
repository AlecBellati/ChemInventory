<?php
	class Chemical{
		private $ID;
		private $chemicalName;
		private $supplier;
		private $primaryDGC;
		private $packingGroup;
		private $hazardous;
		private $poisonsSchedule;
		private $totalAmount;
		private $unit;
		private $room;
		private $building;
		private $carcinogen;
		private $chemicalWeapon;
		private $CSC;
		private $ototoxic;
		private $restrictedHazardous;
		
		// Database interface
		private $dbi;
		
		
		// Constructor
		function __construct($_dbi){
			$this->dbi = $_dbi;
		}
		
		// Get the chemical by id
		public function setByID($_id){
			$query = "SELECT chemical.*,room.RoomName,building.BuildingName,supplier.SupplierName ";
			$query .= "FROM chemical JOIN room ON chemical.RoomID=room.ID ";
			$query .= "JOIN building ON room.BuildingID=building.ID ";
			$query .= "JOIN supplier ON chemical.SupplierID=supplier.ID ";
			$query .= "WHERE chemical.ID=".$_id;
			//$query = "SELECT * FROM chemical WHERE ID=".$_id;
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_BOTH);

			$this->setProperties($row);
		}
		
		// Set the properties of the chemical
		private function setProperties($_data){
			if (isset($_data['ID'])) $this->ID = (int) $_data['ID'];
			if (isset($_data['ChemicalName'])) $this->chemicalName = $_data['ChemicalName'];
			if (isset($_data['SupplierName'])) $this->supplier = $_data['SupplierName'];
			if (isset($_data['PrimaryDGC'])) $this->primaryDGC = $_data['PrimaryDGC'];
			if (isset($_data['PackingGroup'])) $this->packingGroup = $_data['PackingGroup'];
			if (isset($_data['Hazardous'])) $this->hazardous = $_data['Hazardous'];
			if (isset($_data['PoisonsSchedule'])) $this->poisonsSchedule = $_data['PoisonsSchedule'];
			if (isset($_data['TotalAmount'])) $this->totalAmount = $_data['TotalAmount'];
			if (isset($_data['Unit'])) $this->unit = $_data['Unit'];
			if (isset($_data['RoomName'])) $this->room = $_data['RoomName'];
			if (isset($_data['BuildingName'])) $this->building = $_data['BuildingName'];
			if (isset($_data['Carcinogen'])) $this->carcinogen = (int) $_data['Carcinogen'];
			if (isset($_data['ChemicalWeapon'])) $this->chemicalWeapon = (int) $_data['ChemicalWeapon'];
			if (isset($_data['CSC'])) $this->CSC = (int) $_data['CSC'];
			if (isset($_data['Ototoxic'])) $this->ototoxic = (int) $_data['Ototoxic'];
			if (isset($_data['RestrictedHazardous'])) $this->restrictedHazardous = (int) $_data['RestrictedHazardous'];
		}
		
		// Get the id
		public function getID(){
			return $this->ID;
		}
		
		// Get the chemical name
		public function getChemicalName(){
			return $this->chemicalName;
		}
		
		// Get the supplier
		public function getSupplier(){
			return $this->supplier;
		}
		
		// Get the primaryDGC
		public function getPrimaryDGC(){
			return $this->primaryDGC;
		}
		
		// Get the packing group
		public function getPackingGroup(){
			return $this->packingGroup;
		}
		
		// Get hazardous indicator
		public function isHazardous(){
			return $this->hazardous;
		}
		
		// Get the poisons schedule
		public function getPoisonsSchedule(){
			return $this->poisonsSchedule;
		}
		
		// Get the totalAmount
		public function getTotalAmount(){
			return $this->totalAmount;
		}
		
		// Get the units used
		public function getUnit(){
			return $this->unit;
		}
		
		// Get the room
		public function getRoom(){
			return $this->room;
		}
		
		// Get the room
		public function getBuilding(){
			return $this->building;
		}
		
		// Get carcinogen indicator
		public function isCarcinogenic(){
			return $this->carcinogen;
		}
		
		// Get chemical weapon indicator
		public function isChemicalWeapon(){
			return $this->chemicalWeapon;
		}
		
		// Get CSC indicator
		public function isCSC(){
			return $this->CSC;
		}
		
		// Get ototoxic indicator
		public function isOtotoxic(){
			return $this->ototoxic;
		}
		
		// Get restricted hazardous indicator
		public function isRestrictedHazardous(){
			return $this->restrictedHazardous;
		}
		
	}
?>
