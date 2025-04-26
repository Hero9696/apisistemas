<?php
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["id_Usuario"])) {
        echo json_encode(["status" => 400, "results" => "Falta el campo id_Usuario"]);
        return;
    }

    $id = $data["id_Usuario"];
    unset($data["id_Usuario"]);

    PutController::putData("Usuario", $data, $id, "id_Usuario");
} else {
    echo json_encode(["status" => 405, "results" => "Método no permitido"]);
}

