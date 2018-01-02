<?php

 class Database {
    protected $_connect;
	protected $_result;
	
	public function connect() {
		$this->_connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	public function query($sql = "") {
		if($sql == "" ) {
			return false;	
		}	
		if(!$this->_connect) {
			die("Error connect database action query");
		}
		$this->_result = mysqli_query($this->_connect, $sql);
	}

	public function numRows() {
		if(!$this->_result) {
			die("Error result action numRow");
		}
		return mysqli_num_rows($this->_result);			
	}

	public function fetch() {
		$data = array();
		if(!$this->_result) {
			die("Error result action fetch");
		}
		$data = mysqli_fetch_assoc($this->_result);
		return $data;
	}

	public function fetchAll() {
		$data = array();
		if(!$this->_result) {
			die("Error result action fetchAll");
		}
		while($row = mysqli_fetch_assoc($this->_result)) {
			$data[] = $row;
		}
		return $data;
	}
 }