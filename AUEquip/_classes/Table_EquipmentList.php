<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_EquipmentList extends Table_ListTemplate{
		private $equipmentName;
		private $roomID;
		private $functionID;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setEquipmentSearch("");
			$this->setRoomSearch(null);
			$this->setFunctionSearch(null);
			$this->tableType = "equipment";
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Equipment:", "Function:", "Room:");
			$this->addRow($row);
		}
		
		// Set the equipment name search condition
		public function setEquipmentSearch($_equipmentName){
			$this->equipmentName = $_equipmentName;
		}
		
		// Set the room ID search condition
		public function setRoomSearch($_roomID){
			$this->roomID = $_roomID;
		}
		
		// Set the function ID search condition
		public function setFunctionSearch($_functionID){
			$this->functionID = $_functionID;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT equipment.ID,equipment.EquipmentName,function.FunctionName,room.RoomName";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM equipment JOIN room ON room.ID=equipment.RoomID";
			$condition .= " JOIN equipmentfunction ON equipment.ID=equipmentfunction.equipmentID";
			$condition .= " JOIN function ON function.ID=equipmentfunction.functionID";
			
			// Get the search conditions
			$where = "";
			if ($this->roomID != null){
				$where .= " room.ID=".$this->roomID;
			}
			if ($this->functionID != NULL){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " function.ID=".$this->functionID;
			}
			if ($this->equipmentName != ""){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " equipment.EquipmentName RLIKE '".$this->equipmentName."'";
			}
			if ($where != ""){
				$condition .= " WHERE";
				$condition .= $where;
			}
			
			return $condition;
		}
		
		// Get the query order condition
		protected function getQueryOrder(){
			$tableStart = ($this->tablePage - 1) * $this->tableSize;
			return " ORDER BY equipment.EquipmentName ASC,function.FunctionName,room.RoomName LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=equipment&equipmentID='.$_row['ID'].'">'.$_row['EquipmentName'].'</a>';
			$row = array($link, $_row['FunctionName'], $_row['RoomName']);
			$this->addRow($row);
		}
	}
?>
