<?php
	class Table{
		protected $rows;
		protected $rowsNum;
		
		// Constructor
		function __construct(){
			$this->rowSetup();
		}
		
		// Add another row to the table
		public function addRow($_row){
			$this->rows .= '<tr>';
			foreach($_row as $col){
				$this->rows .= '<td>'.$col.'</td>';
			}
			$this->rows .= '</tr>';
			
			$this->rowsNum++;
		}
		
		// Get the number of rows in the table
		public function getRowNum(){
			return $rowsNum;
		}
		
		// Output the html markup of the table
		public function outputTable(){
			$table = '<table>';
			$table .= $this->rows;
			$table .= '</table>';
			
			return $table;
		}
		
		// Set up the table
		protected function rowSetup(){
			$this->rows = "";
			$this->rowsNum = 0;
		}
	}
?>
