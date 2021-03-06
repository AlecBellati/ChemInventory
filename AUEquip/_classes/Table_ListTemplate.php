<?php
	require_once CLASSES_PATH."Table.php";
	
	class Table_ListTemplate extends Table{
		protected $dbi;
		protected $tablePage;
		protected $tableSize;
		protected $tableType;
		
		// Constructor
		function __construct($_dbi, $_tableSize){
			$this->setup($_dbi, $_tableSize);
			$this->tableType = "";
		}
		
		// Setup the table
		protected function setup($_dbi, $_tableSize){
			$this->rowSetup();
			$this->addHeader();
			
			$this->dbi = $_dbi;
			$this->setPage(1);
			$this->setSize($_tableSize);
		}
		
		// Add the table header
		// Implemented by child
		protected function addHeader(){}
		
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
			$this->rowSetup();
			$this->addHeader();
		}
		
		// Go to the previous page
		public function backPage(){
			$this->tablePage--;
			$this->rowSetup();
			$this->addHeader();
		}
		
		// Set the table size
		public function setSize($_tableSize){
			$this->tableSize = $_tableSize;
		}
		
		// Get the table
		public function getTable(){
			$query = $this->getQuerySelect();
			$query .= $this->getQueryFrom();
			$query .= $this->getQueryOrder();
			
			if ($result = $this->dbi->query($query)){
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					$this->parseRow($row);
				}
			}
			
			if ($this->rowsNum > 1){
				return $this->outputTable();
			}
			else{
				return $this->returnMessage();
			}
			
		}
		
		// Check if the end of the list has been reached on the current page
		public function endReached(){
			$query = "SELECT COUNT(*)";
			$query .= $this->getQueryFrom();
			$result = $this->dbi->query($query);
			$size = mysql_result($result,0);
			
			$tableLast = $this->tableSize * (($this->tablePage - 1) + 1);
			
			if ($tableLast >= $size){
				return true;
			}
			return false;
		}
		
		// Add another row to the table
		// Overwrites the parent method
		public function addRow($_row){
			$style = "";
			
			if ($this->rowsNum == 0){
				$style .= ' style="font-weight: bold; background-color: Moccasin;"';
			} else if ($this->rowsNum % 2 == 0){
				$style .= ' style="background-color: LemonChiffon;"';
			}
			
			$this->rows .= '<tr'.$style.'>';
			foreach($_row as $col){
				$this->rows .= '<td>'.$col.'</td>';
			}
			$this->rows .= '</tr>';
			
			$this->rowsNum++;
		}
		
		// Get the query select condition
		// Implemented by child
		protected function getQuerySelect(){
			return "";
		}
		
		// Get the query from condition
		// Implemented by child
		protected function getQueryFrom(){
			return "";
		}
		
		// Get the query order condition
		// Implemented by child
		protected function getQueryOrder(){
			return "";
		}
		
		// Parse the current row found from the query
		// Implemented by child
		protected function parseRow($_row){}
		
		// Return a message indicating the table is empty
		protected function returnMessage(){
			return "No ".$this->tableType." found";
		}
		
		
	}
?>
