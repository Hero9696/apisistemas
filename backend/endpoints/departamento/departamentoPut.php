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

// Solo aceptar método PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    // Leer y decodificar el body en JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que venga el ID
    if (!isset($data["id_Departamento"])) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Departamento"
        ]);
        return;
    }

    // Obtener y remover el ID del array de actualización
    $id = $data["id_Departamento"];
    unset($data["id_Departamento"]);

    // Datos de la tabla
    $table = "Departamento"; // Asegúrate de que coincida exactamente con el nombre real en la base de datos
    $nameId = "id_Departamento";

    // Ejecutar controlador
    PutController::putData($table, $data, $id, $nameId);

} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ]);
}
