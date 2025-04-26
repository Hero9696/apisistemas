<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../../../api/controllers/get.controller.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    $select = $_GET['select'] ?? '*';
    $orderBy = $_GET['orderBy'] ?? null;
    $orderMode = $_GET['orderMode'] ?? null;
    $startAt = $_GET['startAt'] ?? null;
    $endAt = $_GET['endAt'] ?? null;

    if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {

        GetController::getDataFilter(
            'contacto',
            $select,
            $_GET['linkTo'],
            $_GET['equalTo'],
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );

    } elseif (isset($_GET['search']) && isset($_GET['linkTo'])) {

        GetController::getDataSearch(
            'contacto',
            $select,
            $_GET['linkTo'],
            $_GET['search'],
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );

    } elseif (isset($_GET['between1']) && isset($_GET['between2']) && isset($_GET['linkTo'])) {

        GetController::getDataRange(
            'contacto',
            $select,
            $_GET['linkTo'],
            $_GET['between1'],
            $_GET['between2'],
            $orderBy,
            $orderMode,
            $startAt,
            $endAt,
            $_GET['filterTo'] ?? null,
            $_GET['inTo'] ?? null
        );

    } else {

        GetController::getData(
            'contacto',
            $select,
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );
    }

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ]);
}
