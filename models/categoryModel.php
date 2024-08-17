<?php

class categoryModel extends baseModel
{
  //user đem qua

  public function getDataType()
  {
    $sql = "SELECT * FROM category";
    $query = $this->_query($sql);
    return $query;
  }


  //admin đem qua
  public function getAllCategory($search)
  {
    $sql = "SELECT * FROM category WHERE nameCategory like '%$search%'";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListCategory($start, $limit, $sort, $search)
  {
    $sql = "SELECT * FROM category WHERE nameCategory like '%$search%' ORDER BY idCategory $sort LIMIT $start,$limit";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkCategoryWithName($categoryName)
  {
    $sql = "SELECT * FROM category WHERE nameCategory = '$categoryName'";
    $query = $this->_query($sql);
    return $query;
  }

  public function addCategory($name)
  {
    $sql = "INSERT INTO category VALUES ('','$name')";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkCategoryWithId($categoryId)
  {
    $sql = "SELECT * FROM category WHERE idCategory = '$categoryId'";
    $query = $this->_query($sql);
    return $query;
  }

  public function updateCategory($id, $name)
  {
    $sql = "UPDATE category SET nameCategory = '$name' WHERE idCategory = $id";
    $query = $this->_query($sql);
    return $query;
  }
}
