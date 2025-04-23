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




/*=============================================
Endpoints agregados por: Milton Joetd Gómez Marroquín
Fecha: 2025
Descripción: Endpoints para la gestión de:
- Bitacora
- CitaMedica
- Contacto
- Departamento
=============================================*/
/*ENDPOINTS Bitacora */
require_once __DIR__ . '/endpoints/bitacora/bitacoraDelete.php';
require_once __DIR__ . '/endpoints/bitacora/bitacoraGet.php';
require_once __DIR__ . '/endpoints/bitacora/bitacoraPost.php';
require_once __DIR__ . '/endpoints/bitacora/bitacoraPut.php';
/* ENDPOINTS CitaMedica */
require_once __DIR__ . '/endpoints/citamedica/citamedicaDelete.php';
require_once __DIR__ . '/endpoints/citamedica/citamedicaGet.php';
require_once __DIR__ . '/endpoints/citamedica/citamedicaPost.php';
require_once __DIR__ . '/endpoints/citamedica/citamedicaPut.php';
/* ENDPOINTS Contacto */
require_once __DIR__ . '/endpoints/contacto/contactoDelete.php';
require_once __DIR__ . '/endpoints/contacto/contactoGet.php';
require_once __DIR__ . '/endpoints/contacto/contactoPost.php';
require_once __DIR__ . '/endpoints/contacto/contactoPut.php';
/* ENDPOINTS Departamento */
require_once __DIR__ . '/endpoints/departamento/departamentoDelete.php';
require_once __DIR__ . '/endpoints/departamento/departamentoGet.php';
require_once __DIR__ . '/endpoints/departamento/departamentoPost.php';
require_once __DIR__ . '/endpoints/departamento/departamentoPut.php';


//comentarios para el git


