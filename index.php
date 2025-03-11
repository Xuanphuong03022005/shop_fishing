<?php
session_start();
require_once 'config/Database.php';
$db = Database::getDB();

if (isset($_POST['controller'])) {
    $controller = $_POST['controller'];
} elseif (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
} else {
    $controller = 'homecontroller';
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

if ($controller == 'logincontroller' && $action == 'showLogin' 
    || $action == 'discountCode' || $action == 'checkMoneyAjax'
    || $action == 'loadAllProducts'
    ||$action == 'delete'
    || $action == 'addCart'
    ||$action == 'discountAjax'
    ||$action=='updateStatus'
    ||$action=='requestConfirmation') {
    require_once('routes/web.php');
} else {
    require_once 'view/layout/master.php';
}
function route($controllerName, $actionName)
{
    header("location: ?controller=$controllerName&action=$actionName");
}
?> 