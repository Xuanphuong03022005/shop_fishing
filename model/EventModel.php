<?php
class EventModel{
    public static function addEvent($image, $event){
        $db = Database::getDB();
        $query ="INSERT INTO events(image, event) VALUE (?, ?)";
        $statement =$db->prepare($query);
        $statement->bindParam(1, $image);
        $statement->bindParam(2, $event);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
    public static function getAllEvent(){
        $db = Database::getDB();
        $query= "SELECT image, event, DATE(create_day) AS time FROM events ";
        $statement=$db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
}