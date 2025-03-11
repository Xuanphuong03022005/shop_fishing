<?php
class productcontroller
{
    
    public static function viewed()
    {

        $id = $_POST['id'];
        $result = ProductModel::getByProduct($id);
        if(!empty($result)){
            if(!empty($_SESSION['viewed'])){
                foreach($_SESSION['viewed'] as $key => $value){
                    if($id == $value['id']){
                        unset($_SESSION['viewed'][$key]);
                    }
                }
            }
            if (!isset($_SESSION['viewed'])) {
                $_SESSION['viewed'] = [];
            }
            array_unshift($_SESSION['viewed'], [
                'id' => $id,
                'image' => $result['image'],
                'name' => $result['name'],
                'price' => $result['price'] 
            ]
            );
        }

    }
    public static function getByProduct()
    {
        $categories = CatgoriesModel::getAllCategory();
        $factories = FactoriesModel::getAllFactory();
        require_once('view/edit/addprd.php');
    }
    public static function add()
    {
        $image = "";
        $tmp_name = $_FILES['image']['tmp_name'];
        $path = getcwd() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images';
        $name_image = $path . DIRECTORY_SEPARATOR . $_FILES['image']['name'];
        $success = move_uploaded_file($tmp_name, $name_image);
        if ($success) {
            $image = $_FILES['image']['name'];
        }
        $price = $_POST['price'];
        $name = $_POST['name'];
        $category_id = $_POST['category'];
        $factory_id = $_POST['factory'];
        ProductModel::addProduct($image, $price, $name, $category_id, $factory_id);
        $result = ProductModel::getAllProduct();
        route('homecontroller', 'index ');
    }
    public static function showProduct() 
    {
        $id = $_GET['id'] ?? "";
        $result = ProductModel::getByProduct($id);
        require_once('view/product/detail.php');
    }
    public static function managerProduct()
    {
        $result = ProductModel::getAllProduct();
        require_once('view/product/manager_product.php');
    }
    public static function delete()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'];
        $image = $_POST['image'];
        $path = getcwd().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images';
        $deleteImage =unlink($path.DIRECTORY_SEPARATOR.$image);
        $flag = ProductModel::deleteProduct($id);
        $result = ProductModel::getAllProduct();
        if($flag == true){
            echo json_encode([
                'flag' => true,
                'id' => $id
            ]);
            return;
        }
    }
    public function edit(){
        $id = $_GET['id'];
        $result = ProductModel::getByProduct($id);
        $categories = CatgoriesModel::getAllCategory();
        $factories = FactoriesModel::getAllFactory();
        require_once('view/edit/editprd.php');
    }
    public function updateProduct(){
        $id = $_POST['id'];
        $imageHidden =$_POST['imageHidden'];
        $flag = false;
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
            $path =getcwd().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images';
            $deleteImage = unlink($path.DIRECTORY_SEPARATOR.$imageHidden);
            $flag = true;
        }else{
            $image =  $imageHidden;
            $flag = false;
        }
       if($flag == true){
        $tmp_name = $_FILES['image']['tmp_name'];
        $path =getcwd().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images';
        $name_image =$path.DIRECTORY_SEPARATOR.$_FILES['image']['name'];
        $success =move_uploaded_file($tmp_name, $name_image);
        if($success){
            $image = $_FILES['image']['name'];
        }
       }
       $name = $_POST['name'];
       $price = $_POST['price'];
       $category_id = $_POST['category'];
       $factory_id = $_POST['factory'];
       ProductModel::updateProduct($id, $image,$name, $price, $category_id, $factory_id);
       $result=ProductModel::getAllProduct();
       route('homecontroller', 'index ');
    }
    public static function search()
    {
        $data = $_POST['search'];
        $result=ProductModel::searchProduct($data);
        require_once('view/search/search.php');
    }
    public function searchbyid(){
        $id = $_GET['id'];
        $result = ProductModel::searchProduct($id);
        $result_event = EventModel::getAllEvent();
        require_once('view/product/home.php');
    }
}
