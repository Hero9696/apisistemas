<?php
require __DIR__ . '/api/models/connection.php';

$conn = Connection::connect();
if ($conn) {
    echo "✅ ¡Conexión exitosa!";
    var_dump(Connection::apikey()); // Debería mostrar la API key del .env
}
?>