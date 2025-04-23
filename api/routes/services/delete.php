<?php

require_once "models/connection.php";
require_once "controllers/delete.controller.php";

if(isset($_GET["id"]) && isset($_GET["nameId"])){

  $columns = array($_GET["nameId"]);

  /*=============================================
  Validate the table and columns
  =============================================*/

  if(empty(Connection::getColumnsData($table, $columns))){

    $json = array(
      'status' => 400,
      'results' => "Error: Fields in the form do not match the database"
    );

    echo json_encode($json, http_response_code($json["status"]));

    return;

  }

  /*=============================================
  DELETE request for authorized users
  =============================================*/

  if(isset($_GET["token"])){

    if($_GET["token"] == "no" && isset($_GET["except"])){

      /*=============================================
      Validate the table and columns
      =============================================*/

      $columns = array($_GET["except"]);

      if(empty(Connection::getColumnsData($table, $columns))){

        $json = array(
          'status' => 400,
          'results' => "Error: Fields in the form do not match the database"
        );

        echo json_encode($json, http_response_code($json["status"]));

        return;

      }

      /*=============================================
      Request response from the controller to delete data in any table
      =============================================*/	

      $response = new DeleteController();
      $response -> deleteData($table,$_GET["id"],$_GET["nameId"]);	


    }else{

      $tableToken = $_GET["table"] ?? "users";
      $suffix = $_GET["suffix"] ?? "user";

      $validate = Connection::tokenValidate($_GET["token"],$tableToken,$suffix);

      /*=============================================
      Request response from the controller to delete data in any table
      =============================================*/	
        
      if($validate == "ok"){
    
        $response = new DeleteController();
        $response -> deleteData($table,$_GET["id"],$_GET["nameId"]);

      }

      /*=============================================
      Error when the token has expired
      =============================================*/	

      if($validate == "expired"){

        $json = array(
          'status' => 303,
          'results' => "Error: The token has expired"
        );

        echo json_encode($json, http_response_code($json["status"]));

        return;

      }

      /*=============================================
      Error when the token does not match in DB
      =============================================*/	

      if($validate == "no-auth"){

        $json = array(
          'status' => 400,
          'results' => "Error: The user is not authorized"
        );

        echo json_encode($json, http_response_code($json["status"]));

        return;

      }

    }

  /*=============================================
  Error when no token is sent
  =============================================*/	

  }else{

    $json = array(
      'status' => 400,
      'results' => "Error: Authorization required"
    );

    echo json_encode($json, http_response_code($json["status"]));

    return;	

  }	

}

class DeleteService {
    public static function deleteReligion($id) {
        $conn = Connection::connect();
        $stmt = $conn->prepare("DELETE FROM dbo.Religion WHERE id = ?");
        $stmt->execute([$id]);
        return ['deleted' => $stmt->rowCount() > 0];
    }
}
?>