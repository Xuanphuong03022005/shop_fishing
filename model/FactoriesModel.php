<?php
class FactoriesModel{
    public static function getAllFactory(){
        $db = Database::getDB();
        $query = "SELECT name as fac_name, id FROM factories";
        $statement =$db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
}