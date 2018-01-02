<?php

class BaseModel extends Database {
    protected $_select = "*";
    protected $_where;
    protected $_order;
    protected $_limit;
    
    public function __construct() {
        parent::connect();
    }

    public function setSelect($column = "*") {
        $this->_select = $column;
    }

    public function getSelect() {
        return $this->_select;
    }
    
    public function setWhere($where = "") {
        if($where == "") {
            return false;
        }
        $this->_where = "WHERE $where ";
    }

    public function getWhere() {
        return $this->_where;
    }
    
    public function setOrder($column = "",$type = "ASC") {
        if($column == "") {
            return false;
        }
        $this->_order = "ORDER BY $column $type";
    }

    public function getOrder() {
        return $this->_order;
    }
    
    public function setLimit($limit="",$start="") {
        if($start == "" && $limit != "") {
            $this->_limit = "LIMIT $limit";
        }elseif($start != "" && $limit != ""){
            $this->_limit = "LIMIT $start,$limit";
        }else{
            return false;
        }
    }

    public function getLimit() {
        return $this->_limit;
    }

    public function getAll($table = "") {
        if($table == "") {
            return false;
        }
        $sql = "SELECT {$this->getSelect()}
                FROM $table
                {$this->getWhere()}
                {$this->getOrder()}
                {$this->getLimit()}
                ";
        $this->query($sql);
        return $this->fetchAll();
    }

    public function insert($data = array(),$table = "") {
        if($data == null || $table == "" ) {
            return false;
        }
        $columsArr = array_keys($data);
        $valuesArr = array_values($data);
        
        foreach($valuesArr as $key=>$val) {
            $valuesArr[$key] = "'".$val."'";
        }
        $colums = implode(",",$columsArr);
        $values = implode(",",$valuesArr);
        $sql = "INSERT INTO $table($colums) VALUES($values)";
        $this->query($sql);
    }
    
    public function update($data = array(),$table = "") {
        if($data == null || $table == "" ) {
            return false;
        }
        foreach($data as $key=>$val) {
            $dataUpdate[] = "$key='".$val."'";
        }
        $stringSet = implode(',',$dataUpdate);
        
        $sql = "UPDATE $table SET $stringSet {$this->getWhere()}";
        $this->query($sql);
    }

    public function delete($table = "") {
        if($table == "") {
            return false;
        }
        $sql = "DELETE FROM $table {$this->getWhere()}";
        $this->query($sql);
    }
}