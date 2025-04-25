<?php
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_TerapiaPaciente"])) {
        echo json_encode(["status" => 400, "results" => "Falta el campo id_TerapiaPaciente"]);
        return;
    }

    $id = $data["id_TerapiaPaciente"];
    unset($data["id_TerapiaPaciente"]);

    PutController::putData("TerapiaPaciente", $data, $id, "id_TerapiaPaciente");
} else {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
}
