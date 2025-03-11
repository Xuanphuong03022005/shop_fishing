<?php
class usercontroller
{
    public static function register()
    {
        $_SESSION['status-u'] = 'hide';
        $user_name = $_POST['user_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $user_account = $_POST['use_account'];
        $pass = md5($_POST['pass']);
        $result = LoginModel::addUser($user_name, $phone, $email, $user_account, $pass);
        if($result == true){
            $_SESSION['status-u'] = true;
            route('logincontroller', 'showLogin');
        }else{
            $_SESSION['status-u'] = false;
            route('logincontroller', 'showLogin');
          
        }
    }


}
