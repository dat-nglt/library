<?php 
class database{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const DBNAME = 'libary_manage';
    const PASSWORD = '';
    public function connect(){
        $conn = mysqli_connect(self::HOST,self::USERNAME,self::PASSWORD,self::DBNAME);
        if(mysqli_connect_errno() == 0){
            return $conn;
        }
        return false;
    }
}
?>