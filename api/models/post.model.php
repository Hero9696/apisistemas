<?php

//adding the conection to the database
require_once 'connection.php';

class PostModel
{
  //post petition from add dinamycally 
  static public function postData($table, $data)
  {
    $columns = "";
    $params = "";

    //looping the data to get the columns and params
    foreach ($data as $key => $value) {
      $columns .= $key . ",";
      $params .= ":" . $key . ",";
    }

    $columns = substr($columns, 0, -1);
    $params = substr($params, 0, -1);

    //query to insert the data
    $sql = "INSERT INTO $table ($columns) VALUES ($params)";
    $link = Connection::connect();
    $stmt = $link->prepare($sql);

    //looping the data to bind the params
    foreach ($data as $key => $value) {
      $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
    }
    //execute the query
    if ($stmt->execute()) {
      $reponse = array(
        "lastId" => $link->lastInsertId(),
        "comment" => "Data inserted successfully"
      );

      return $reponse;
    } else {
      return $link->errorInfo();
    }
  }
}
