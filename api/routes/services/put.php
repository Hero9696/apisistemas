<?php

require_once "models/connection.php";
require_once "controllers/put.controller.php";

if (isset($_GET["id"]) && isset($_GET["nameId"])) {

  /*=============================================
  Capture form data
  =============================================*/

  $data = array();

  parse_str(file_get_contents('php://input'), $data);

  /*=============================================
  Separate properties into an array
  =============================================*/

  $columns = array();

  foreach (array_keys($data) as $key => $value) {

    array_push($columns, $value);
  }

  array_push($columns, $_GET["nameId"]);

  $columns = array_unique($columns);

  /*=============================================
  Validate table and columns
  =============================================*/

  if (empty(Connection::getColumnsData($table, $columns))) {

    $json = array(
      'status' => 400,
      'results' => "Error: Fields in the form do not match the database"
    );

    echo json_encode($json, http_response_code($json["status"]));

    return;
  }

  if (isset($_GET["token"])) {

    /*=============================================
    PUT request for unauthorized users
    =============================================*/

    if ($_GET["token"] == "no" && isset($_GET["except"])) {

      /*=============================================
      Validate table and columns
      =============================================*/

      $columns = array($_GET["except"]);

      if (empty(Connection::getColumnsData($table, $columns))) {

        $json = array(
          'status' => 400,
          'results' => "Error: Fields in the form do not match the database"
        );

        echo json_encode($json, http_response_code($json["status"]));

        return;
      }

      /*=============================================
      Request controller response to create data in any table
      =============================================*/

      $response = new PutController();
      $response->putData($table, $data, $_GET["id"], $_GET["nameId"]);

      /*=============================================
    PUT request for authorized users
    =============================================*/
    } else {

      $tableToken = $_GET["table"] ?? "users";
      $suffix = $_GET["suffix"] ?? "user";

      $validate = Connection::tokenValidate($_GET["token"], $tableToken, $suffix);

      /*=============================================
      Request controller response to edit data in any table
      =============================================*/

      if ($validate == "ok") {

        $response = new PutController();
        $response->putData($table, $data, $_GET["id"], $_GET["nameId"]);
      }

      /*=============================================
      Error when token has expired
      =============================================*/

      if ($validate == "expired") {

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

      if ($validate == "no-auth") {

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
  } else {

    $json = array(
      'status' => 400,
      'results' => "Error: Authorization required"
    );

    echo json_encode($json, http_response_code($json["status"]));

    return;
  }
}
