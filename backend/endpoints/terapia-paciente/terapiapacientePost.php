<?php
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

PostController::postData("TerapiaPaciente", $input);
