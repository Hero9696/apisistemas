<?php

require_once "connection.php";
require_once "get.model.php";

class DeleteModel
{
  /*==========================
  DELETE PETITION
  example : DELETE FROM USERS WHERE id = 1 and state_user = true;
  todo: deleted is not removed from the database
  ==========================*/
  static public function deleteData($table, $id, $nameId)
  {
    /*==========================
    validate from id
    ==========================*/
    $reponse = GetModel::getDataFilter($table, $nameId, $nameId, $id, null, null, null, null);
    if (empty($reponse)) {
      return null;
    }
    /*==========================
    delete data
    ==========================*/
    $sql = "DELETE FROM $table WHERE $nameId = :$nameId";
    //$sql = "UPDATE $table SET deleted = 1 WHERE $nameId = :$nameId";

    $link = Connection::connect();
    $stmt = $link->prepare($sql);
    $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $reponse = array(
        "comment" => "The process was successful"
      );

      return $reponse;
    } else {
      return $link->errorInfo();
    }
  }
}
