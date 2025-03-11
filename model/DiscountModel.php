<?php
class DiscountModel
{
    public static function discountProduct($name)
    {
        $db = Database::getDB();
        $query ="SELECT name,code FROM discount
         WHERE name = ?";
        $statement=$db->prepare($query);
        $statement->bindParam(1, $name);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
}
?>