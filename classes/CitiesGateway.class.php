<?php
    class CitiesGateway extends TableGateway{
        //constructor to instantiate object
        public function __construct($connection){
            parent::__construct($connection);
            $this->tableName = 'Cities';
        }
        public function getSelectStatement(){
            
        }
        public function getOrderFields(){
            return 'AsciiName';
        }
        public function getPrimaryKeyName(){
            return 'CityCode';
        }
        public function getTableName(){
            return 'Cities';
        }
    }
?>