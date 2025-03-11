<?php
class ProductModel
{
    
    public static function getAllProduct()
    {
        $db = Database::getDB();
        $query = "SELECT p.id, p.image as image, p.price as price, p.name as name, c.name as name_cate, f.name as  name_fac, c.id as id_cate, f.id as id_fac FROM product p
        JOIN categories c ON p.category_id = c.id
        JOIN factories f ON p.factory_id =f.id";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    public static function getByProduct($id)
    {
        $db = Database::getDB();
        $query = "SELECT p.id, p.image as image, p.price as price, p.name as name, c.name as cate_name, f.name as fac_name, c.id as id_cate, f.id as id_fac  FROM product p
        JOIN categories c ON p.category_id = c.id
        JOIN factories f ON p.factory_id =f.id
        WHERE p.id = '$id'";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
    public static function addProduct($image,  $price,  $name, $category_id, $factory_id)
    {
        $db = Database::getDB();
        $query = "INSERT INTO product(image, price, name, category_id, factory_id)
     VALUES (?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bindParam(1, $image);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $name);
        $statement->bindParam(4, $category_id);
        $statement->bindParam(5, $factory_id);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function deleteProduct($id)
    {
        $db = Database::getDB();
        $query = "DELETE FROM product 
        WHERE id = ?";
        $statement = $db->prepare($query);
        $statement->bindParam(1, $id);
        $flag = $statement->execute();
        $statement->closeCursor();
        return $flag;
    }
    public static function searchProduct($data)
    {
        $data = "%" . $data . "%";
        $db = Database::getDB();
        $query = "SELECT  p.id, p.image as image, p.price as price, p.name as name, c.name as cate_name,
         f.name as fac_name, c.id as id_cate, f.id as id_fac  FROM product p 
        JOIN categories c
        ON p.category_id = c.id
        JOIN factories f
        ON P.factory_id = f.id
        WHERE p.name LIKE ?
        OR  f.name LIKE ?
        OR c.name LIKE ?";
        $statement = $db->prepare($query);
        $statement->bindParam(1, $data);
        $statement->bindParam(2, $data);
        $statement->bindParam(3, $data);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    public static function updateProduct($id, $image, $name, $price, $category_id, $factory_id)
    {
        $db = Database::getDB();
        $query = "UPDATE product
        SET image = ?,
            price = ?,
            name = ?,
            category_id = ?,
            factory_id = ?
        WHERE id = ?";
        $statement = $db->prepare($query);
        $statement->bindParam(1, $image);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $name);
        $statement->bindParam(4, $category_id);
        $statement->bindParam(5, $factory_id);
        $statement->bindParam(6, $id);
        $statement->execute();
        $statement->closeCursor();
    }
}
