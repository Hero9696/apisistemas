<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../../../api/controllers/delete.controller.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
    exit;
}

$id = $_GET['id'] ?? null;
$nameId = 'id_Cita';

if (!$id) {
    echo json_encode(["status" => 400, "results" => "ID no proporcionado"]);
    exit;
}

DeleteController::deleteData('citamedica', $id, $nameId);
