<?php
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
