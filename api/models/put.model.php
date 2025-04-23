<?php

require_once "connection.php";

class PutModel
{
  static public function putData($table, $data, $id, $nameId)
  {
    try {
      // Validar existencia del registro
      $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $nameId = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() == 0) {
        return [
          "status" => 404,
          "message" => "No se encontró el registro con $nameId = $id"
        ];
      }

      // Construir sentencia SET
      $set = "";
      foreach ($data as $key => $value) {
        $set .= "$key = :$key, ";
      }
      $set = rtrim($set, ", ");

      $sql = "UPDATE $table SET $set WHERE $nameId = :$nameId";
      $stmt = Connection::connect()->prepare($sql);

      // Asignar parámetros
      foreach ($data as $key => $value) {
        $type = (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        $stmt->bindValue(":$key", $value, $type);
      }

      $stmt->bindValue(":$nameId", $id, PDO::PARAM_INT);

      if ($stmt->execute()) {
        return [
          "status" => 200,
          "message" => "Registro actualizado correctamente",
          "updated_id" => $id
        ];
      }

      return [
        "status" => 500,
        "message" => "Error en la ejecución",
        "error" => $stmt->errorInfo()
      ];

    } catch (PDOException $e) {
      return [
        "status" => 500,
        "message" => "Excepción capturada",
        "error" => $e->getMessage()
      ];
    }
  }
}
