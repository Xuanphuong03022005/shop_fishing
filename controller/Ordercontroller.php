<?php
class OrderController
{
    public static function requestConfirmation()
    {
        header('Content-Type: application/json');
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $flag = true;
            if (!empty($_SESSION['request-confirmation'])) {
                foreach ($_SESSION['request-confirmation'] as $key => $value) {
                    if ($id == $value['id']) {
                        $flag = false;
                    }
                }
            }
            if ($flag) {
                $_SESSION['request-confirmation'][] =
                [
                    'id' => $id
                ];
                $count = count($_SESSION['request-confirmation']);
                echo json_encode([
                    'flag' => true,
                    'count' => $count
                ]);
            }else{
                echo json_encode([
                    'flag' => false
                ]);
            }
        }
    }
      
    public function historyOrderAdmin()
    {
        $_SESSION['request-confirmation'] = [];
        $result =OrderModel::getAllOrder();
        require_once('view/order/admin_history_order.php');
    }
    public static function updateStatus()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'];
        $status = $_POST['status'];
        $result = OrderModel::updateStatus($id, $status);
        if($result == true){
            echo json_encode([
                'flag' => true
            ]);
        }
    }
    public function historyOrder()
    {
        $status = "thành công";
        $id = $_SESSION['info_users']['id'];
        $result =OrderModel::getAllOrderUserId($id, $status);
        $result2 = OrderModel::getAllReceived($id, $status);
        require_once('view/order/history_order.php');
    }
    public function discountAjax()
    {
        header('Content-Type: application/json');
        $data = $_POST['discount'];
        $result = DiscountModel::discountProduct($data);
        $_SESSION['flagDiscount'] = false;
        if (!empty($result)) {
            $discount = $result['code'];
            $_SESSION['totalDiscount'] =  $_SESSION['totalOder'] * (1 - $discount);
            //lay ten
            $_SESSION['discountName'] = $result['name'];
            $_SESSION['discountCode'] = $result['code'] * 100;
            $_SESSION['reduceMoney'] = $_SESSION['totalOder'] - $_SESSION['totalDiscount'];
            $_SESSION['totalOder'] =  $_SESSION['totalDiscount'];
            echo json_encode([
                'total' => $_SESSION['totalOder'],
                'discount_name' => $result['name'],
                'discount_code' => $result['code'] * 100,
                'reduce_money' => $_SESSION['reduceMoney'],
                'flag' => true
            ]);
        } else {
            echo json_encode([
                'flag' => false
            ]);
            $_SESSION['flagDiscount'] = false;
        }
    }
    public function showOrder()
    {

        $deleteDiscount = $_GET['note'] ?? "";
        if (!empty($deleteDiscount)) {
            unset($_SESSION['discount_name']);
            $_SESSION['discount_name'] = 0;
        }
        $_SESSION['discountCode'] =  false;
        $_SESSION['reduceMoney']  =  false;
        $_SESSION['discountName'] = false;
        $_SESSION['flagDiscount'] = false;
        if (!empty($_SESSION['data'])) {
            $_SESSION['subTotal'] = 0;
            foreach ($_SESSION['data'] as $key => $value) {
                $totalprd =  $value['quantity'] *  $value['price'];
                $_SESSION['subTotal'] += $totalprd;
            }
            $_SESSION['totalOder'] =   $_SESSION['subTotal'] + 40000;
        } else {
            $flagOrder = false;
        }

        if (isset($_SESSION['discount_name']) &&  $_SESSION['discount_name'] != 0) {
            $data = $_SESSION['discount_name'];
            $result = DiscountModel::discountProduct($data);
            $_SESSION['flagDiscount'] = false;
            if (!empty($result)) {
                $discount = $result['code'];
                $_SESSION['totalDiscount'] =  $_SESSION['totalOder'] * (1 - $discount);
                //lay ten
                $_SESSION['discountName'] = $result['name'];
                $_SESSION['discountCode'] = $result['code'] * 100;
                $_SESSION['reduceMoney'] = $_SESSION['totalOder'] - $_SESSION['totalDiscount'];
                $_SESSION['totalOder'] =  $_SESSION['totalDiscount'];
            } else {
                $_SESSION['flagDiscount'] = true;
            }
        }
        require_once('view/order/order.php');
    }
    public function byNow()
    {
        $quantity = $_POST['quantity'];
        $id = $_POST['id'];
        $data = ProductModel::getByProduct($id);
        $_SESSION['data'] = [
            [
                'id' => $data['id'],
                'image' => $data['image'],
                'name' => $data['name'],
                'price' => $data['price'],
                'cate_name' => $data['cate_name'],
                'fac_name' => $data['fac_name'],
                'quantity' => $quantity
            ]
        ];
        route('OrderController', 'showOrder');
    }
    public static function checkOut()
    {
        $array = $_POST['product'];
        $_SESSION['data'] = [];
        foreach ($array as $key => $value) {
            $id = $value['id'];
            $quantity = $value['quantity'];
            $data = ProductModel::getByProduct($id);
            if (!empty($data)) {
                $_SESSION['data'][] = [
                    'quantity' => $quantity,
                    'id' => $data['id'],
                    'image' => $data['image'],
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'cate_name' => $data['cate_name'],
                    'fac_name' => $data['fac_name'],

                ];
            }
        }

        route('OrderController', 'showOrder');
    }

    public function checkMoneyAjax()
    {
        header('Content-Type: application/json');
        $data = $_POST['items'];
        $discount = $_POST['discount_code'];
        if (!empty($data)) {
            $sum = 0;
            $count = 0;
            foreach ($data as $key => $value) {
                $count++;
                $id = $value['id'];
                $result = ProductModel::getByProduct($id);
                $total_price = $result['price'] * $value['quantity'];
                $sum = $sum + $total_price;
            }
            $sumprd = $sum;
            $ship_vat = 40000;
            $_SESSION['totalPrice'] = ($sum + $ship_vat);

            if (!empty($discount)) {
                $result = DiscountModel::discountProduct($discount);
                $code = $result['code'];
                $_SESSION['totalPrice'] = $_SESSION['totalPrice'] * (1 - $code);
            }
            echo json_encode([
                'totalprice' => number_format($_SESSION['totalPrice']),
                'flag' => true,
                'count' => $count,
                'sumprd' => number_format($sumprd)

            ]);
            return;
        }
    }
    public function orderPayment()
    {
        $userId = $_POST['id_user'];
        $userName = $_POST['user_name'];
        $userNumberPhone = $_POST['user_number_phone'];
        $userEmail = $_POST['user_email'];
        $userAddress = $_POST['user_address'];
        $totalMoney = $_POST['total_money'];
        $discountCode = $_POST['discount_code'];
        $discountName = $_POST['discount_name'];
        $reduceMoney = $_POST['reduce_money'];
        $note = $_POST['note'];
        $result = OrderModel::OrderProduct(
            $userName,
            $userNumberPhone,
            $userAddress,
            $discountCode,
            $discountName,
            $reduceMoney,
            $totalMoney,
            $note,
            $userId,
            $userEmail
        );
        $orderId = OrderModel::getLastId();
        $products = $_POST['products'];
        if (!empty($orderId)) {
            foreach ($products as $key => $value) {
                $productId = $value['id'];
                $price = $value['price'];
                $quantity = $value['quantity'];
                $flag = OrderModel::orderDetailProduct($orderId, $productId, $price, $quantity);
                if ($flag == true) {
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key2 => $value) {
                            if ($productId == $value['id']) {
                                unset($_SESSION['cart'][$key2]);
                                $_SESSION['count'] = count($_SESSION['cart']);
                            }
                        }
                    }
                    $_SESSION['flagOrder'] =  $orderId;
                }
            }
        }
        route('OrderController', 'OrderSuccess');
    }
    public function OrderSuccess()
    {
        $id = $_SESSION['flagOrder'];
        $result = OrderModel::getByOrder($id);
        $product = OrderModel::getAllOderDetail($id);
        $count = count($product);
        require_once('view/order/order_success.php');
    }
}
