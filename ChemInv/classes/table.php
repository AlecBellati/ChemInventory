<?php
	class Table{
		private $rows;
		private $rowsNum;
		
		// Constructor
		function __construct(){
			$this->setup();
		}
		
		// Set up the table
		public function setup(){
			$this->rows = array();
			$this->rowsNum = 0;
		}
		
		// Add another row to the table
		public function addRow($_row){
			$this->rows[$this->rowsNum] = $_row;
			$this->rowsNum++;
		}
		
		// Get the number of rows in the table
		public function getRowNum(){
			return $rowsNum;
		}
		
		// Output the html markup of the table
		public function outputTable(){
			$table = '<table border="1">';
			
			foreach($this->rows as $row){
				$table .= '<tr>';
				foreach($row as $col){
					$table .= '<td>'.$col.'</td>';
				}
				$table .= '</tr>';
			}
			
			$table .= '</table>';
			
			return $table;
		}
		
		// Clear all the rows from the table
		public function removeAllRows(){
			$this->setup();
		}
	}
?>
