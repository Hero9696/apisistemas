<?php

require_once "get.model.php";
//comentario

class Connection
{

  /*==========================
  DATABASE CONNECTION
  ==========================*/
  static public function infoDatabase()
  {
    /*===============================
    example from conncetion to database
    mysql = stringConnection = "mysql:host=localhost;bname=name_database", user = "user_database", password = "password_database"
    postgresql = "pgsql:host=localhost;dbname=name_database", user = "user_database", password = "password_database"
    mongodb = "mongodb://user:password@localhost:27017/name_database"
    sqlserver = "sqlsrv:Server=localhost;Database=name_database", user = "user_database", password = "password_database"

    ==============================*/
   


    $infoDB = array(
      "database" => "tienda_api", //this is the name of the database
      "user" => "root", //xampp = root this is the user of the database from server
      "password" => "", //xampp = "" this is the password of the database from server
    );

    return $infoDB;
  }

  /*==========================
  APIKEY
  secret key for api
  this is the key to validate the api
  ==========================*/
  static public function apikey()
  {
    return "gdfdkjw9oiUadskfMh29G384aksjhf2938"; //128 bits 
  }

  /*==========================
  public access
  ==========================*/
  static public function publicAccess()
  {
    $tables = [""]; //this is the tables that have public access
    return $tables;
  }

  /*==========================
  Database Connection
  ==========================*/
  static public function connect()
  {

    try {

      $link = new PDO(
        "mysql:host=localhost;dbname=" . Connection::infoDatabase()["database"],
        Connection::infoDatabase()["user"],
        Connection::infoDatabase()["password"]
      );

      $link->exec("set names utf8");
    } catch (PDOException $e) {
      die("No Se Pudo Conectar A La Base De Datos, Detalle: " . $e->getMessage());
    }

    return $link;
  }

  /*==========================
  validate tables exist in database

  ||table = users \\ columns = id, name, email (attribute)
  ==========================*/
  static public function getColumnsData($table, $columns)
  {
    //get name of tables from database
    $database = Connection::infoDatabase()["database"];

    //get all columns from table
    $validate = Connection::connect()
      ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
      ->fetchAll(PDO::FETCH_OBJ);

    //validate exis the table
    if (empty($validate)) {
      return null;
    } else {
      //selection columns global
      if ($columns[0] == "*") {

        array_shift($columns);
      }

      //validate columns exist in table
      $sum = 0;

      //function foreach this is to get the columns from the table
      //and compare with the columns that we have
      //and return the columns that exist in the table
      foreach ($validate as $key => $value) {
        $sum += in_array($value->item, $columns);
      }

      //fucntion ternary
      return $sum == count($columns) ? $validate : null;
    }
  }
  /*==========================
  token generator
  ==========================*/
  static public function jwt($id, $email)
  {

    $time = time(); //time in seconds 2023-03-20 22:56:10
    $token = array(
      "iat" => $time, //time initial token
      "exp" => $time + (60 * 60 * 24), //time expiration token 1 day
      "data" => [
        "id" => $id, //id user
        "email" => $email, //email user
      ]
    );

    return $token;
  }

  /*==========================
  validate token 
  example: table = users (plural)
  columns = id_user, name_user, email_user(suffix) (attribute)
  ==========================*/
  static public function tokenValidate($token, $table, $suffix)
  {
    //get user from token 
    $user = GetModel::getDataFilter($table, "token_exp_" . $suffix, "token_" . $suffix, $token, null, null, null, null);

    if (!empty($user)) {
      //validate token is not expired

      $time = time(); //time in seconds 2023-03-20 22:56:10

      if ($time < $user[0]->{"token_exp_" . $suffix}) {
        return "ok";
      } else {
        return "expired";
      }
    } else {
      return "No-auth";
    }
  }
}
