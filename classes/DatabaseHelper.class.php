<?php
class DatabaseHelper{
    //this function creates the connection with the database and returns it
    //modeled from the lab6
    public static function createConnection($values=array()){
        $conString = $values[0];
        $user = $values[1];
        $passwd = $values[2];
        
        $pdo = new PDO($conString,$user,$passwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; 
    }
    //this function runs query based upon the structure in lab6
    public static function runQuery($connection, $sql, $paramaters=array()){
        if(!is_array($paramaters)){
            $paramaters = array($paramaters);
        }
        $statement = null;
        if(count($paramaters)>0){
            $statement = $connection->prepare($sql);
            $executedOK = $statement->execute($paramaters);
            if(!$executedOK){
                throw new PDOException;
            }
        }
        else{
            $statement = $connection->query($sql);
            if(!$statement){
                throw new PDOException;
            }
        }
        return $statement;
    }
}
?>