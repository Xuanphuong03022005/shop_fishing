<?php
class homecontroller
{
    public static function index()
    {
        $result_event = EventModel::getAllEvent();
        $result = ProductModel::getAllProduct();
        require_once('view/product/home.php');
    }

    public function loadAllProducts() {
        $data = $_GET['search_data'];
        // Lấy tất cả các sản phẩm từ model
        $products = ProductModel::searchProduct($data);
        if (empty($products)) {
            echo '';  // Trả về chuỗi rỗng nếu không tìm thấy sản phẩm
            return;
        }
        
        // Khởi tạo biến HTML rỗng
        $html = '';
        
        // Duyệt qua các sản phẩm và xây dựng HTML cho từng sản phẩm
        foreach ($products as $product) {
            $html .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
            $html .= '    <div class="card shadow-lg bg-body rounded h-100 d-flex flex-column">';
            $html .= '        <div class="ratio ratio-1x1">';
            $html .= '            <a href="?controller=productcontroller&action=showProduct&id=' . $product['id'] . '">';
            $html .= '                <img class="card-img-top img-fluid" src="public/images/' . $product['image'] . '" alt="Card image" style="object-fit: cover;">';
            $html .= '            </a>';
            $html .= '        </div>';
            $html .= '        <div class="card-body d-flex flex-column text-center pb-3">';
            $html .= '            <h5 class="card-title text-danger mb-2">' . number_format($product['price'], 0, ',', '.') . 'đ</h5>';
            $html .= '            <p class="card-text flex-grow-1 mb-2"><strong>' . $product['name'] . '</strong></p>';
            $html .= '            <form action="?controller=CartController&action=addCart" method="POST">';
            $html .= '                <div class="input-group mb-2 justify-content-center">';
            $html .= '                    <input type="hidden" name="gia" value="' . $product['price'] . '">';
            $html .= '                    <input type="hidden" name="name" value="' . $product['name'] . '">';
            $html .= '                    <input type="hidden" name="image" value="' . $product['image'] . '">';
            $html .= '                    <input type="hidden" name="id" value="' . $product['id'] . '">';
            $html .= '                    <input type="number" name="quantity" class="quantity form-control w-25 text-center" value="1" min="1" max="10" required>';
            $html .= '                    <button name="addCart" type="submit" class="btn btn-light btn-sm">';
            $html .= '                        <img src="public/images/logo_cart2.jpg" style="height: 29px;">';
            $html .= '                    </button>';
            $html .= '                </div>';
            $html .= '            </form>';
            $html .= '            <form method="POST" action="?controller=OrderController&action=byNow">';
            $html .= '                <input type="hidden" name="id" value="' . $product['id'] . '">';
            $html .= '                <input type="hidden" name="quantity" value="1">';
            $html .= '                <button class="btn btn-success mt-auto w-100" type="submit">Mua ngay</button>';
            $html .= '            </form>';
            $html .= '        </div>';
            $html .= '    </div>';
            $html .= '</div>';
        }
    
        // Trả về HTML đã được xây dựng
        echo $html;
    }
}
