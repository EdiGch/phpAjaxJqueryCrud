<?php

namespace App;
use App\Connect;

use PDO;

class Tsql
{

    private $dbConnect;

    public function __construct(){
        $connect = new Connect(); 
        $this->dbConnect = $connect->getDbConnect();
    }

    public function setData($table, $data){
        try {
            $sql = "INSERT INTO $table (name) VALUES ('$data')";
            $query = $this->dbConnect->exec($sql);
    
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function getRowsLike($table, $columName, $value){


        try {
            
            $select = 'SELECT * FROM '.$table.' WHERE '.$columName.' LIKE ' ."'%$value%'";
            $query = $this->dbConnect->query($select)->fetchAll();
            return  $query;
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
        

        
    }


    public function getRow($querySql, $params = [])
    {
        try {
            $query = $this->dbConnect->prepare($querySql);
            $query->execute($params);
            return $query->fetch();
        } catch (PDOException $e) {
            return $ennror = $e->getMessage();
        }
    }

    public function queryBuiltParameters(array $selectAll){

        $tableName = $selectAll['TableName'];
        $whereColumn = $selectAll['WhereColumn'];
        $whereValue = $selectAll['WhereValue'];

        $querySql = 'Select * From ' . $tableName . ' Where '  . $tableName. '.' .$whereColumn . ' = "' . $whereValue . '"';

        $query = $this->dbConnect->query($querySql)->fetchAll();

        return $query;

    }

    public function selectAll(string $tableName){

        try {
            $select = 'SELECT * from ' . $tableName ;
            $query = $this->dbConnect->query($select)->fetchAll();
            return  $query;
        } catch (PDOException $e) {
            return $ennror = $e->getMessage();
        }
    }

    public function update(array $update){

        $tableName = $update['tableName'];
        $columName = $update['columName'];
        $updateValue = $update['updateValue'];
        $updateIdValue = $update['updateIdValue'];

        try {
            $select = "UPDATE " .$tableName. " SET " .$columName." = '$updateValue'  WHERE id = " .$updateIdValue;  
            $query = $this->dbConnect->exec($select);
            return  $query;
        } catch (PDOException $e) {
            return $ennror = $e->getMessage();
        }
    }


}