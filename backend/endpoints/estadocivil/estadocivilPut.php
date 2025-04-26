<?php



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


require_once __DIR__ . '/../../../api/controllers/put.controller.php';
header('Content-Type: application/json');

// Solo aceptar método PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    // Obtener el contenido del body y convertirlo a array
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que venga el ID
    if (!isset($data["id_EstadoCivil"])) {
        echo json_encode([
            "status" => 400,
            "results" => "Falta el campo id_Especialidad"
        ], http_response_code(400));
        return;
    }

    $id = $data["id_EstadoCivil"];
    unset($data["id_EstadoCivil"]); // No queremos actualizar el ID

    $table = "Estadocivil";
    $nameId = "id_EstadoCivil";

    PutController::putData($table, $data, $id, $nameId);

} else {
    echo json_encode([
        "status" => 405,
        "results" => "Método no permitido"
    ], http_response_code(405));
}
