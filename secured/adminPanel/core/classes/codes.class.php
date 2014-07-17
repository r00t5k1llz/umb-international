<?php

class Codes {
    public  $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getCodes(){
        $query = $this->db->prepare("SELECT * FROM `codes` ORDER BY `id` ASC");

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();

    }

    public function addCode($code){

        $query 	= $this->db->prepare("INSERT INTO `codes` (`codes`) VALUES (?)");

        $query->bindValue(1, $code);

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

}