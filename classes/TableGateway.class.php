<?php

    //This Data Access Object is inspired and modeled from Randy's Web2 Lab 6
    //this object is used to interact with the database
    abstract class TableGateway{
        protected $connection;
        
        
        public function __construct($conn){
            if(is_null($conn)){
                throw new Exception("Connection is null");
            }
            $this->connection = $conn;
        }
        //returns the table name
        abstract protected function getTableName();
        //Returns fields to orderby
        abstract protected function getOrderFields();
        
        //returns the Primary Key
        abstract protected function getPrimaryKeyName();
        
        //reutrns all records in a table
        public function getAll($sortfields=null){
            $sql = $this->select();
            if(!is_null($sortfields)){
                $sql .= ' ORDER BY '.$sortfields;
            }
            $statement = DatabaseHelper::runQuery($this->connection,$sql,null);
            return $statement->fetchAll();
        }
        
        //returns all records with a specified order field
        public function findAllSorted($ascending){
            $sql = $this->select().' ORDER BY '.$this->getOrderFields();
            if(!$ascending){
                $sql .=' DESC';
            }
            $statement = DatabaseHelper::runQuery($this->connection,$sql, null);
            return $statement->fetchAll();
        }
   
        //finds a record by ID
        public function findById($id){
            $sql = $this->select().'WHERE '.$this->getPrimaryKeyName().' =:id';
            $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':id' => $id));
            return $statement->fetch();
        }
        //finds certain fields
        public function findParam($param){
           $sql = $this->select($param);
           $statement = DatabaseHelper::runQuery($this->connection,$sql,null);
           return $statement->fetchAll();
        }
        //this function gets the select statement depending on the paramaters passed in
        protected function select($param=null){
            if(is_null($param)) { $statement = 'SELECT * FROM '.$this->getTableName(); }
            
            else if(is_array($param)){
                $statement = 'SELECT '.$param[0];
                reset($param);
                next($param);
                
                foreach($param as $select){
                    $statement .= ", $select";
                }
                $statement .= " FROM ".$this->getTableName();
            }
            else{
                $statement = "SELECT $param  FROM ".$this->getTableName();
            }
            return $statement;
        }
        //this function slects by paramaters
        
            
    }
    

?>