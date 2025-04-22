<?php

require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

// Solo aceptar método PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    // Obtener el contenido del body y convertirlo a array
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que venga el ID
    if (!isset($data["id_Escolaridad"])) {
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Escolaridad"
        ], http_response_code(400));
        return;
    }

    $id = $data["id_Escolaridad"];
    unset($data["id_Escolaridad"]); // No queremos actualizar el ID

    $table = "escolaridad";
    $nameId = "id_Escolaridad";

    PutController::putData($table, $data, $id, $nameId);

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ], http_response_code(405));
}
