<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'proyecto';
try {
  $conexion = new PDO("mysql:host=$host;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Conexion Fallida: ' . $e->getMessage());
}
shdkahsdkM;