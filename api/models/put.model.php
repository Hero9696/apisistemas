<?php

require_once "connection.php";
require_once "get.model.php";

class PutModel
{
  /*==========================
  PUT PETITION
  example : update USERS SET fist_name= 'Multon', last_name = 'Gomez' WHERE id = 1 and state_user = true;
  ==========================*/
  static public function putData($table, $data, $id, $nameId)
  {
    /*==========================
    validate from id
    ==========================*/
    $reponse = GetModel::getDataFilter($table, $nameId, $id, null, null, null, null, null);

    if (empty($reponse)) {
      return null;
    }

    /*==========================
    update data
    ==========================*/

    $set = "";

    foreach ($data as $key => $value) {
      $set .= $key . " = :" . $key . ",";
    }
    $set = substr($set, 0, -1);
    $sql = "UPDATE $table SET $set WHERE $nameId = :$nameId";
    $link = Connection::connect();
    $stmt = $link->prepare($sql);
    //looping the data to bind the params
    foreach ($data as $key => $value) {
      $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
    }
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
