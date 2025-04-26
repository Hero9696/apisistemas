<?php

require_once __DIR__ . '/../../../api/controllers/get.controller.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    $select = $_GET['select'] ?? '*';
    $orderBy = $_GET['orderBy'] ?? null;
    $orderMode = $_GET['orderMode'] ?? null;
    $startAt = $_GET['startAt'] ?? null;
    $endAt = $_GET['endAt'] ?? null;

    // Buscar por filtro
    if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {

        GetController::getDataFilter(
            'Religion',
            $select,
            $_GET['linkTo'],
            $_GET['equalTo'],
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );

    } 
    // Búsqueda con like
    elseif (isset($_GET['search']) && isset($_GET['linkTo'])) {

        GetController::getDataSearch(
            'Religion',
            $select,
            $_GET['linkTo'],
            $_GET['search'],
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );

    } 
    // Rango de fechas u otros
    elseif (isset($_GET['between1']) && isset($_GET['between2']) && isset($_GET['linkTo'])) {

        GetController::getDataRange(
            'Religion',
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

    } 
    // Consulta sin filtro
    else {

        GetController::getData(
            'Religion',
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
