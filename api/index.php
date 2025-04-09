<?php

/*=================
Disaplay Errors
SAVE ERROR THIS LOG IN THE SERVER 
EXAMPLE XAMPP = C:\xampp\htdocs\myProject\logs\php_errors.txt
=================*/

define('DIR', __DIR__);

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", DIR . "/php_errors.txt");

/*=======
CORS
EXPLAIN CORS
CORS is a security feature implemented by web browsers to prevent malicious websites from making requests to a different domain than the one that served the original web page. It allows servers to specify which origins are permitted to access their resources, enabling secure cross-origin requests.

Cybersecurity
CORS is a security feature implemented by web browsers to prevent malicious websites from making requests to a different domain than the one that served the original web page. It allows servers to specify which origins are permitted to access their resources, enabling secure cross-origin requests.
CORS is a security feature implemented by web browsers to prevent malicious websites from making requests to a different domain than the one that served the original web page. It allows servers to specify which origins are permitted to access their resources, enabling secure cross-origin requests.
=======*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('content-type: application/json; charset=utf-8');

/*=================
requirements
=================*/
require_once "controllers/routes.controller.php";


$index = new RoutesController();
$index->/* The `index` method in the `RoutesControler` class is likely serving as the entry point or
main method for handling incoming requests and routing them to the appropriate controller
actions or functions. It could be responsible for initializing the routing mechanism,
parsing the request, and dispatching it to the corresponding controller method based on the
request parameters or URL. */
index();
