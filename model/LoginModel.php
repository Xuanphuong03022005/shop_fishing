<?php 
class LoginModel{
    public static function addUser($user_name, $phone, $email, $user_account, $password){
        $db123 = Database::getDB();
        $query = "INSERT INTO user(name, phone_number, email, user_account, password)
         VALUE (?, ?, ?, ?, ?)";
        $statement =$db->prepare($query);
        $statement->bindParam(1, $user_name);
        $statement->bindParam(2, $phone);
        $statement->bindParam(3, $email);
        $statement->bindParam(4, $user_account);
        $statement->bindParam(5, $password);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
    public static function loginUser($account, $pass) {
        $db = Database::getDB();
        $query ="SELECT id as id_user, name as name_user, phone_number as phone_user, email as email_user, user_account as account_user, status_user address FROM user 
        WHERE (user_account = ? OR email = ?)
            AND password = ? ";
        $statement=$db->prepare($query);
        $statement->bindParam(1, $account);
        $statement->bindParam(2, $account);
        $statement->bindParam(3, $pass);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return $result;
    }
}   