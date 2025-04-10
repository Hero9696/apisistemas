<?php

require_once __DIR__ . "/../../../api/models/connection.php";

try {
  $query = Connection::connect()->query("SELECT * FROM usuarios");
  $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($usuarios);
} catch (Exception $e) {
  echo json_encode(["error" => $e->getMessage()]);
}
