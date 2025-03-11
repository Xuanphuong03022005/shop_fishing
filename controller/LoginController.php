<?php
class LoginController{
    public static function showLogin()
    {
         $_SESSION['status-u'] = "";
        require_once('view/login/login.php');
    }
    public static function login()
    {
        $account = $_POST['email'] ?? "";
        $pass = md5($_POST['pass']) ?? "";
        $result = LoginModel::loginUser($account, $pass);
        if (!empty($result)) {
            $id = $result['id_user'];
            $name = $result['name_user'];
            $phone = $result['phone_user'];
            $acc =$result['account_user'];
            $email =$result['email_user'];
            $address = $result['address'];
            $_SESSION['count'] = 0;
            $info = $_SESSION['info_users'] = [
                'id'    => $id,
                'name'  => $name,
                'phone' => $phone,
                'acc' => $acc,
                'email' => $email,
                'address' => $address
            ];
            $_SESSION['flag'] = true;
            // $_SESSION['status_login'] = 'status_user';          
            route('homecontroller', 'index');
        } else {
            route('logincontroller', 'showLogin');

        }
    }
    public static function logOut()
    {
        unset($_SESSION['info_users']);
        unset($_SESSION['viewed']);
        route('homecontroller', 'index');
    }
}