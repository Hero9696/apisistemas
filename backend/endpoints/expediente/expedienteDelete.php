<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


require_once __DIR__ . '/../../../api/controllers/delete.controller.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
    exit;
}

$id = $_GET['id'] ?? null;
$nameId = 'id_Expediente';

if (!$id) {
    echo json_encode(["status" => 400, "results" => "ID no proporcionado"]);
    exit;
}

DeleteController::deleteData('Expediente', $id, $nameId);