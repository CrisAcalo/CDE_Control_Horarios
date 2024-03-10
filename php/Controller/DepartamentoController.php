<?php

require_once '../Model/Departamento.php'; // Ajusta la ruta según tu estructura de archivos
$funcion = $_GET["function"];
if ($funcion == "getAll") {
    getAll();
} else if ($funcion == "getData") {
    getData();
} else if ($funcion == "getCareersByDepartment") {
    getCareersByDepartment();
} else {
    echo 'Error en el Controlador';
}

function getAll()
{
    $data = new Departamento();
    $all = $data->getAll();
    echo json_encode($all);
}

function getData()
{
    $id = $_GET["id"];
    $data = new Departamento();
    $datoEncontrado = $data->getData($id);
    echo json_encode($datoEncontrado);
}

function getCareersByDepartment()
{
    $id = $_GET["department_id"];
    $data = new Departamento();
    $datosEncontrados = $data->getCareersByDepartment($id);
    echo json_encode($datosEncontrados);
}
