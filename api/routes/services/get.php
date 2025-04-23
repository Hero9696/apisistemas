<?php

require_once __DIR__ . "/../../controllers/get.controller.php";
require_once __DIR__ . "/../../models/connection.php";

$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;
$filterTo = $_GET["filterTo"] ?? null;
$inTo = $_GET["inTo"] ?? null;

$response = new GetController();

/*=============================================
GET requests with filter
=============================================*/

if (isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["rel"]) && !isset($_GET["type"])) {

  $response->getDataFilter($table, $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

  /*=============================================
GET requests without filter between related tables
=============================================*/
} else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {

  $response->getRelData($_GET["rel"], $_GET["type"], $select, $orderBy, $orderMode, $startAt, $endAt);

  /*=============================================
GET requests with filter between related tables
=============================================*/
} else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {

  $response->getRelDataFilter($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

  /*=============================================
GET requests for search without relationships
=============================================*/
} else if (!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["search"])) {

  $response->getDataSearch($table, $select, $_GET["linkTo"], $_GET["search"], $orderBy, $orderMode, $startAt, $endAt);

  /*=============================================
GET requests for search with relationships
=============================================*/
} else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["search"])) {


  $response->getRelDataSearch($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["search"], $orderBy, $orderMode, $startAt, $endAt);

  /*=============================================
GET requests for range selection
=============================================*/
} else if (!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])) {

  $response->getDataRange($table, $select, $_GET["linkTo"], $_GET["between1"], $_GET["between2"], $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

  /*=============================================
GET requests for range selection with relationships
=============================================*/
} else if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["between1"]) && isset($_GET["between2"])) {

  $response->getRelDataRange($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["between1"], $_GET["between2"], $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
} else {

  /*=============================================
  GET requests without filter
  =============================================*/

  $response->getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}


class GetService {
    public static function getReligion() {
        $conn = Connection::connect();
        $query = $conn->query("SELECT * FROM dbo.Religion");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRol() {
        $conn = Connection::connect();
        $query = $conn->query("SELECT * FROM dbo.Rol WHERE estado = 'activo'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>