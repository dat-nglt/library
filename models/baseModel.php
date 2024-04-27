<?php 
class baseModel extends database{
    protected $conn;
    public function __construct()
    {
        $this->conn = $this->connect();
    }
    public function _query($sql){
        return mysqli_query($this->conn,$sql);
    }

}
?>