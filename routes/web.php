<?php
require_once('controller/HomeController.php');
require_once('controller/LoginController.php');
require_once('controller/UserController.php');
require_once('controller/ProductController.php');
require_once('controller/CartController.php');
require_once('controller/Ordercontroller.php');
require_once('controller/EvenController.php');
require_once('model/LoginModel.php');
require_once('model/CatgoriesModel.php');
require_once('model/factoriesModel.php');
require_once('model/ProductModel.php');
require_once('model/DiscountModel.php');
require_once('model/EventModel.php');
require_once('model/OrderModel.php');
    switch($controller){
        case 'homecontroller':
            $controller = new homecontroller();
            break;
        case 'productcontroller' :
            $controller = new productcontroller();
            break;
        case 'logincontroller' :
            $controller = new LoginController();
            break;
        case 'usercontroller' :
            $controller = new usercontroller();
            break;
        case 'CartController' :
            $controller = new CartController();
            break;
        case 'OrderController' :
            $controller = new OrderController();
            break;
        case 'EventController' :
            $controller = new EventController();
            break;
}
    $controller->{$action}();
    
 