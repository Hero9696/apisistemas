<?php

require_once __DIR__ . "/../models/put.model.php";

class PutController
{
  static public function putData($table, $data, $id, $nameId)
  {
    $response = PutModel::putData($table, $data, $id, $nameId);
    self::fncResponse($response);
  }

  static public function fncResponse($response)
  {
    http_response_code($response["status"]);
    echo json_encode([
      "status" => $response["status"],
      "results" => $response
    ]);
  }
}

