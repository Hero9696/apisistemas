<?php

require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_Terapia"])) {
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Terapia"
        ], http_response_code(400));
        return;
    }

    $id = $data["id_Terapia"];
    unset($data["id_Terapia"]);

    PutController::putData("Terapia", $data, $id, "id_Terapia");

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ], http_response_code(405));
}
