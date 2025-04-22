<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once "get.model.php";
 // Asegúrate de que la ruta sea correcta

class Connection {
    /*==========================================
    Configuración Singleton para Dotenv
    ==========================================*/
    private static $dotenvLoaded = false;
    
    private static function loadEnv() {
        if (!self::$dotenvLoaded) {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
            self::$dotenvLoaded = true;
        }
    }

    /*==========================================
    Información de la Base de Datos (desde .env)
    ==========================================*/
    static public function infoDatabase() {
        self::loadEnv();
        return [
            "database" => $_ENV['DB_NAME'],
            "user" => $_ENV['DB_USER'],
            "password" => $_ENV['DB_PASSWORD']
        ];
    }

    /*==========================================
    API Key (desde .env con fallback)
    ==========================================*/
    static public function apikey() {
        self::loadEnv();
        return $_ENV['API_KEY'] ?? "gdfdkjw9oiUadskfMh29G384aksjhf2938";
    }

    /*==========================================
    Conexión a la Base de Datos
    ==========================================*/
    static public function connect() {
        try {
            $infoDB = self::infoDatabase();
            $link = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $infoDB["database"],
                $infoDB["user"],
                $infoDB["password"]
            );
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    /*==========================================
    Tablas con Acceso Público
    ==========================================*/
    static public function publicAccess() {
        return [""];
    }

    /*==========================================
    Validación de Columnas en Tablas
    ==========================================*/
    static public function getColumnsData($table, $columns) {
        $database = self::infoDatabase()["database"];
        $validate = self::connect()
            ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
            ->fetchAll(PDO::FETCH_OBJ);

        if (empty($validate)) {
            return null;
        }

        if ($columns[0] == "*") {
            array_shift($columns);
        }

        $sum = 0;
        foreach ($validate as $value) {
            $sum += in_array($value->item, $columns);
        }

        return $sum == count($columns) ? $validate : null;
    }

    /*==========================================
    Generador de Token JWT
    ==========================================*/
    static public function jwt($id, $email) {
        $time = time();
        return [
            "iat" => $time,
            "exp" => $time + (60 * 60 * 24), // 1 día de expiración
            "data" => [
                "id" => $id,
                "email" => $email
            ]
        ];
    }

    /*==========================================
    Validación de Token
    ==========================================*/
    static public function tokenValidate($token, $table, $suffix) {
        $user = GetModel::getDataFilter(
            $table, 
            "token_exp_" . $suffix, 
            "token_" . $suffix, 
            $token, 
            null, null, null, null
        );

        if (!empty($user)) {
            return (time() < $user[0]->{"token_exp_" . $suffix}) ? "ok" : "expired";
        }
        return "No-auth";
    }
}
?>