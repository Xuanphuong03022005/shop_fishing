<?php
class Database
{
    private static $sever = 'mysql:host=localhost;dbname=shop_fishing';
    private static $user = 'root';
    private static $pass = '';
    private static $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    private static $db;

    public static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$sever, self::$user, self::$pass, self::$option);
            } catch (PDOException $e) {
                $err_message = $e->getMessage();
                echo "Kết nối không thành công, lỗi vì: $err_message";
            }
        }
        return self::$db;
    }
}
