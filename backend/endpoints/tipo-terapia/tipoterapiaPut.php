<?php
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_TipoTerapia"])) {
        echo json_encode(["status" => 400, "results" => "Falta el campo id_TipoTerapia"]);
        return;
    }

    $id = $data["id_TipoTerapia"];
    unset($data["id_TipoTerapia"]);

    PutController::putData("TipoTerapia", $data, $id, "id_TipoTerapia");
} else {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
}
