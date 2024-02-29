<?php  
	
    require "dbConfig.php";   // includes database class
    $ADnD_Db = new ADnD_Db(); // creates a new istance of Database Class

	class ADnD_Db {
		private $mysqli = null;
	
		function ADnD_Db(){
			$this->openConnection();
		}
    
    	function openConnection(){
    		if (!$this->isOpened()){
    			global $dbHostname;
    			global $dbUsername;
    			global $dbPassword;
    			global $dbName;
    			
    			$this->mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword);
				if ($this->mysqli->connect_error) 
					die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);

				$this->mysqli->select_db($dbName) or
					die ('Can\'t use pweb: ' . mysqli_error());
			}
    	}
    
    	//Check if the connection to the database id opened
    	function isOpened(){
       		return ($this->mysqli != null);
    	}

   		// Executes a query and returns the results
		function performQuery($queryText) {
			if (!$this->isOpened())
				$this->openConnection();
			
			return $this->mysqli->query($queryText);
		}
		
		//Ritorna lo statement preparato in modo da potergli eseguire il bind
		function getPreparedStmt($queryText){
			$stmt = $this->mysqli->prepare($queryText);
			return $stmt;
		}

		function sqlInjectionFilter($parameter){
			if(!$this->isOpened())
				$this->openConnection();
				
			return $this->mysqli->real_escape_string($parameter);
		}

		function closeConnection(){
 	       	//Close the connection
 	       	if($this->mysqli !== null)
				$this->mysqli->close();
			
			$this->mysqli = null;
		}
	}

?>