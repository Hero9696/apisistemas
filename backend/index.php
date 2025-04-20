<?php

//errors controls
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/errorLog.txt');


require_once __DIR__ . '/endpoints/usuarios/usuarios.php';
require_once __DIR__ . '/endpoints/productos/productos.php';

/*=============================================
Endpoints agregados por: Engelber Venceslav Cifuentes Moran
Fecha: 2025
Descripción: Endpoints para la gestión de:
- Informes Médicos
- Municipios
- Ocupaciones
- Pacientes
- Parentezcos
=============================================*/
require_once __DIR__ . '/endpoints/informe-medico/informe-medico.php';
require_once __DIR__ . '/endpoints/municipio/municipio.php';
require_once __DIR__ . '/endpoints/ocupacion/ocupacion.php';
require_once __DIR__ . '/endpoints/paciente/paciente.php';
require_once __DIR__ . '/endpoints/parentezco/parentezco.php';



