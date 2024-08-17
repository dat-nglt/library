<?php
class chartModel extends baseModel
{
  //user đem qua



  //admin đem qua
  public function countRequestInMonth()
  {
    $sql = "SELECT 
    MONTH(dateRental) AS month,
    COUNT(*) AS count
    FROM 
        request
    WHERE 
        YEAR(dateRental) = YEAR(NOW())
    GROUP BY 
        MONTH(dateRental)
    ORDER BY month;";
    $query = $this->_query($sql);
    return $query;
  }

  public function countStatusRequest()
  {
    $sql = "SELECT statusRequest, COUNT(*) AS total 
    FROM request
    GROUP BY statusRequest";

    $query = $this->_query($sql);
    return $query;
  }

  public function countUser()
  {
    $sql = "SELECT roleAccess, COUNT(*) AS total 
    FROM user
    GROUP BY roleAccess;";
    $query = $this->_query($sql);
    return $query;
  }

  public function countCategory()
  {
    $sql = "SELECT category.idCategory, category.nameCategory, COUNT(*)
    FROM book
    INNER JOIN category ON book.id_Category = category.idCategory
    GROUP BY category.nameCategory";
    $query = $this->_query($sql);
    return $query;
  }
}