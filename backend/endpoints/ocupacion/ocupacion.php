<?php
/*=============================================
Autor: Engelber Venceslav Cifuentes Moran
Endpoint para gestionar Ocupaciones
=============================================*/
require_once __DIR__ . '/../../../api/controllers/get.controller.php';
require_once __DIR__ . '/../../../api/controllers/post.controller.php';
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
require_once __DIR__ . '/../../../api/controllers/delete.controller.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

/*=============================================
Desarrollado por: Engelber Venceslav Cifuentes Moran
Sistema de validación de campos para Ocupaciones
=============================================*/
// Función para validar campos obligatorios
function validarCamposObligatorios($data, $camposObligatorios) {
    $camposFaltantes = [];
    foreach ($camposObligatorios as $campo) {
        if (!isset($data[$campo]) || empty($data[$campo])) {
            $camposFaltantes[] = $campo;
        }
    }
    return $camposFaltantes;
}

// Campos obligatorios para Ocupacion
$camposObligatorios = [
    'DesOcupacion',
    'FechaCreacion',
    'UsuarioCreacion',
    'FechaActualiza',
    'UsuarioActualiza'
];

switch ($method) {
    case 'GET':
        $select = $_GET['select'] ?? '*';
        $orderBy = $_GET['orderBy'] ?? null;
        $orderMode = $_GET['orderMode'] ?? null;
        $startAt = $_GET['startAt'] ?? null;
        $endAt = $_GET['endAt'] ?? null;

        GetController::getData(
            'Ocupacion',
            $select,
            $orderBy,
            $orderMode,
            $startAt,
            $endAt
        );
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validar campos obligatorios
        $camposFaltantes = validarCamposObligatorios($data, $camposObligatorios);
        if (!empty($camposFaltantes)) {
            echo json_encode([
                "status" => 400,
                "results" => "Campos obligatorios faltantes: " . implode(", ", $camposFaltantes)
            ]);
            break;
        }
        
        PostController::postData('Ocupacion', $data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET['id'] ?? null;
        $nameId = 'id_Ocupacion';
        
        if (!$id) {
            echo json_encode([
                "status" => 400,
                "results" => "ID no proporcionado"
            ]);
            break;
        }

        // Validar campos obligatorios
        $camposFaltantes = validarCamposObligatorios($data, $camposObligatorios);
        if (!empty($camposFaltantes)) {
            echo json_encode([
                "status" => 400,
                "results" => "Campos obligatorios faltantes: " . implode(", ", $camposFaltantes)
            ]);
            break;
        }
        
        PutController::putData('Ocupacion', $data, $id, $nameId);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        $nameId = 'id_Ocupacion';
        
        if (!$id) {
            echo json_encode([
                "status" => 400,
                "results" => "ID no proporcionado"
            ]);
            break;
        }
        
        DeleteController::deleteData('Ocupacion', $id, $nameId);
        break;

    default:
        echo json_encode([
            "status" => 405,
            "results" => "Método no permitido"
        ]);
        break;
} 