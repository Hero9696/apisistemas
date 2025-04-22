<?php

//errors controls
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/errorLog.txt');

/*=============================================
Endpoints agregados por: Miguel Angel Padilla Morales
Fecha: 2025
Descripción: Endpoints para la gestión de:
- Escolaridad
- Especialidad
- Estado Civil
- Expediente
- Familiar
=============================================*/
/*ENDPOINTS ESCOLARIDAD */
require_once __DIR__ . '/endpoints/escolaridad/escolaridadDelete.php';
require_once __DIR__ . '/endpoints/escolaridad/escolaridadGet.php';
require_once __DIR__ . '/endpoints/escolaridad/escolaridadPost.php';
require_once __DIR__ . '/endpoints/escolaridad/escolaridad.Put.php';
/* ENDPOINTS ESPECIALIDAD */
require_once __DIR__ . '/endpoints/especialidad/especialidadDelete.php';
require_once __DIR__ . '/endpoints/especialidad/especialidadGet.php';
require_once __DIR__ . '/endpoints/especialidad/especialidadPost.php';
require_once __DIR__ . '/endpoints/especialidad/especialidadPut.php';
/* ENDPOINTS ESTADO CIVIL */
require_once __DIR__ . '/endpoints/estadocivil/estadocivilDelete.php';
require_once __DIR__ . '/endpoints/estadocivil/estadocivilGet.php';
require_once __DIR__ . '/endpoints/estadocivil/estadocivilPost.php';
require_once __DIR__ . '/endpoints/estadocivil/estadocivilPut.php';
/* ENDPOINTS EXPEDIENTE */
require_once __DIR__ . '/endpoints/expediente/expedienteDelete.php';
require_once __DIR__ . '/endpoints/expediente/expedienteGet.php';
require_once __DIR__ . '/endpoints/expediente/expedientePost.php';
require_once __DIR__ . '/endpoints/expediente/expedientePut.php';

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


//comentarios para el git


