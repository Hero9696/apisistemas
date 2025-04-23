<?php

require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_Cita"])) {
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Cita"
        ], http_response_code(400));
        return;
    }

    $id = $data["id_Cita"];
    unset($data["id_Cita"]);

    $table = "citamedica";
    $nameId = "id_Cita";

    PutController::putData($table, $data, $id, $nameId);

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ], http_response_code(405));
}
