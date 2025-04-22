<?php
require_once __DIR__ . '/../../../api/controllers/post.controller.php';
header('Content-Type: application/json');

// Asegúrate de que la petición sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
    exit;
}

// Lee los datos del body JSON
$input = json_decode(file_get_contents('php://input'), true);

// Validación básica
if (!$input || !is_array($input)) {
    echo json_encode(["status" => 400, "results" => "Datos inválidos"]);
    exit;
}

// Llama al controlador para registrar los datos
PostController::postData("escolaridad", $input);
