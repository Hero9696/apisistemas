<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_Contacto"])) {
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Contacto"
        ], http_response_code(400));
        return;
    }

    $id = $data["id_Contacto"];
    unset($data["id_Contacto"]);

    $table = "contacto";
    $nameId = "id_Contacto";

    PutController::putData($table, $data, $id, $nameId);

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ], http_response_code(405));
}
