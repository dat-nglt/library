<?php

class userController extends baseController
{

    public function __construct()
    {
        $this->loadModel('userModel'); //gọi lại model đã tạo
        $this->userModel = new userModel;

    }


    public function upload()
    {
        if (isset($_POST["uploadURL"])) {
            $fileName = $_POST["uploadURL"];
            echo $fileName;
         
        }
    }
}
?>