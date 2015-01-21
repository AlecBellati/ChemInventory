<?php
	require_once CLASSES_PATH."/Table.php";
	
	class Table_ChemicalList extends Table{
		private $dbi;
		private $chemicalName;
		private $roomName;
		private $tablePage;
		private $tableSize;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			parent::setup();
			$row = array("Chemical:", "Room:");
			parent::addRow($row);
			
			$this->dbi = $_dbi;
			$this->setChemicalSearch("");
			$this->setRoomSearch("");
			$this->setPage(1);
			$this->setSize($_tableSize);
		}
		
		// Set the chemical name search condition
		public function setChemicalSearch($_chemicalName){
			$this->chemicalName = $_chemicalName;
		}
		
		// Set the room name search condition
		public function setRoomSearch($_roomName){
			$this->roomName = $_roomName;
		}
		
		// Set the table page
		public function setPage($_tablePage){
			$this->tablePage = $_tablePage;
		}
		
		// Get the table page
		public function getPage(){
			return $this->tablePage;
		}
		
		// Go to the next page
		public function nextPage(){
			$this->tablePage++;
			$this->resetRows();
		}
		
		// Go to the previous page
		public function backPage(){
			$this->tablePage--;
			$this->resetRows();
		}
		
		// Set the table size
		public function setSize($_tableSize){
			$this->tableSize = $_tableSize;
		}
		
		// Get the table
		public function getTable(){
			$query = "SELECT chemical.ID,chemical.ChemicalName,room.RoomName";
			$query .= $this->getQueryCondition();
			
			// Get the results in alphanumerical order
			$tableStart = ($this->tablePage - 1) * $this->tableSize;
			$query .= " ORDER BY chemical.ChemicalName ASC LIMIT ".$tableStart.",".$this->tableSize;
			if ($result = $this->dbi->query($query)){
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					$link = '<a href="./?action=chemical&chemicalId='.$row['ID'].'">'.$row['ChemicalName'].'</a>';
					$row = array($link,$row['RoomName']);
					parent::addRow($row);
				}
			}
			
			return parent::outputTable();
		}
		
		// Check if the end of the list has been reached on the current page
		public function endReached(){
			$query = "SELECT COUNT(*)";
			$query .= $this->getQueryCondition();
			$result = $this->dbi->query($query);
			$size = mysql_result($result,0);
			
			$tableLast = $this->tableSize * (($this->tablePage - 1) + 1);
			
			if ($tableLast >= $size){
				return true;
			}
			return false;
		}
		
		// Reset the rows of the table
		public function resetRows(){
			parent::removeAllRows();
			$row = array("Chemical:", "Room:");
			parent::addRow($row);
		}
		
		// Get the query condition
		private function getQueryCondition(){
			$condition = " FROM chemical JOIN room ON chemical.RoomID=room.ID";
			
			// Get the search conditions
			if ($this->chemicalName != ""){
				$condition .= " WHERE chemical.ChemicalName RLIKE '".$this->chemicalName."'";
				
				if ($this->roomName != ""){
					$condition .= " AND room.RoomName RLIKE '".$this->roomName."'";
				}
			}
			else if ($this->roomName != ""){
				$condition .= " WHERE room.RoomName RLIKE '".$this->roomName."'";
			}
			
			return $condition;
		}
	}
?>
