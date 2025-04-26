<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
require_once __DIR__ . '/../../../api/controllers/post.controller.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !is_array($input)) {
    echo json_encode(["status" => 400, "results" => "Datos inválidos"]);
    exit;
}

PostController::postData("bitacora", $input);
