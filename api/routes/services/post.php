<?php

require_once "models/connection.php";
require_once "controllers/post.controller.php";

if(isset($_POST)){

  /*=============================================
  Separate properties into an array
  =============================================*/

  $columns = array();
  
  foreach (array_keys($_POST) as $key => $value) {

    array_push($columns, $value);
      
  }

  /*=============================================
  Validate table and columns
  =============================================*/

  if(empty(Connection::getColumnsData($table, $columns))){

    $json = array(
      'status' => 400,
      'results' => "Error: Fields in the form do not match the database"
    );

    echo json_encode($json, http_response_code($json["status"]));

    return;

  }

  $response = new PostController();

  /*=============================================
  POST request to register user
  =============================================*/	

  if(isset($_GET["register"]) && $_GET["register"] == true){

    $suffix = $_GET["suffix"] ?? "user";

    $response -> postRegister($table,$_POST,$suffix);

  /*=============================================
  POST request for user login
  =============================================*/	

  }else if(isset($_GET["login"]) && $_GET["login"] == true){

    $suffix = $_GET["suffix"] ?? "user";

    $response -> postLogin($table,$_POST,$suffix);

  }else{


    if(isset($_GET["token"])){

      /*=============================================
      POST request for unauthorized users
      =============================================*/

      if($_GET["token"] == "no" && isset($_GET["except"])){

        /*=============================================
        Validate table and columns
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
        Request response from controller to create data in any table
        =============================================*/		

        $response -> postData($table,$_POST);

      /*=============================================
      POST request for authorized users
      =============================================*/

      }else{

        $tableToken = $_GET["table"] ?? "users";
        $suffix = $_GET["suffix"] ?? "user";

        $validate = Connection::tokenValidate($_GET["token"],$tableToken,$suffix);

        /*=============================================
        Request response from controller to create data in any table
        =============================================*/		

        if($validate == "ok"){
    
          $response -> postData($table,$_POST);

        }

        /*=============================================
        Error when token has expired
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
        Error when token doesn't match in DB
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

}


class PostService {
    public static function createTerapeuta($data) {
        $conn = Connection::connect();
        $stmt = $conn->prepare("INSERT INTO dbo.Terapeuta (nombre, especialidad) VALUES (?, ?)");
        $stmt->execute([$data['nombre'], $data['especialidad']]);
        return ['id' => $conn->lastInsertId()];
    }
   
}
?>