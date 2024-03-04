<?php

require_once '../Model/Profesor.php'; // Ajusta la ruta según tu estructura de archivos
$funcion = $_GET["function"];
if ($funcion == "createProfesor") {
    createProfesor();
} else if ($funcion == "mostrarDatos") {
    mostrarDatos();
} else if ($funcion == "deleteProfesor") {
    deleteProfesor();
} else if ($funcion == "editProfesor") {
    editProfesor();
} else if ($funcion == "getProfesor") {
    getProfesor();
}

function createProfesor()
{
    $dateAct = date('Y/m/d h:i:s', time());

    // Obtener los datos JSON enviados por la solicitud
    $data = json_decode(file_get_contents("php://input"));
    $horasSemanales = ($data->dedicacion == "Tiempo completo") ? 16 : (($data->dedicacion == "Tiempo parcial") ? 8 : 0);

    // Crear una instancia de Profesor con los datos recibidos
    $profesor = new Profesor($data->nombre, $data->correo, $data->departamento, $data->dedicacion, $horasSemanales, $dateAct);

    $result = $profesor->save();

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        echo "Success: Profesor guardado correctamente.";
    } else {
        echo "Error: Error al guardar el profesor. Detalles: " . $result;
    }
}

function mostrarDatos()
{
    $profesores = new Profesor();
    $allProfesores = $profesores->getAll();
    echo json_encode($allProfesores);
}

function deleteProfesor()
{
    $user_id = $_GET["user_id"];
    $profesor = new Profesor();
    $result = $profesor->deleteProfesor($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result === true) {
        echo "Success: Profesor eliminado correctamente.";
    } else {
        echo "Error: Error al eliminar el profesor. Detalles: " . $result;
    }
}

function getProfesor()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];
    $profesor = new Profesor();
    $result = $profesor->getProfesor($user_id);
    // echo $result;
    // Enviar una respuesta basada en el resultado
    if ($result) {
        $response["status"] = "Success";
        $response["response"] = $result;
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error: Error al traer información del profesor. Detalles: " . $result;
        echo json_encode($response);
    }
}

function editProfesor()
{
    $response = [
        "status" => "",
        "response" => ""
    ];
    $user_id = $_GET["user_id"];

    $data = json_decode(file_get_contents("php://input"));
    $horasSemanales = ($data->dedicacion == "Tiempo completo") ? 16 : (($data->dedicacion == "Tiempo parcial") ? 8 : 0);

    $profesor = new Profesor($data->nombre, $data->correo, $data->departamento, $data->dedicacion, $horasSemanales);
    $result = $profesor->editProfesor($user_id);

    // Enviar una respuesta basada en el resultado
    if ($result == true) {
        $response["status"] = "Success";
        $response["response"] = "Profesor editado correctamente";
        echo json_encode($response);
    } else {
        $response["status"] = "Error";
        $response["response"] = "Error al editar el profesor. Detalles: " . $result;
        echo json_encode($response);
    }
}
