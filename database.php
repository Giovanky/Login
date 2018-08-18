<?php
$host = 'localhost:8080';
$username = 'root';
$password = '';
$database = 'proyecto';
try {
  $conexion = new PDO("mysql:host=$host;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Conexion Fallida: ' . $e->getMessage());
}
