<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


/*=============================================
Autor: Engelber Venceslav Cifuentes Moran
Endpoint para gestionar Informes Médicos
=============================================*/
require_once __DIR__ . '/../../../api/controllers/get.controller.php';
require_once __DIR__ . '/../../../api/controllers/post.controller.php';
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
require_once __DIR__ . '/../../../api/controllers/delete.controller.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

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

// Función para validar números decimales positivos
function validarDecimalPositivo($numero) {
    return is_numeric($numero) && $numero > 0;
}

// Campos obligatorios para InformeMedico
$camposObligatorios = [
    'Id_Expediente',
    'Id_Cita',
    'ObjetivoGeneral',
    'Descripcion',
    'Estatura',
    'Peso',
    'FechaCreacion',
    'UsuarioCreacion',
    'FechaActualiza',
    'UsuarioActualiza'
];

/*=============================================
Desarrollado por: Engelber Venceslav Cifuentes Moran
Gestión de métodos HTTP para Informes Médicos
=============================================*/
switch ($method) {
    case 'GET':
        $select = $_GET['select'] ?? '*';
        $orderBy = $_GET['orderBy'] ?? null;
        $orderMode = $_GET['orderMode'] ?? null;
        $startAt = $_GET['startAt'] ?? null;
        $endAt = $_GET['endAt'] ?? null;

        GetController::getData(
            'InformeMedico',
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

        // Validar que Estatura y Peso sean números decimales positivos
        if (!validarDecimalPositivo($data['Estatura'])) {
            echo json_encode([
                "status" => 400,
                "results" => "La Estatura debe ser un número positivo"
            ]);
            break;
        }

        if (!validarDecimalPositivo($data['Peso'])) {
            echo json_encode([
                "status" => 400,
                "results" => "El Peso debe ser un número positivo"
            ]);
            break;
        }
        
        PostController::postData('InformeMedico', $data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET['id'] ?? null;
        $nameId = 'id_InformeMedico';
        
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

        // Validar que Estatura y Peso sean números decimales positivos
        if (!validarDecimalPositivo($data['Estatura'])) {
            echo json_encode([
                "status" => 400,
                "results" => "La Estatura debe ser un número positivo"
            ]);
            break;
        }

        if (!validarDecimalPositivo($data['Peso'])) {
            echo json_encode([
                "status" => 400,
                "results" => "El Peso debe ser un número positivo"
            ]);
            break;
        }
        
        PutController::putData('InformeMedico', $data, $id, $nameId);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        $nameId = 'id_InformeMedico';
        
        if (!$id) {
            echo json_encode([
                "status" => 400,
                "results" => "ID no proporcionado"
            ]);
            break;
        }
        
        DeleteController::deleteData('InformeMedico', $id, $nameId);
        break;

    default:
        echo json_encode([
            "status" => 405,
            "results" => "Método no permitido"
        ]);
        break;
} 