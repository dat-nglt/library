<?php
class uploadModel extends database
{
    public function uploadFile($fileName, $fileURL, $idUser)
    {
        $sql = "INSERT INTO upload(fileName, fileURL, timeUpload) VALUES ('$fileName',  '$fileURL', NOW()) WHERE idUser = '$idUser';";
        $query = $this->_query($sql);
        return $query;
    }

}
;
?>