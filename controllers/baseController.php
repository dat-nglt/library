<?php
class baseController
{
    const VIEW_FOLDER_NAME = 'views'; //Tạo một hằng
    const MODEL_FOLDER_NAME = 'models'; //Tạo một hằng

    protected function loadview($viewPath, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        return require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }
    protected function loadModel($modelPath)
    {
        return require (self::MODEL_FOLDER_NAME . '/' . $modelPath . '.php'); //models/userModel.php
    }
}
?>