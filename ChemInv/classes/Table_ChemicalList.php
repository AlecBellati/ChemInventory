<?php
	require_once CLASSES_PATH."Table_ListTemplate.php";
	
	class Table_ChemicalList extends Table_ListTemplate{
		private $chemicalName;
		private $roomName;
		private $roomID;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->setChemicalNameSearch("");
			$this->setRoomNameSearch("");
			$this->setRoomIDSearch(null);
		}
		
		// Add the table header
		protected function addHeader(){
			$row = array("Chemical:", "Room:");
			$this->addRow($row);
		}
		
		// Set the chemical name search condition
		public function setChemicalNameSearch($_chemicalName){
			$this->chemicalName = $_chemicalName;
		}
		
		// Set the room name search condition
		public function setRoomNameSearch($_roomName){
			$this->roomName = $_roomName;
		}
		
		// Set the room ID search condition
		public function setRoomIDSearch($_roomID){
			$this->roomID = $_roomID;
		}
		
		// Get the query select
		protected function getQuerySelect(){
			return "SELECT chemical.ID,chemical.ChemicalName,room.RoomName";
		}
		
		// Get the query condition
		protected function getQueryFrom(){
			$condition = " FROM chemical JOIN room ON chemical.RoomID=room.ID";
			
			// Get the search conditions
			$where = "";
			if ($this->chemicalName != ""){
				$where .= " chemical.ChemicalName RLIKE '".$this->chemicalName."'";
			}
			if ($this->roomName != ""){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " room.RoomName RLIKE '".$this->roomName."'";
			}
			if ($this->roomID != null){
				if ($where != ""){
					$where .= " AND";
				}
				
				$where .= " room.ID=".$this->roomID;
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
			return " ORDER BY chemical.ChemicalName ASC LIMIT ".$tableStart.",".$this->tableSize;
		}
		
		// Parse the current row found from the query
		protected function parseRow($_row){
			$link = '<a href="./?action=chemical&chemicalId='.$_row['ID'].'">'.$_row['ChemicalName'].'</a>';
			$row = array($link,$_row['RoomName']);
			$this->addRow($row);
		}
	}
?>
