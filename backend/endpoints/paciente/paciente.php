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
Endpoint para gestionar Pacientes
=============================================*/
require_once __DIR__ . '/../../../api/controllers/get.controller.php';
require_once __DIR__ . '/../../../api/controllers/post.controller.php';
require_once __DIR__ . '/../../../api/controllers/put.controller.php';
require_once __DIR__ . '/../../../api/controllers/delete.controller.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

/*=============================================
Desarrollado por: Engelber Venceslav Cifuentes Moran
Sistema de validación avanzada para datos de Pacientes
Incluye validación de CUI y fecha de nacimiento
=============================================*/
// Función para validar el formato del CUI
function validarCUI($cui) {
    // Expresión regular para validar el formato: 4 números espacio 5 números espacio 4 números
    $patron = '/^\d{4}\s\d{5}\s\d{4}$/';
    return preg_match($patron, $cui) === 1;
}

// Función para validar la fecha de nacimiento
function validarFechaNacimiento($fecha) {
    $fechaActual = new DateTime();
    $fechaNacimiento = new DateTime($fecha);
    return $fechaNacimiento <= $fechaActual;
}

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

// Campos obligatorios para paciente
$camposObligatorios = [
    'CUI',
    'primerNombre',
    'primerApellido',
    'fechaNacimiento',
    'telefono',
    'direccion',
    'id_Departamento',
    'id_Municipio',
    'edad',
    'sexo',
    'id_Religion',
    'peso',
    'id_Escolaridad',
    'id_EstadoCivil',
    'lugarVivienda',
    'famiEnCadep',
    'MotivoConsulta',
    'FechaCreacion',
    'UsuarioCreacion'
];

switch ($method) {
    case 'GET':
        $select = $_GET['select'] ?? '*';
        $orderBy = $_GET['orderBy'] ?? null;
        $orderMode = $_GET['orderMode'] ?? null;
        $startAt = $_GET['startAt'] ?? null;
        $endAt = $_GET['endAt'] ?? null;

        GetController::getData(
            'paciente',
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

        // Validar el formato del CUI
        if (!validarCUI($data['CUI'])) {
            echo json_encode([
                "status" => 400,
                "results" => "Formato de CUI inválido. Debe ser: 4 números espacio 5 números espacio 4 números (ejemplo: 1234 56789 0123)"
            ]);
            break;
        }

        // Validar la fecha de nacimiento
        if (!validarFechaNacimiento($data['fechaNacimiento'])) {
            echo json_encode([
                "status" => 400,
                "results" => "La fecha de nacimiento no puede ser en el futuro"
            ]);
            break;
        }
        
        PostController::postData('paciente', $data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET['id'] ?? null;
        $nameId = 'id_paciente';
        
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

        // Validar el formato del CUI
        if (!validarCUI($data['CUI'])) {
            echo json_encode([
                "status" => 400,
                "results" => "Formato de CUI inválido. Debe ser: 4 números espacio 5 números espacio 4 números (ejemplo: 1234 56789 0123)"
            ]);
            break;
        }

        // Validar la fecha de nacimiento
        if (!validarFechaNacimiento($data['fechaNacimiento'])) {
            echo json_encode([
                "status" => 400,
                "results" => "La fecha de nacimiento no puede ser en el futuro"
            ]);
            break;
        }
        
        PutController::putData('paciente', $data, $id, $nameId);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        $nameId = 'id_paciente';
        
        if (!$id) {
            echo json_encode([
                "status" => 400,
                "results" => "ID no proporcionado"
            ]);
            break;
        }
        
        DeleteController::deleteData('paciente', $id, $nameId);
        break;

    default:
        echo json_encode([
            "status" => 405,
            "results" => "Método no permitido"
        ]);
        break;
} 