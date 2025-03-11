<?php
class CatgoriesModel{
    public static function getAllCategory(){
        $db = Database::getDB();
        $query = "SELECT name as cate_name, id FROM categories";
        $statement =$db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
}