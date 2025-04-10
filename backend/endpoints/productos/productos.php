<?php
require_once __DIR__ . '/../../../api/models/connection.php';
require_once __DIR__ . '/../../../api/models/get.model.php';
require_once __DIR__ . '/../../../api/models/post.model.php';
require_once __DIR__ . '/../../../api/models/put.model.php';
require_once __DIR__ . '/../../../api/models/delete.model.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Manejar la solicitud GET
        
header('Content-Type: application/json');

// Obtener los parámetros de la URL
$select    = $_GET['select'] ?? '*';
$orderBy   = $_GET['orderBy'] ?? null;
$orderMode = $_GET['orderMode'] ?? null;
$startAt   = $_GET['startAt'] ?? null;
$endAt     = $_GET['endAt'] ?? null;

// Convertir a enteros si es necesario
$startAt = is_numeric($startAt) ? (int)$startAt : null;
$endAt   = is_numeric($endAt) ? (int)$endAt : null;

// Llamar a la función getData
$response = GetModel::getData(
    'bitacora',  // Nombre de la tabla
    $select,
    $orderBy,
    $orderMode,
    $startAt,
    $endAt
);

// Enviar la respuesta
if ($response) {
    echo json_encode([
        "status" => 200,
        "total" => count($response),
        "results" => $response
    ]);
} else {
    echo json_encode([
        "status" => 404,
        "results" => "No se encontraron registros"
    ]);
}

        break;

}