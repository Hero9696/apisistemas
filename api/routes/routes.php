<?php

require_once __DIR__ . "/../models/connection.php";
require_once __DIR__ . "/../controllers/get.controller.php";

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*=============================================
When no request is made to the API
status 200,404,201,500,403,401,400,503,502.....
=============================================*/

if (count($routesArray) == 0) {

  $json = array(

    'status' => 404,
    'results' => 'Not Found'

  );

  echo json_encode($json, http_response_code($json["status"]));

  return;
}

/*=============================================
When a request is made to the API
=============================================*/

if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {

  $table = explode("?", $routesArray[1])[0];

  /*=============================================
	secret key validate
	=============================================*/

  if (!isset(getallheaders()["Authorization"]) || getallheaders()["Authorization"] != Connection::apikey()) {

    if (in_array($table, Connection::publicAccess()) == 0) {

      $json = array(

        'status' => 400,
        "results" => "You are not authorized to make this request"
      );

      echo json_encode($json, http_response_code($json["status"]));

      return;
    } else {

      /*=============================================
			public access
			=============================================*/
      $response = new GetController();
      $response->getData($table, "*", null, null, null, null);

      return;
    }
  }

  /*=============================================
		GET Requests
	=============================================*/

  if ($_SERVER['REQUEST_METHOD'] == "GET") {

    include "services/get.php";
  }

  /*=============================================
POST Requests
	=============================================*/

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "services/post.php";
  }

  /*=============================================
	PUT Requests
	=============================================*/

  if ($_SERVER['REQUEST_METHOD'] == "PUT") {

    include "services/put.php";
  }

  /*=============================================
	Peticiones DELETE
	=============================================*/

  if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    include "services/delete.php";
  }
}
