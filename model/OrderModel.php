<?php
class OrderModel
{
    public static function OrderProduct($userName,  $userNumberPhone,  
     $userAddress, $discountCode,  $discountName, $reduceMoney,  $totalMoney, $note ,$userId, $userEmail)
    {
        $db =Database::getDB();
        $query ="INSERT INTO orders(user_name, user_number_phone, user_address,
         discount_code, discount_name, reduce_money, total_money, note,	user_id, user_email)
        VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bindParam(1, $userName);
        $statement->bindParam(2, $userNumberPhone);
        $statement->bindParam(3, $userAddress);
        $statement->bindParam(4, $discountCode);
        $statement->bindParam(5, $discountName);
        $statement->bindParam(6, $reduceMoney);
        $statement->bindParam(7, $totalMoney);
        $statement->bindParam(8, $note);
        $statement->bindParam(9, $userId);
        $statement->bindParam(10, $userEmail);
        $flag = $statement->execute();
        $statement->closeCursor();
        return $flag;
    }
    public static function orderDetailProduct($orderId, $productId, $price, $quantity){
        $db =Database::getDB();
        $query ="INSERT INTO order_detail (order_id, product_id, price, quantity)
        VALUE(?, ?, ?, ?)";
        $statement=$db->prepare($query);
        $statement->bindParam(1, $orderId);
        $statement->bindParam(2, $productId);
        $statement->bindParam(3, $price);
        $statement->bindParam(4, $quantity);
        $flag = $statement->execute();
        $statement->closeCursor();
        return $flag;
    }
    public static function getLastId(){
        $db = Database::getDB();
        return $db->lastInsertId();
    }
    public static function getByOrder($id)
    {
        $db = Database::getDB();
        $query = "SELECT id, DATE_FORMAT(created_at, '%d/%m/%Y')  as date, discount_name, reduce_money, total_money FROM orders
        WHERE id = ? ";
        $statement=$db->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
    public static function getAllOderDetail($OrderId){
        $db =Database::getDB();
        $query="SELECT c.name as cate_name, p.name product_name, f.name as fac_name, p.image, o.price, o.quantity FROM order_detail o
        JOIN product p
        ON o.product_id = p.id
        JOIN categories c
        ON p.category_id = c.id
        JOIN factories f
        ON p.factory_id = f.id
        WHERE order_id = ?";
        $statement=$db->prepare($query);
        $statement->bindParam(1, $OrderId);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    public static function getAllOrder()
    {
        $db = Database::getDB();
        $query ="SELECT id, user_name, reduce_money, total_money, created_at, status  FROM orders ";
        $statement=$db ->prepare($query);
        $statement->execute();
        $result =$statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    public static function getAllOrderUserId($id, $status)
    {
        $db = Database::getDB();
        $query ="SELECT id, user_name, reduce_money, total_money, created_at, status  FROM orders 
        WHERE user_id = ?
        AND status != ?
        ";
        $statement=$db ->prepare($query);
        $statement->bindParam(1, $id);
        $statement->bindParam(2, $status);
        $statement->execute();
        $result =$statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    public static function getAllReceived($id, $status)
    {
        $db = Database::getDB();
        $query ="SELECT  id, user_name, reduce_money, total_money, created_at, status  FROM orders 
        WHERE user_id = ?
        AND status = ?";
         $statement=$db->prepare($query);
         $statement->bindParam(1,$id);
         $statement->bindParam(2, $status);
         $statement->execute();
         $result =$statement->fetchAll();
         $statement->closeCursor();
         return $result;
    }
    public static function updateStatus($id, $status)
    {
        $db = Database::getDB();
        $query ="UPDATE orders 
        SET status =?
        WHERE id = ?";
         $statement=$db->prepare($query);
         $statement->bindParam(1,$status);
         $statement->bindParam(2, $id);
         $result = $statement->execute();
         $statement->closeCursor();
         return $result;
    }
}