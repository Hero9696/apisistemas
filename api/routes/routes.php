<?php
require_once __DIR__ . "/../models/connection.php";
require_once __DIR__ . "/../controllers/get.controller.php";

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*=============================================
Cuando no se hace ninguna solicitud a la API
=============================================*/
if (count($routesArray) == 0) {
  echo json_encode([
    'status' => 404,
    'results' => 'Not Found'
  ], http_response_code(404));
  return;
}

/*=============================================
Cuando se hace una solicitud a la API
=============================================*/
if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
  $table = explode("?", $routesArray[1])[0];

  /*=============================================
  Validación de API Key
  =============================================*/
  if (!isset(getallheaders()["Authorization"]) || getallheaders()["Authorization"] != Connection::apikey()) {
    if (!in_array($table, Connection::publicAccess())) {
      echo json_encode([
        'status' => 401,
        "results" => "No autorizado"
      ], http_response_code(401));
      return;
    }
  }

  /*=============================================
  Configuración dinámica de servicios
  =============================================*/
  $method = $_SERVER['REQUEST_METHOD'];
  $serviceFile = __DIR__ . "/services/" . strtolower($method) . ".php";
  
  if (!file_exists($serviceFile)) {
    echo json_encode([
      'status' => 405,
      'results' => 'Método no permitido'
    ], http_response_code(405));
    return;
  }

  require_once $serviceFile;
  
  // Manejo de parámetros para PUT/DELETE
  $id = null;
  parse_str(file_get_contents("php://input"), $data);
  
  if ($method == 'PUT' || $method == 'DELETE') {
    $id = $data['id'] ?? null;
    unset($data['id']);
  }

  /*=============================================
  Router dinámico para las tablas específicas
  =============================================*/
  switch ($table) {
    case 'religion':
      $serviceClass = ucfirst($method) . 'Service';
      if ($method == 'GET') {
        $response = $serviceClass::getReligion();
      } elseif ($method == 'POST') {
        $response = $serviceClass::createReligion($data);
      } elseif ($method == 'PUT') {
        $response = $serviceClass::updateReligion($id, $data);
      } elseif ($method == 'DELETE') {
        $response = $serviceClass::deleteReligion($id);
      }
      break;
      
    case 'rol':
      $serviceClass = ucfirst($method) . 'Service';
      // ... misma lógica para Rol
      break;
      
    case 'terapeuta':
      $serviceClass = ucfirst($method) . 'Service';
      // ... misma lógica para Terapeuta
      break;
      
    case 'terapeutaespe':
      $serviceClass = ucfirst($method) . 'Service';
      // ... misma lógica para TerapeutaEspe
      break;
      
    default:
      $response = [
        'status' => 404,
        'results' => 'Tabla no encontrada'
      ];
  }

  echo json_encode($response, http_response_code($response['status'] ?? 200));
}
?>  