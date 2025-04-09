<?php 

//errors controls
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/errorLog.txt');

require_once 'controllers/controller.template.php';

$index = new TemplateController();
$index->index();

