<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Wikishore
 * Date: 8/31/13
 * Time: 9:08 AM
 * To change this template use File | Settings | File Templates.
 */

class Transaction {
    public  $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getTransactions(){
        $query = $this->db->prepare("SELECT * FROM `transact` ORDER BY `id` ASC");

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();

    }

}