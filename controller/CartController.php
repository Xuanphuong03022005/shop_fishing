<?php
class CartController
{
    public function discountCode()
    {
        // Đặt kiểu dữ liệu trả về là JSON
        header('Content-Type: application/json');
        if (isset($_POST['discount_code'])) {
            $name = $_POST['discount_code'];
            $result = DiscountModel::discountProduct($name);

            if (!empty($result) && $result != false) {
                $code = $result['code'];
                //lay ten ma giam gia
                $_SESSION['discount_name'] = $result['name'];
                //
                if ($_SESSION['totalPrice'] > 0) {
                    $_SESSION['totalPrice'] = $_SESSION['totalPrice'] * (1 - $code);
                    $_SESSION['numberCode'] = $code * 100;
                }

                // Gửi JSON về client
                echo json_encode([
                    'numberCode' =>  $_SESSION['numberCode'],
                    'success' => true,
                    'total' => number_format($_SESSION['totalPrice'])
                ]);
                return;
            } else { // Trường hợp ko tìm ra mã giảm giá
                echo json_encode([
                    'success' => false,
                    'total' => number_format($_SESSION['totalPrice'])
                ]);
                return;
            }
        }

        // Nếu không nhận được discount_code
        echo json_encode(['success' => false, 'message' => 'Mã giảm giá không hợp lệ']);
    }

    public static function showCart()
    {
        $_SESSION['discount_name'] = 0;
        $_SESSION['discount_code'] = 0;
        if (isset($_POST['code'])) {
            $name = $_POST['code'];
            $result = DiscountModel::discountProduct($name);
            if (!empty($result) && $result != false) {
                $code = $result['code'];
                if ($_SESSION['totalPrice'] > 0) {
                    $_SESSION['totalPrice'] = $_SESSION['totalPrice'] * (1 - $code);
                    $_SESSION['numberCode'] = $code * 100;
                }
            } else {
                route('CartController', 'showCart');
            }
        } else {
            $carts = $_SESSION['cart'] ?? "";
            if (!empty($carts)) {
                foreach ($carts as $key => $value) {
                    $id = $value['id'];
                    $result = ProductModel::getByProduct($id);
                    if ($result == false) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
                $count = 0;
                $totalCart = 0;
                $shipping = 30000;
                $vat = 10000;
                foreach ($carts as $key => $value) {
                    $count++;
                    $totalCart = $totalCart + ($value['quantity'] * $value['price']);
                }

                $_SESSION['totalPrice'] = $shipping + $vat + $totalCart;
                $_SESSION['count'] = $count;
                $_SESSION['totalCart'] = $totalCart;
                $_SESSION['numberCode'] = 0;
            } else {
                $_SESSION['totalPrice'] = 0;
                $_SESSION['count'] = 0;
                $_SESSION['totalCart'] = 0;
                $_SESSION['numberCode'] = 0;
            }
        }

        require_once('view/cart/cart.php');
    }
    public static function addCart()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $result = ProductModel::getByProduct($id);
        $image = $result['image'];
        $price = $result['price'];
        $name = $result['name'];
        $cate_name = $result['cate_name'];
        $fac_name = $result['fac_name'];
        $flag = false;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($id == $value['id']) {
                    $_SESSION['cart'][$key]['quantity'] += $quantity;
                    $flag = true;
                    break;
                }
            }
        }
        if ($flag == false) {
            $_SESSION['cart'][] =
                [
                    'id' => $id,
                    'quantity' => $quantity,
                    'image' => $image,
                    'price' => $price,
                    'name' => $name,
                    'cate_name' => $cate_name,
                    'fac_name' => $fac_name
                ];
            $_SESSION['count'] = count($_SESSION['cart']);
        }
        if (!empty($result)) {
            echo json_encode([
                'image' => $image,
                'flag' => true,
                'name' => $name,
                'quantity' => $quantity,
                'countItemInCart' => count($_SESSION['cart'])
            ]);
        } else {
            echo json_encode([
                'flag' => false,
            ]);
        }
    }
    public static function deleteCart()
    {
        unset($_SESSION['cart']);
        route('CartController', 'showCart');
    }
    public static function reduce()
    {
        $id = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($id == $value['id']) {
                $_SESSION['cart'][$key]['quantity'] -= 1;
                if ($_SESSION['cart'][$key]['quantity'] == 0) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
        route('CartController', 'showCart');
    }
    public static function deleteItem()
    {
        $id = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $id) {
                unset($_SESSION['cart'][$key]);
            }
        }
        route('CartController', 'showCart');
    }
    public static function increase()
    {
        $id = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($id == $value['id']) {
                $_SESSION['cart'][$key]['quantity'] += 1;
            }
        }
        route('CartController', 'showCart');
    }
}
