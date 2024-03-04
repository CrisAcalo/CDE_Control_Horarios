<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "PROYECTO_14768";

// Create connection
$conexion = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
//  else {
//     echo 'Conexión exitosa';
//