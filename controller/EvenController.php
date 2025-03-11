<?php 
class EventController
{
    public function showAddEvent()
    {
        require_once('view/edit/add_envent.php');
    }
    public function addEvent()
    {
        $event = $_POST['event'];
        $image = "";
        $tmp_name = $_FILES['image']['tmp_name'];
        $path = getcwd().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images';
        $image_name= $path.DIRECTORY_SEPARATOR.$_FILES['image']['name'];
        $success = move_uploaded_file($tmp_name, $image_name);
        if($success){
            $image = $_FILES['image']['name'];
        }
        $result =EventModel::addEvent($image, $event); 
        if($result == true){
            $flag = true;
        }
        require_once('view/edit/add_envent.php');
    }
  
}