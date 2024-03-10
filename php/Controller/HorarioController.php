<?php

require_once '../Model/Curso.php'; // Ajusta la ruta según tu estructura de archivos
$funcion = $_GET["function"];
if ($funcion == "create") {
    create();
} else if ($funcion == "getAll") {
    getAll();
} else if ($funcion == "deleteC") {
    deleteC();
} else if ($funcion == "edit") {
    edit();
} else if ($funcion == "getC") {
    getC();
}

function getAll()
{
    $data = new Curso();
    $all = $data->getAll();
    echo json_encode($all);
}
