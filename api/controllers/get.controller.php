<?php

require_once __DIR__ . "/../models/get.model.php";

class GetController
{

  /*=============================================
  GET requests without filter
  =============================================*/

  static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests with filter
  =============================================*/

  static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests without filter between related tables
  =============================================*/

  static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests with filter between related tables
  =============================================*/

  static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests for search without relations
  =============================================*/

  static public function getDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests for search between related tables
  =============================================*/

  static public function getRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt)
  {

    $response = GetModel::getRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests for range selection
  =============================================*/

  static public function getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo)
  {

    $response = GetModel::getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  GET requests for range selection with relations
  =============================================*/

  static public function getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo)
  {

    $response = GetModel::getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

    $return = new GetController();
    $return->fncResponse($response);
  }

  /*=============================================
  Controller responses
  =============================================*/

  public function fncResponse($response)
  {

    if (!empty($response)) {

      $json = array(

        'status' => 200,
        'total' => count($response),
        'results' => $response

      );
    } else {

      $json = array(

        'status' => 404,
        'results' => 'Not Found',
        'method' => 'get'

      );
    }

    echo json_encode($json, http_response_code($json["status"]));
  }
}